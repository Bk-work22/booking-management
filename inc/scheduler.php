<?php
    /**
     * getPMRoomsPerMonth
     *
     * @param  integer $numberOfGuestRooms
     * @param  integer $maintenanceFrequency
     * @return array
     */

    function getPMRoomsPerMonth ($numberOfGuestRooms, $maintenanceFrequency)
    {
        // Gets the total number of rooms per month w.r.t frequency
        // Used floor to avoid the round off scenario
        $numRoomsperMonth = floor($numberOfGuestRooms / $maintenanceFrequency);
        
        $extraRooms =  0;
        // To get the extra rooms that were left out from room division above
        if ($numberOfGuestRooms % $maintenanceFrequency > 0) {
            $extraRooms =  fmod($numberOfGuestRooms, $maintenanceFrequency);
        }

        return getScheduleArray($numRoomsperMonth,$maintenanceFrequency,$extraRooms);
    }

    
    /**
     * getScheduleArray
     *
     * @param  integer $numRoomsperMonth
     * @param  integer $maintenanceFrequency
     * @param  integer $extraRooms
     * @return array
     */

    function getScheduleArray($numRoomsperMonth,$maintenanceFrequency,$extraRooms){
        $mainarray = [];
        $freqSechedule = [];
        $monthNumber = 1;

        // Calculating sections per frequency e.g. 12/6 = 2(sections) 12/3 => 4(sections)
        $divOfMonthsPerFrequency = 12 / $maintenanceFrequency;
        
        // Loop running for a single section e.g. a quater in a year
        for($multiplier=1; $multiplier <= $divOfMonthsPerFrequency; $multiplier++){
            $counter = 1;    
            
            $innerLoop = $maintenanceFrequency * $multiplier;
            
            // Inifinite loop will break when the number of months in a division
            // excceds the capacity e.g. in quaterly there can be only 3 months
            // loop breaks on 4 
            while(true) {
                if($monthNumber > $innerLoop){
                    break;
                }
                else{
                    // To get the name of the month from the month number
                    $monthName = date('M', mktime(0, 0, 0, $monthNumber, 10));

                    // To evenly distribute extra rooms in all months of a
                    // section rather than assiging a single month
                    // all the extra rooms. 

                    // counter equals the number of times the inner loop
                    // would run
                    if(($counter <= $extraRooms) && $extraRooms){
                        // extra rooms added to the indiviual month
                        $freqSechedule[$monthName] = $numRoomsperMonth + 1;
                    }
                    else{
                        $freqSechedule[$monthName] = $numRoomsperMonth;
                    }
                    $monthNumber++;
                }
                $counter++;
            }

            // section array appended to the main array
            $mainarray[] = $freqSechedule;
            $freqSechedule = [];
        }

        return $mainarray;
    }
?>