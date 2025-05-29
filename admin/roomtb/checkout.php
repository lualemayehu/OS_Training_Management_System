<?php
include_once("../includes/config.php");

if(isset($_POST['checkout']))
{	
    $booking_id=$_POST['b_c_id'];
    $payment_amount=$_POST['payment_amount'];

        $query = "SELECT * FROM `booking` WHERE `booking_id`=$booking_id";
        $result = mysqli_query($conn, $query);
        $booking_details = mysqli_fetch_assoc($result);
        $room_no = $booking_details['room_no'];
        $remaining_price = $booking_details['remaining_price'];

      if ($remaining_price == $payment_amount) {
            $updateBooking = "UPDATE `booking` SET `remaining_price` = '0',`payment_status` = '1' where booking_id = '$booking_id'";
            $result2 = mysqli_query($conn, $updateBooking);
            if ($result2) {
                $updateRoom = "UPDATE `room` SET `status` = NULL, `check_in_status`='0',`check_out_status`='1',`check_out_date`=CURRENT_TIMESTAMP WHERE `room_no`='$room_no'";
                $updateResult = mysqli_query($conn, $updateRoom);
                
            } 
           
        }
        header("Location: ../booking.php");
}
?>