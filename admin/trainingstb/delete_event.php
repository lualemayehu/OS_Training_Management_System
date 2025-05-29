
<?php
include_once("../includes/config.php");

    $ev_id = $_GET['id'];
    
    mysqli_query($conn,"DELETE FROM `event` WHERE `event`.`ev_id` = $ev_id") ;


		header("Location: ../training.php");
?>