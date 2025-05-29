<?php
include_once("../includes/config.php");

if(isset($_POST['checkin']))
{	
    $booking_id=$_POST['b_c_id'];

        $query = "SELECT * FROM `booking` WHERE `booking_id`=$booking_id";
        $result = mysqli_query($conn, $query);
        $booking_details = mysqli_fetch_assoc($result);
        $room_no = $booking_details['room_no'];

        $updateRoom = "UPDATE `room` SET `check_in_status` = '1',`check_in_date`=CURRENT_TIMESTAMP WHERE `room_no` = '$room_no'";
        $updateResult = mysqli_query($conn, $updateRoom);
       
        header("Location: ../booking.php");
}
?>