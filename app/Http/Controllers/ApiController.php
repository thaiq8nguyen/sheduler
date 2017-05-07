<?php

namespace App\Http\Controllers;
use Google_Client;
use Google_Service_Calendar;
use DateTime;
use App\MyLibrary\BusinessHour;

class ApiController extends Controller
{
    //
    public function show($appointmentDate)
    {
        $now = new DateTime();

        $date = new DateTime($appointmentDate);


        $bizHour = new BusinessHour();
        $hours = $bizHour->getHours($date->format('l'));
        $open = new DateTime($date->format('m/d/Y') . ' ' . $hours['open']);
        $close = new DateTime($date->format('m/d/Y') . ' ' . $hours['close']);

        $timeSlots = [];

        if(date('Ymd') == $date->format('Ymd')) {

            if ($now < $open) { //shop is close
                $now = clone $open;

            } else if ($now > $close) { //shop is close
                $tomorrow = new DateTime('+1 day'); //add 1 day to the DT object
                $tomorrowHours = $bizHour->getHours($tomorrow->format('l')); //get tomorrow's hours
                $now = new DateTime($tomorrow->format('m/d/Y') . ' ' . $tomorrowHours['open']); //create a new open DT object
                $close = new DateTime($tomorrow->format('m/d/Y') . ' ' . $tomorrowHours['close']); //create a new close DT object
                //var_dump('we are closed');
            } else { //shop is open

                $now->setTime(idate('H'), ceil(idate('i') / 15) * 15);

            }
        }
        else{
            $now = clone $open;
        }

        while($now <= $close)
        {

            array_push($timeSlots, ['time' => $now->format('c'), 'appointments' => 0]);
            $now->modify('+15 minutes');

        }

        putenv('GOOGLE_APPLICATION_CREDENTIALS=My Project-6215caadf694.json');
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setSubject('thai@thaiqnguyen.com');
        $client->setScopes(Google_Service_Calendar::CALENDAR);

        $service = new Google_Service_Calendar($client);
        $calendarID = 'primary';
        $parameters = array('maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => $open->format('c'),
            'timeMax' => $close->format('c'));
        $results = $service->events->listEvents($calendarID, $parameters);
        $appointments = [];

        foreach($results->getItems() as $event)
        {
            array_push($appointments, $event->start->dateTime);
        }
        $appointmentsPerTimeSlot = array_count_values($appointments);
        foreach($timeSlots as $key => $timeSlot){
            foreach($appointmentsPerTimeSlot as $time => $value){
                if($timeSlot['time'] == $time ){
                    $timeSlots[$key]['appointments'] = $value;
                }

            }
        }
        return json_encode($timeSlots);
    }
}


