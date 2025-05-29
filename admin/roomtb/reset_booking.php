<?php
include_once("../includes/config.php");

$sql2="UPDATE `room` SET `room`.`room_booked` ='Available', `room`.`check_in_date`= '0000-00-00' , `room`.`check_out_date` ='0000-00-00' WHERE `room`.`room_booked` ='Booked'";

 if(mysqli_query($conn, $sql2))  
 {  
	 
      
    header("Location: ../room.php");
	 
}  

?>