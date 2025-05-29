<?php
include_once("../includes/config.php");

if(isset($_POST['createmsg']))
{	

    $msg_er_name = $_POST['msg_er_name'];
    $msg_detail = $_POST['msg_detail'];
    
    mysqli_query($conn, "INSERT INTO `message` ( `msg_er_name`, `msg_detail`) VALUES ( '$msg_er_name ','$msg_detail' );") ;

    header("Location: ../room.php");

}if(isset($_POST['msg_resolved']))
{	
    $msg_id=$_POST['msg_id'];
    mysqli_query($conn, "UPDATE `message` SET `resolve_status` = '1' WHERE `message`.`msg_id` = $msg_id") ;


    header("Location: ../room.php");
}
?>
                 
      