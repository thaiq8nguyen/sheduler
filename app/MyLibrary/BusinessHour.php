<?php
/**
 * Created by PhpStorm.
 * User: Thai Nguyen
 * Date: 5/3/2017
 * Time: 8:59 AM
 */

namespace app\MyLibrary;


class BusinessHours
{
    private $path;
    private $bizHours;
    public function __construct(){

        $this->path = storage_path('json/business-hours.json');
        $this->bizHours =  json_decode(file_get_contents($this->path), true);
    }

    public function getHours($day){
        $hours = $this->bizHours['hours'];
        $bizHour = [];
        foreach($hours as $hour){
            if($hour['day'] == $day ){
                $bizHour = ['day'=> $hour['day'], 'open' => $hour['open'], 'close' => $hour['close']];
            }
        }

        return $bizHour;
    }
}