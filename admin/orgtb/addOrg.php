<?php
include_once("../includes/config.php");

if(isset($_POST['add']))
{

$org_name=$_POST['org_name'];
$org_country=$_POST['org_country'];
$org_region=$_POST['org_region'];
$org_city=$_POST['org_city'];
$org_sub_city=$_POST['org_sub_city'];
$org_woreda=$_POST['org_woreda'];
$org_email=$_POST['org_email'];
$org_phone=$_POST['org_phone'];
$org_phone_2=$_POST['org_phone_2'];
$org_type=$_POST['org_type'];

 $queryr=mysqli_query($conn,"INSERT INTO `organization` (`org_name`, `org_country`, `org_region`, `org_city`, `org_sub_city`, `org_woreda`, `org_phone`, `org_phone_2`, `org_email`, `org_type`, `org_logo`)
VALUES ('$org_name', '$org_country', '$org_region', '$org_city','$org_sub_city', '$org_woreda', '$org_phone', '$org_phone_2', '$org_email', '$org_type', 'filename')");

if($queryr)
{
    header("Location: ../org.php");
}
else{
echo("fail");
} 


}

?>

