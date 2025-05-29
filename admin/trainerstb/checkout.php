<?php
include_once("../includes/config.php");

$t = date('Y-m-d H:i:s');
$tr_fk_id=$_GET["id"];
$sql2="UPDATE `trainee` LEFT JOIN `room` ON `trainee`.`fk_room`=`room`.`room_no` SET `tr_check_out_date` = '$t',`room`.`room_booked`='Available' WHERE `trainee`.`tr_id`= '$tr_fk_id'";

 if(mysqli_query($conn, $sql2))  
 {  
	 
      echo "Customer Checked Out at '$t'" ; 
	 
	 header("Location: ../reservation.php");
	 
}  

?>