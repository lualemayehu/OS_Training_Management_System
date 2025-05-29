<?php
include_once("../includes/config.php");

if(isset($_POST['update']))
{	

    $room_id = $_POST['room_id'];
    $room_no = $_POST['room_no'];
    $room_type = $_POST['room_type'];
    
    mysqli_query($conn, "UPDATE `room` SET `room_type` = '$room_type',`room_no`='$room_no' WHERE `room`.`room_id`=$room_id") ;


    header("Location: ../room.php");
}
?>
                 
      