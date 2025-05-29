<?php
include_once("../includes/config.php");

if(isset($_POST['update']))
{	
                                $trner_title=$_POST['trner_title'];
                               $trner_first_name=$_POST['trner_first_name'];
                               $trner_middle_name=$_POST['trner_middle_name'];
                               $trner_last_name=$_POST['trner_last_name'];
                               $trner_birth_date=$_POST['trner_birth_date'];
                               $trner_gender=$_POST['trner_gender'];
                               $trner_email=$_POST['trner_email'];
                               $trner_phone=$_POST['trner_phone'];
                                $trner_region=$_POST['trner_region'];
                                $trner_city=$_POST['trner_city'];
                               $trner_sub_city=$_POST['trner_sub_city'];
                               $trner_inistitute=$_POST['trner_inistitute'];
                               $trner_edu=$_POST['trner_edu'];
                               $fk_topic=$_POST['topic'];
                               $fk_room=$_POST['rooms'];
                               $fk_event=$_POST['event'];
                            
    
    $queryr=mysqli_query($conn, "UPDATE `trainer` SET `trner_title` = '$trner_title',`trner_first_name` = '$trner_first_name',
     `trner_middle_name` = '$trner_middle_name', `trner_last_name` = '$trner_last_name', 
     `trner_birth_date` = '$trner_birth_date', `trner_gender` = '$trner_gender', `trner_email` = '$trner_email', 
     `trner_phone` = '$trner_phone',`trner_region` = '$trner_region', `trner_city` = '$trner_city', `trner_sub_city` = '$trner_sub_city', `trner_inistitute`='$trner_inistitute',
     `trner_edu` = '$trner_edu', `fk_topic` = '$fk_topic', `fk_room`='$fk_room',`fk_event`='$fk_event' WHERE `trainer`.`trner_id` = $trner_id");

if($queryr)
{
         
         echo("Succsees");
         $room_query=mysqli_query($conn,"UPDATE `room` SET `room_booked` = 'Booked' WHERE `room`.`room_no` = '$fk_room';");
         $room_date=mysqli_query($conn,"UPDATE `room`LEFT JOIN `trainee` ON `room`.`room_no`=`trainee`.`fk_room` LEFT JOIN `event` ON `trainee`.`fk_event` SET `room`.`check_in_date`= `event`.`ev_start_date`, `room`.`check_out_date`=`event`.`ev_end_date` WHERE `room`.`room_no`='$fk_room'");
         $tr_date=mysqli_query($conn,"UPDATE `room`LEFT JOIN `trainee` ON `room`.`room_no`=`trainee`.`fk_room` LEFT JOIN `event` ON `trainee`.`fk_event` SET `trainee`.`tr_check_in_date`=`event`.`ev_start_date` , `trainee`.`tr_check_out_date`=`event`.`ev_end_date` WHERE `room`.`room_no`='$fk_room'");
            // While loop must be terminated
            
    

}
else{
    echo("fail");
} 
		header("Location: ../trainee.php#home");
	
}
?>