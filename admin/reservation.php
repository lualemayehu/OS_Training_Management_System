<?php 
session_start(); 
include('includes/config.php');
if(strlen($_SESSION['authentication'])==false)
  { 
header('location:../index.php');
}
else{
?>

<!DOCTYPE html>

<html lang="en">

<?php include "includes/head.php"; ?>
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

    <?php include "includes/topnav.php"; ?>
    <?php include "includes/sidenav.php"; ?>
        
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
           
                            
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM `trainee` LEFT JOIN `organization` ON `trainee`.`fk_organization`=`organization`.`org_id`LEFT JOIN `event` ON `trainee`.`fk_event`=`event`.`ev_id`LEFT JOIN `room` ON `trainee`.`fk_room`=`room`.`room_no`ORDER BY `trainee`.`tr_id` DESC"); // using mysqli_query instead
                        ?>
					<section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Manage Trainee</h5>
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search " class="form-control mt-15" style="width: 30%">
                            <br>

                            	<hr>		
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead class="table-dark">
                                                    <tr>
                                                   
                                                    
                                                        <th>Name</th>
                                                        <th>Organization</th>
                                                        <th>Training</th>
                                                        <th>Phone Number</th>
                                                        <th>email</th>
                                                        <th>Assigned Room</th>
                                                        <th>Status</th>
                                                    <th></th>
                                                    <th ></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="training_grid">
                                                    <?php
                                                        while($res = mysqli_fetch_array($result)){
                                                            if($res['room_booked']=="Booked"){
                                                                $status="Checked In";
                                                            }else{
                                                                $status="Checked Out";
                                                            }
                                                    ?>
                                                    <tr>  
                                                                       
                                               
                                                        <td><?php echo $res['tr_first_name']?>&nbsp;<?php echo $res['tr_middle_name']?></td>
                                                        <td><?php echo $res['org_name']?></td>
                                                        <td><?php echo $res['ev_tittle_subject']?></td>
                                                        <td><?php echo $res['tr_phone']?></td>
                                                        <td><?php echo $res['tr_email']?></td>
                                                        <td><?php echo $res['fk_room']?></td>
                                                        
                                                        <td><?php echo $status?></td>
                                                        <td ><a href="traineestb/checkin.php?id=<?php echo $res['tr_id']?>"  data-toggle="tooltip" title="Check In" >
                                                            <button type="button"  class="btn btn-xs btn-info check_out">Check In</button>
                                                            </a>
                                                        </td>
                                                         <td ><a href="traineestb/checkout.php?id=<?php echo $res['tr_id']?>"  data-toggle="tooltip" title="Check Out" >
                                                            <button type="button"  class="btn btn-xs btn-info check_out">Check Out</button>
                                                        </a></td>
                                                        	
                                                    
                                                    </tr>
                                                    <?php 
                                                     
                                                }?>
                                                
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    
					</div>
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

    <!-- Data Table JavaScript -->
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vendors/datatables.net-ds.net-bs4/js/dataTables.boott/js/dataTables.dataTables.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="vendors/jszip/dist/jszip.min.js"></script>
<script src="vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="dist/js/dataTables-data.js"></script>


</body>

<script>
            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#training_grid tr").filter(function() {
                        $(this).toggle($(this).text()
                        .toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
        <script>
            if(window.history.replaceState){
                window.history.replaceState(null,null,window.location.href)
            }
            </script>
</html>
<?php } ?>