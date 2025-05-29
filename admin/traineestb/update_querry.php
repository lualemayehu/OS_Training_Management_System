
<?php
include_once("../includes/config.php");
session_start();
if(isset($_POST['update']))
{	
    $cust_img=$_POST['cust_img'];
    $cust_id=$_POST['cust_id'];
    $topic_input=$_POST['topic'];
    $fk_organization=$_POST['organization'];
    $fk_event=$_POST['event'];
    $cust_title=$_POST['cust_title'];
   $cust_first_name=$_POST['cust_first_name'];
   $cust_middle_name=$_POST['cust_middle_name'];
   $cust_last_name=$_POST['cust_last_name'];
   
   $cust_inistitute=$_POST['cust_inistitute'];
   $cust_position=$_POST['cust_position'];
   $cust_dob=$_POST['cust_dob'];
   $cust_gender=$_POST['cust_gender'];
   $cust_disability_status=$_POST['cust_disability_status']; 
   $cust_edu=$_POST['cust_edu'];
   $cust_type=$_POST['cust_type'];
   $cust_country=$_POST['cust_country'];
   $cust_region=$_POST['cust_region'];
   $cust_city=$_POST['cust_city'];
   $cust_sub_city=$_POST['cust_sub_city'];
   $cust_phone=$_POST['cust_phone'];
   $cust_email=$_POST['cust_email'];
   $fk_room=$_POST['rooms'];
   $old_room=$_POST['old_room'];

   if(isset($_SESSION['authentication']))
   {
       
       $fk_user=$_SESSION['auth_user']['user_id']; 
   } 
   
   
   $querryr=mysqli_query($conn," UPDATE `customer` SET `cust_img`='$cust_img',`cust_first_name`='$cust_first_name',
   `cust_middle_name`='$cust_middle_name',`cust_last_name`='$cust_last_name',`cust_title`='$cust_title',
   `cust_inistitute`='$cust_inistitute',`cust_position`='$cust_position',`cust_edu`='$cust_edu',`cust_dob`='$cust_dob',`cust_gender`='$cust_gender',
   `cust_country`='$cust_country',`cust_region`='$cust_region',`cust_city`='$cust_city',`cust_sub_city`='$cust_sub_city',
   `cust_phone`='$cust_phone',`cust_email`='$cust_email',`cust_disability_status`='$cust_disability_status',
   `cust_type`='$cust_type',`fk_room`='$fk_room',`fk_organization`='$fk_organization',`fk_event`='$fk_event',
    `fk_user`='$fk_user' WHERE `cust_id`='$cust_id' ");
                              

if($querryr)
{
    $sqlt_data = "SELECT * FROM `cust_topic` WHERE `fk_cust_id` = $cust_id";
    $allt_data= mysqli_query($conn,$sqlt_data);
    $cust_topics=[];
    foreach($allt_data as $fetchrow){
        $cust_topics[]=$fetchrow['fk_topic_id'];
    }
    //insert
    foreach($topic_input as $inputvalues){
        if(!in_array($inputvalues, $cust_topics)){
            $insert_querry=mysqli_query($conn,"INSERT INTO `cust_topic` (`fk_cust_id`,`fk_topic_id`) VALUES ($cust_id,$inputvalues);");
                        
        }
    }

    //deleteh
    foreach($cust_topics as $fetchedrow){
        if(!in_array($fetchedrow, $topic_input)){
            $delete_querry=mysqli_query($conn," DELETE FROM `cust_topic` WHERE `fk_cust_id`=$cust_id AND`fk_topic_id`= $fetchedrow ");
         
        }
    }

    
    $sql = "SELECT `event`.`ev_start_date`,`event`.`ev_end_date` FROM `event` WHERE `event`.`ev_id`=$fk_event";
    $all_ev = mysqli_query($conn,$sql);
    while ($ev = mysqli_fetch_array($all_ev,MYSQLI_ASSOC)):; 

    $check_in=$ev["ev_start_date"];
    $check_out=$ev["ev_end_date"];

    endwhile; 
    $booking_sql = " UPDATE `booking` SET `room_no`='$fk_room',`check_in`='$check_in',`check_out`='$check_out' WHERE `cust_id`='$cust_id '";
    $booking_result = mysqli_query($conn, $booking_sql);
    if ($booking_result) {
        $room_stats_sql = "UPDATE `room` SET `status` = '1' WHERE `room`.`room_no` = '$fk_room'";
        $room_result = mysqli_query($conn, $room_stats_sql);
      
    } 
    
         
       header("Location: ../trainee.php");

}

else{
    echo("fail");
} 

}
?>