<?php
include_once("../includes/config.php");

$tr_id = $_GET['id'];
 $sql = "DELETE FROM `trainee` WHERE `trainee`.`tr_id` = '$tr_id'";  
 if(mysqli_query($conn, $sql))  
 {  
      header("Location: ../trainee.php");
}  



?>