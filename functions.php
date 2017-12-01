<?php 

    function getDatesEveryday($postedDate, $repeatTimes) 
    {
        $dates = [];

        for($i = 1; $i <= $repeatTimes; $i++){
            $date = date('Y-m-d', strtotime('+'.$i.' day', strtotime($postedDate)));
            
            $dates[] = date("F jS, Y l", strtotime($date));
        }

        return $dates;
    }

    function getDatesWeekdays($postedDate, $repeatTimes) 
    {
        $dates = [];

        $i = 0;

        while(true) {
            $i++;
            $time = strtotime("+$i days", strtotime($postedDate));
            $daysInWeek = date('w', $time);

            if( ($daysInWeek == 0) or ($daysInWeek == 6) ) {
                continue;   
            }

            $dates[] = date("F jS, Y l", $time);

            if (count($dates) >= (5 * (int)$repeatTimes)) {
                break;
            }
        }

        return $dates;
    }


    function getDatesWeekly($postedDate, $repeatTimes, $range) 
    {
        $dates = [];

        for($i = 1; $i <= $repeatTimes; $i++){
            $weeklyDays = $i * $range;
            
            $dates[] = date("F jS, Y l", strtotime('+'.$weeklyDays. ' day', strtotime($postedDate)));
        }

        return $dates;
    }

    function getDatesMonthly($postedDate, $repeatTimes) 
    {
        $dates = [];
    
        for ($i =1; $i <= $repeatTimes; $i++) {
           
           $dates[] =date("F jS, Y l", strtotime('+'.$i. ' months', strtotime($postedDate)));
        }

        return $dates;
    }

    function getDatesYearly($postedDate, $repeatTimes) 
    {
        $dates = [];
    
        for($i =1; $i <= $repeatTimes; $i++){
            
            $dates[] = date("F jS, Y l", strtotime('+'.$i. ' years', strtotime($postedDate)));
        }

        return $dates;
    }

    function getDatesFirstMonOfMonth($postedDate, $repeatTimes) 
    {
        $dates = [];
    
        $date =  date('Y-m', strtotime($postedDate));
        $fMonday = date('Y-m-d', strtotime('first monday '. $date));

        $rpeat = (int)$repeatTimes;

        $x = 0;

        // compare selected date month's first monday to selected date
        if ($fMonday < date('Y-m-d',strtotime($postedDate))) {
            $x = 1;
            $rpeat++;
        }

        for ($i = $x; $i < $rpeat; $i++) {
            $pdate =  date('Y-m', strtotime('+'.$i. ' month', strtotime($postedDate)));
            $dates[] = date("F jS, Y l", strtotime('first monday '. $pdate));
        }

        return $dates;
    }