<?php 
session_start(); 
include('includes/config.php');

    $tr_id = $_GET['id'];
    
if(strlen($_SESSION['authentication'])==false)
  { 
header('location:../index.php');
}
else{
?>

<!DOCTYPE html>

<html lang="en">

<?php include "includes/head.php"; ?>

    <!-- select2 CSS -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
<?php
$timeout = 30; // Set timeout minutes
$logout_redirect_url = "../index.php"; // Set logout URL

$timeout = $timeout * 60; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Session Ended!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?>
<body>
   
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

    <?php include "includes/topnav.php"; 
            include "includes/sidenav.php"; 
        ?>
        
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
            <?php
                        $result = mysqli_query($conn, "SELECT * FROM `customer` LEFT JOIN `organization` ON `customer`.`fk_organization`=`organization`.`org_id` LEFT JOIN `event` ON `customer`.`fk_event`=`event`.`ev_id` WHERE `cust_id`=$tr_id"); // using mysqli_query instead
                         while($res = mysqli_fetch_array($result)){
                  ?>
            <section class="hk-sec-wrapper" >
            <div class="d-none d-print-block">
                                <a class="auth-brand text-center d-block mb-45" href="#">
                                    <img class="brand-img" src="dist/img/logo-light.png" alt="brand">
                                </a>
                                    <h1 class="display-4 mb-10 text-center">African Leadership Excellence Academy</h1>
                                    <p class="mb-30 text-center">Visit our website <a href="aflexacademy.gov.et"><u>aflexacademy.gov.et</u></a> for more information</p>
                                   
                             
                            
            </div>
                             <div  class="row d-print-none">
                                <div class="col-sm">
                                <div class="button-list">
                                    <button class="btn btn-outline-info" onClick="window.print()">Print</button>
                                        <!-- Button trigger modal -->
                                        <a href=""data-toggle='modal' data-target="#editTr<?php echo $res['cust_id']?>" class="btn btn-outline-success ">Edit</a>
                                        <a href="traineestb/delete_trainee.php?id=<?php echo $res['cust_id']?>" class="btn btn-outline-danger" onClick="return confirm('Are you sure you want to delete?')"> Delete</a> 
                                  
			                   
                                    </div>
                                
                                </div>
                            </div>
                        </section>
            <div class="wrap arm_page arm_view_member_main_wrapper arm_view_member_popup">

            <section style="background-color: #eee;">
            <div class="container py-5">
                 
                    <div id="print2"class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                        <div class="card-body text-center">                
                            <img src="traineestb/cust_img/<?php echo $res['cust_img']; ?>" alt="avatar"
                            class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"><?php echo $res['cust_first_name']?>&nbsp;<?php echo $res['cust_middle_name']?></h5>
                          
                            <p class="text-muted mb-1"><?php echo $res['cust_position']?></p>
                            <p class="text-muted mb-4"><?php echo $res['cust_inistitute']?></p>
                            
                        </div>
                        </div>
                        
                                    <?php include "traineestb/edit_trainee.php"; ?>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $res['cust_first_name']?>&nbsp;<?php echo $res['cust_middle_name']?>&nbsp;<?php echo $res['cust_last_name']?></p>
                            </div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Level of Education</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $res['cust_edu']?></p>
                            </div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Age</p>
                            </div>
                            <div class="col-sm-9">
                                <?php 
                                $age=$res['cust_dob'];
                                if($age=='0000-00-00'||$age=='NULL'){
                                    $diff='NuLL';
                                }else{
                                    
                                    $diff = (date('Y') - date('Y',strtotime($age)));
                                }
                                ?>
                                <p class="text-muted mb-0"><?php echo $diff?></p>
                            </div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Gender</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $res['cust_gender']?></p>
                            </div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $res['cust_email']?></p>
                            </div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $res['cust_phone']?></p>
                            </div>
                            </div>
                           
                            <hr>
                            <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $res['cust_country']?>&nbsp;|&nbsp;<?php echo $res['cust_region']?>&nbsp;<?php echo $res['cust_city']?>, <?php echo $res['cust_sub_city']?></p>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                     
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                            <p class="mb-4"><h4><span class="text-primary font-italic me-1">Organization</span>Training</h4></p>
                                <hr>
                            <?php
                                 $fname=$res['cust_first_name'];
                                 $mname=$res['cust_middle_name'];
                                 $lname=$res['cust_last_name'];

                                        $sql = "SELECT * FROM `customer` LEFT JOIN `organization` ON `customer`.`fk_organization`=`organization`.`org_id` LEFT JOIN `event` ON `customer`.`fk_event`=`event`.`ev_id` WHERE `cust_first_name`='$fname' AND `cust_middle_name`='$mname' AND `cust_last_name`= '$lname'";
                                          $all= mysqli_query($conn,$sql);
                                            while ($org_tr = mysqli_fetch_array($all,MYSQLI_ASSOC)):; 
                                         ?>
                                
                                <p class="mb-1" style="font-size: .77rem;"><span class="text-primary font-italic me-1"><?php echo $org_tr['org_name']?></span> | <?php echo $org_tr['ev_tittle_subject']?></p>
                                        <?php endwhile; ?>
                                
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                            <p class="mb-4"><h4><span class="text-primary font-italic me-1">Training</span>Topics</h4></p>
                                <hr>
                            <?php
                                  $fname=$res['cust_first_name'];
                                  $mname=$res['cust_middle_name'];
                                  $lname=$res['cust_last_name'];

                                        $sql = "SELECT * FROM `customer` LEFT JOIN `organization` ON `customer`.`fk_organization`=`organization`.`org_id` LEFT JOIN `event` ON `customer`.`fk_event`=`event`.`ev_id` LEFT JOIN `cust_topic`ON `customer`.`cust_id`=`cust_topic`.`fk_cust_id` LEFT JOIN `topic` ON `topic`.`topic_id`=`cust_topic`.`fk_topic_id` WHERE `cust_first_name`='$fname' AND `cust_middle_name`='$mname' AND `cust_last_name`= '$lname';";
                                          $all= mysqli_query($conn,$sql);
                                            while ($topic = mysqli_fetch_array($all,MYSQLI_ASSOC)):; 
                                         ?>

                                
                                <p class="mb-1" style="font-size: .77rem;"><span class="text-primary font-italic me-1"><?php echo $topic['ev_tittle_subject']?></span> | <?php echo $topic['topic_title']?></p>
                                        <?php endwhile; ?>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    
                            <?php }?>
                            </div>
                </section>

			</div>
            <!-- /Container -->
            <!-- Footer -->
          
    <?php include "includes/footer.php"; ?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="vendors/raphael/raphael.min.js"></script>
    <script src="vendors/morris.js/morris.min.js"></script>
	
	<!-- Counter Animation JavaScript -->
	<script src="vendors/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="vendors/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- EChartJS JavaScript -->
    <script src="vendors/echarts/dist/echarts-en.min.js"></script>
    
	<!-- Sparkline JavaScript -->
    <script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Vector Maps JavaScript -->
    <script src="vendors/vectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/vectormap-data.js"></script>

	<!-- Owl JavaScript -->
    <script src="vendors/owl.carousel/dist/owl.carousel.min.js"></script>
	
    
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
	<script src="dist/js/dashboard-data.js"></script>


    <!-- Fullcalendar JavaScript -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/jquery-ui.min.js"></script>
    <script src="vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="dist/js/fullcalendar-data.js"></script>



    <!-- Daterangepicker JavaScript -->    
    <script src="vendors/daterangepicker/daterangepicker.js"></script>
    <script src="dist/js/daterangepicker-data.js"></script>

	
	
	<!-- Dropify JavaScript -->
	<script src="vendors/dropify/dist/js/dropify.min.js"></script>
	
	<!-- Form Flie Upload Data JavaScript -->
	<script src="dist/js/form-file-upload-data.js"></script>


<!-- Jasny-bootstrap  JavaScript -->
<script src="vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
<!-- Ion JavaScript -->
<script src="vendors/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<script src="dist/js/rangeslider-data.js"></script>

<!-- Select2 JavaScript -->
<script src="vendors/select2/dist/js/select2.full.min.js"></script>

<!-- Bootstrap Tagsinput JavaScript -->
<script src="vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

	
</body>
<script type="text/javascript">

function print1(strid)
{
if(confirm("Do you want to print?"))
{
var values = document.getElementById(strid);
var printing =
window.open('','','left=0,top=0,width=550,height=400,toolbar=0,scrollbars=0,sta­?tus=0');
printing.document.write(values.innerHTML);
printing.document.close();
printing.focus();
printing.print();
printing.close();
}
}
</script>
<script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
                $("#selrooms").select2();
            });
                $(document).ready(function() {
                $('.selev').select2();
                $('.selorg').select2();
            });
            </script>
          
<script>
            if(window.history.replaceState){
                window.history.replaceState(null,null,window.location.href)
            }
            </script>
</html>
<?php } ?>