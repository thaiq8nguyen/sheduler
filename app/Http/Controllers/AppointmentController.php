<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use DateTime;

use Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=My-Project-6215caadf694.json');
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setSubject('thai@thaiqnguyen.com');
        $client->setScopes(Google_Service_Calendar::CALENDAR);

        $service = new Google_Service_Calendar($client);
        $calendarID = 'primary';
        $parameters = array('maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'));
        $results = $service->events->listEvents($calendarID, $parameters);

        return view('show-appointment', ['events' => $results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $path = storage_path('json/nail-service.json');
        $services =  json_decode(file_get_contents($path), true);
        //var_dump($services["services"][0]);
        return view('create-appointment',["services" => $services["services"]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Initialize a Google Calendar Service */
        putenv('GOOGLE_APPLICATION_CREDENTIALS=My-Project-6215caadf694.json');
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setSubject('thai@thaiqnguyen.com');
        $client->setScopes(Google_Service_Calendar::CALENDAR);

        $service = new Google_Service_Calendar($client);
        $calendarID = 'primary';

        /*Form Validation*/
        $rules =  array('appointment-date' => 'required','service' => 'required', 'name' => 'required', 'phone' => 'required');
        $message = [
            'appointment-date.required' => 'Please choose an appointment date and time.',
            'service.required' => 'Please make a service request.',
            'name.required' => 'Your name is required.',
            'phone.required'=> 'Your phone number is required',
        ];
        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            return redirect('/appointments/create')->withErrors($validator)->withInput();
        }
        else{
            $fromTime = new DateTime($request->input('appointment-date'));
            $toTime = clone $fromTime;
            $toTime->modify('+15 minutes');

            $requestService = $request->input('service');
            $client = $request->input('client');
            $phone = $request->input('phone');
            $customerNotes = $request->input('customer-notes');
            $summary = $requestService. " for " . $client . " at phone # " . $phone;
            //var_dump($begin . ' - ' . $end . ' - ' . $service . ' - ' . $name . ' - ' . $phone);
            $appointment = new Google_Service_Calendar_Event([
                'summary' => $summary,
                'description' => $customerNotes,
                'start' => ['dateTime' => $fromTime->format('Y-m-d\TH:i:sP'), 'timeZone' => 'America/Los_Angeles'],
                'end' => ['dateTime' => $toTime->format('Y-m-d\TH:i:sP'), 'timeZone' => 'America/Los_Angeles']
            ]);
            $event = $service->events->insert($calendarID, $appointment);
            if(isset($event)){
                $request->session()->flash('appointment-date', $fromTime->format('l, M d, Y  \a\t g:i A'));
                return redirect('appointments/confirm');
            }

                //redirect to an error page
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function confirm(Request $request){

        if($request->session()->has('appointment-date')){
            return view('confirm-appointment');

        }else{
            return redirect('/');
        }
        $request->session()->flush();


    }

}
