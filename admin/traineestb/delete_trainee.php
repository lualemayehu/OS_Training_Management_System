<?php
include_once("../includes/config.php");

$cust_id = $_GET['id'];

 $sql = "DELETE FROM `customer` WHERE `customer`.`cust_id` ='$cust_id'";  
 if(mysqli_query($conn, $sql))  
 {  
      $room_date=mysqli_query($conn,"UPDATE `room` LEFT JOIN `booking` ON `room`.`room_id`=`booking`.`room_id` SET `room`.`status` = NULL,`room`.`check_in_status` = '0',`room`.`check_out_status` = '0' WHERE `booking`.`cust_id`= $cust_id");
     
      header("Location: ../trainee.php");
}  



?>