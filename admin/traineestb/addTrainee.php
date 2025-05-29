<?php
include_once("../includes/config.php");
session_start();
if(isset($_POST['add']))
                               {

                                $fk_organization=$_POST['organization'];
                                $fk_event=$_POST['event'];
                                $topic=$_POST['topic'];
                                $cust_title=$_POST['cust_title'];
                               $cust_first_name=$_POST['cust_first_name'];
                               $cust_middle_name=$_POST['cust_middle_name'];
                               $cust_last_name=$_POST['cust_last_name'];
                               $cust_position=$_POST['cust_position'];
                               $cust_inistitute=$_POST['cust_inistitute'];
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
                               $cust_type=$_POST['cust_type'];
                               $fk_room=$_POST['rooms'];
   // add image
   if(isset($_FILES['cust_img']) && $_FILES['cust_img']['name'] != ""){
    $cust_img = $_FILES['cust_img']['name'];
    $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "cust_img/";
    $uploadDirectory .= $cust_img;
    move_uploaded_file($_FILES['cust_img']['tmp_name'], $uploadDirectory);
}
                     
                               if(isset($_SESSION['authentication']))
                               {
                                   
                                   $fk_user=$_SESSION['auth_user']['user_id']; 
                               } 

                              
                        
                              $queryr=mysqli_query($conn,"INSERT INTO `customer` (`cust_img`,`cust_first_name`, `cust_middle_name`,
                               `cust_last_name`, `cust_title`, `cust_position`,`cust_inistitute`, `cust_edu`,
                              `cust_dob`, `cust_gender`, `cust_country`, `cust_region`, `cust_city`, `cust_sub_city`, 
                              `cust_phone`, `cust_email`, `cust_disability_status`, `cust_type`, 
                              `fk_room`, `fk_organization`, `fk_event`,  `fk_user`)
                               VALUES ('$cust_img','$cust_first_name', '$cust_middle_name', '$cust_last_name', '$cust_title', '$cust_position','$cust_inistitute', 
                               '$cust_edu', '$cust_dob', '$cust_gender', '$cust_country','$cust_region', 
                               '$cust_city', '$cust_sub_city', '$cust_phone', '$cust_email', '$cust_disability_status', '$cust_type',
                                '$fk_room','$fk_organization', '$fk_event',  '$fk_user')");
               

                            if($queryr)
                       {
                        $cust_id = mysqli_insert_id($conn);
                        foreach($topic as $topic_list){
                            $queryr=mysqli_query($conn,"INSERT INTO `cust_topic` (`fk_cust_id`,`fk_topic_id`) VALUES ($cust_id,$topic_list);");
                        
                           }
                           
                           $sql = "SELECT `event`.`ev_start_date`,`event`.`ev_end_date` FROM `event` WHERE `event`.`ev_id`=$fk_event";
                           $all_ev = mysqli_query($conn,$sql);
                           while ($ev = mysqli_fetch_array($all_ev,MYSQLI_ASSOC)):; 
                       
                           $check_in=$ev["ev_start_date"];
                           $check_out=$ev["ev_end_date"];
                      
                           endwhile; 
                       
                           $booking_sql = "INSERT INTO booking (cust_id,room_no,check_in,check_out) VALUES ('$cust_id ','$fk_room','$check_in','$check_out')";
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