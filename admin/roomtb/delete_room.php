
<?php
include_once("../includes/config.php");


    $room_id = $_GET['id'];;
    
    mysqli_query($conn,"DELETE FROM `room` WHERE `room`.`room_id` = $room_id") ;


		header("Location: ../room.php");
?>