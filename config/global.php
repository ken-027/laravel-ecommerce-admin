<?php 

return [
    // 'timezone_list' => function() {
        // $return = array();
        // $timezone_identifiers_list = timezone_identifiers_list();
        // foreach($timezone_identifiers_list as $timezone_identifier){
        //     $date_time_zone = new DateTimeZone($timezone_identifier);
        //     $date_time = new DateTime('now', $date_time_zone);
        //     $hours = floor($date_time_zone->getOffset($date_time) / 3600);
        //     $mins = floor(($date_time_zone->getOffset($date_time) - ($hours*3600)) / 60);
        //     $hours = 'GMT' . ($hours < 0 ? $hours : '+'.$hours);
        //     $mins = ($mins > 0 ? $mins : '0'.$mins);
        //     $text = str_replace("_"," ",$timezone_identifier);
            
        //     //$dateTime = new DateTime(); 
        //     //$dateTime->setTimeZone(new DateTimeZone($timezone_identifier)); 
        //     //$short_timezone = $dateTime->format('T'); 
    
        //     $array=array();
        //     $array['display']=$text.' ('.$hours.':'.$mins.')';
        //     $array['value']=$timezone_identifier;
        //     //$array['short_timezone']=$short_timezone;
        //     $return[] =$array; 
        // }
        // return $return;
    // },
];
