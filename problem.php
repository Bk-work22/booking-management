<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP Test</title>
  </head>
  <body> 
    <h3>PHP Test</h3>
    <? if (!$_POST['calculateButton']) { ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="numberOfGuestRooms">Number of Guest Rooms</label>    
        <input type="text" name="numberOfGuestRooms" id="numberOfGuestRooms">
        <br><br>
        <label for="cleaningFrequency">Cleaning Frequency<br>to clean all rooms</label>    
        <select name="selectedFrequency" id="frequency">
            <option value="">-- choose a frequency --</option>
            <option value="Quarterly">Quarterly</option>
            <option value="Triannually">Triannually</option>
            <option value="SemiAnnually">SemiAnnually</option>
            <option value="Annually">Annually</option>
        </select>
        <br><br>
        <label for="currentMonth">Current Month</label>    
        <select name="selectedMonth" id="month">
            <option value="">-- choose a month --</option>
            <option value="Jan">Jan</option>
            <option value="Feb">Feb</option>
            <option value="Mar">Mar</option>
            <option value="Apr">Apr</option>
            <option value="May">May</option>
            <option value="Jun">Jun</option>
            <option value="Jul">Jul</option>
            <option value="Aug">Aug</option>
            <option value="Sep">Sep</option>
            <option value="Oct">Oct</option>
            <option value="Nov">Nov</option>
            <option value="Dec">Dec</option>
        </select>
        <br><br>
        <input name="calculateButton" type="submit" value="Do the Thing!" id="submit_button">
    </form>
    <? } else { ?>
        <?
        $monthStringToNumber = array(
            "Jan" => 1,
            "Feb" => 2,
            "Mar" => 3,
            "Apr" => 4,
            "May" => 5,
            "Jun" => 6,
            "Jul" => 7,
            "Aug" => 8,
            "Sep" => 9,
            "Oct" => 10,
            "Nov" => 11,
            "Dec" => 12
        ); 
        
        $monthsInFrequency = array(
            "Quarterly" => 3,
            "Triannually" => 4,
            "SemiAnnually" => 6,
            "Annually" => 12
        ); 
        ?>
        
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Back to form inputs</a>

        <? if ($_POST['selectedFrequency'] == "Quarterly") { ?>
            <div><strong>Days to clean all rooms for "<? echo $_POST['selectedMonth'] ?>"</strong></div>
            <? echo getPMRoomsPerMonth($_POST['numberOfGuestRooms'], $monthStringToNumber[$_POST['selectedMonth']]) ?>
            <br><br>
            <div><strong>Proof:</strong></div>
            ---- First Period ----
            <br>
            <? echo 'Jan: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 1) ?>
            <? if (1 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'Feb: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 2) ?>
            <? if (2 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'Mar: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 3) ?>
            <? if (3 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'Apr: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 4) ?>
            <? if (4 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'May: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 5) ?>
            <? if (5 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'Jun: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 6) ?>
            <? if (6 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'Jul: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 7) ?>
            <? if (7 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'Aug: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 8) ?>
            <? if (8 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'Sep: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 9) ?>
            <? if (9 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'Oct: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 10) ?>
            <? if (10 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'Nov: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 11) ?>
            <? if (11 % $monthsInFrequency[$_POST['selectedFrequency']] == 0) { echo "<br><br>---- Next Period ----<br>"; } else { echo "<br>"; } ?>
            <? echo 'Dec: ' . getPMRoomsPerMonth($_POST['numberOfGuestRooms'], 12) ?>
            <br>
        <? } else {
            echo "<br><br>Logic for " . $_POST['selectedFrequency'] . " does not exist yet.";
        }
    } ?>
</body>
</html>

<?php
/**
 * Calculates the rounding on number of PMs per month, on a quarterly basis.
 *
 * Round down on last month of quarter if the number of rooms is (mathematically speaking) mod 2 (or 2/3), and round up
 *   on the first month of the quarter if the number of rooms in mod 1 (or 1/3).
 *
 * @param $numberOfGuestRooms int - Number of rooms in the hotel
 * @param $monthNum int - Month in question
 * @return int
 */
function getPMRoomsPerMonth ($numberOfGuestRooms, $monthNum)
{
    // Divide by 3 for quarterly PMs, and round up.  This works well if the number of rooms is evenly divisible by 3
    $numRooms = round($numberOfGuestRooms / 3);

    // However, if mod is 2, (or, 2/3), we'll need to adjust the final month to reflect the partial room,
    //   by removing the leftover room.
    if ($numberOfGuestRooms % 3 == 2) {
        if ($monthNum == 3 || $monthNum == 6 || $monthNum == 9 || $monthNum == 12) {
            $numRooms = $numRooms - 1;
        }
    } else if ($numberOfGuestRooms % 3 == 1) {
        // However, if mod is 1, (or, 1/3), we'll need to adjust the first month to reflect the partial room,
        //   by adding the leftover room.
        if ($monthNum == 1 || $monthNum == 4 || $monthNum == 7 || $monthNum == 10) {
            $numRooms = $numRooms + 1;
        }
    }
    return $numRooms;
}

?>