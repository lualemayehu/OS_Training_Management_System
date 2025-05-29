<?php
include_once("../includes/config.php");


    $topic_id = $_GET['id'];;
    
    mysqli_query($conn,"DELETE FROM `topic` WHERE `topic`.`topic_id` = $topic_id") ;


		header("Location: ../training.php");
?>