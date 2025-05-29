
<?php
include_once("../includes/config.php");


    $org_id = $_GET['id'];;
    
    mysqli_query($conn,"DELETE FROM `organization` WHERE `organization`.`org_id` =  $org_id") ;


		header("Location: ../org.php");
?>