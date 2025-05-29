<?php
include_once("../includes/config.php");

if(isset($_POST['update']))
{	
    $ev_id=$_POST['ev_id'];
    $ev_tittle_subject=$_POST['ev_tittle_subject'];
    $ev_request_date=$_POST['ev_request_date'];
    $ev_start_date=$_POST['ev_start_date'];
    $ev_end_date=$_POST['ev_end_date'];
    $ev_level=$_POST['ev_level'];
    $ev_objective=$_POST['ev_objective'];
    $ev_mode_of_delivery=$_POST['ev_mode_of_delivery'];
    $ev_language=$_POST['ev_language'];
    $ev_key_note=$_POST['ev_key_note'];
     $fk_organization=$_POST['fk_organization'];
     $ev_round=$_POST['ev_round'];
 
          
 
     $queryr=mysqli_query($conn, "UPDATE `event` SET `ev_tittle_subject` = '$ev_tittle_subject',
     `ev_request_date` = '$ev_request_date',`ev_start_date` = '$ev_start_date',`ev_end_date` = '$ev_end_date',
     `ev_level` = '$ev_level',`ev_objective` = '$ev_objective',`ev_mode_of_delivery` = '$ev_mode_of_delivery',
     `ev_language` = '$ev_language',`ev_key_note` = '$ev_key_note',`fk_organization` = '$fk_organization',
     `ev_round` = '$ev_round' WHERE `event`.`ev_id` = $ev_id") ;
   
		header("Location: ../training.php");
	
}
?>