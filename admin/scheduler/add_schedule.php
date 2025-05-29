
<?php
include_once("../includes/config.php");

if(isset($_POST['add']))
        {

             $assembly_hall_id=$_POST['assembly_hall_id'];
             $reserved_by=$_POST['reserved_by'];
             $datetime_start=$_POST['datetime_start'];
             $datetime_end=$_POST['datetime_end'];
             $schedule_remarks=$_POST['schedule_remarks'];
                           
        }
?>