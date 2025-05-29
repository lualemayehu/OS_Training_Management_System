<?php
include_once("../includes/config.php");

if(isset($_POST['update']))
{	
    $org_id=$_POST['org_id'];
    $org_name=$_POST['org_name'];
    $org_region=$_POST['org_region'];
    $org_sub_city=$_POST['org_sub_city'];
    $org_woreda=$_POST['org_woreda'];
    $org_city=$_POST['org_city'];
     $org_email=$_POST['org_email'];
     $org_phone=$_POST['org_phone'];
     $org_phone_2=$_POST['org_phone_2'];
     $org_type=$_POST['org_type'];
     $org_region=$_POST['org_region'];


    mysqli_query($conn, "UPDATE `organization` SET `org_name` = '$org_name',
     `org_region` = '$org_region', `org_sub_city` = '$org_sub_city', `org_woreda` = '$org_woreda', `org_city` = '$org_city',
      `org_phone` = '$org_phone', `org_phone_2` = '$org_phone_2', 
      `org_email` = '$org_email', `org_type` = '$org_type' WHERE `organization`.`org_id` = $org_id") ;


		header("Location: ../org.php");
	
}
?>