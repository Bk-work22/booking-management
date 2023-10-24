<?php
    include('scheduler.php');

    if(isset($_POST['numberOfRooms']) && $_POST['numberOfRooms'] != "" && isset($_POST['roomCleaningFrequency']) && $_POST['roomCleaningFrequency'] !==""){
        //  • An integer that specifies the number of guestrooms
        //  • A frequency selected from the four options: quarterly, tri-annually, semi-annually, or annually        
        try {
            $scheduleArray = getPMRoomsPerMonth($_POST['numberOfRooms'],$_POST['roomCleaningFrequency']);
            echo json_encode($scheduleArray);
        }
        catch(Exception $e) {
            echo json_encode(["error"=>$e->getMessage()]);
        }
    }
    else{
        echo json_encode(["error"=>"Incorrect Input Please Try Again"]);
    }
?>