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

    <?php include "includes/topnav.php"; ?>
    <?php include "includes/sidenav.php"; ?>
         
   
        
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
				
                    <ul class="nav nav-tabs nav-sm nav-light mb-25" id="myTab" role="tablist">
                                <li class="nav-item mb-5">
                                    <a class="nav-link link-icon-left active" 
                                    id="home-tab" 
                                    data-toggle="tab" 
                                    href="#home" 
                                    role="tab" 
                                    aria-controls="home"
                                    aria-selected="false"><i class="fa fa-bed"></i>Booking</a>
                                </li>
                             
                               

                        </ul>
				<!-- Tab panes -->
				<div class="tab-content" id="tab_content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    
                                                    <?php
                                                    $result = mysqli_query($conn, "SELECT * FROM `booking` LEFT JOIN `room` ON `booking`.`room_no`=`room`.`room_no` LEFT JOIN `customer`ON `customer`.`cust_id`=`booking`.`cust_id` WHERE  `room`.`status` IS NOT NULL"); // using mysqli_query instead
                                                    ?>
                                                    <div class="card card-sm">
													<div class="card-body">
														<div class="d-flex align-items-end justify-content-between">
															<div>
                                                                    <?php $query=mysqli_query($conn,"SELECT * FROM `room` WHERE `check_in_status` = '1'");
                                                                    $countevent=mysqli_num_rows($query);
                                                                    ?>
																<span class="d-block">
																	<span class="display-5 font-weight-400 text-dark"><?php echo htmlentities($countevent);?> </span>
																	<small>Checked In</small>
																</span>
															</div>
															
														</div>
														
													</div>
												</div>
					<section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Bookings</h5>
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search..." class="form-control mt-15" style="width: 30%">
                         
 
                            	<hr>		
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Customer</th>
                                                        <th>Room Number</th>
                                                        <th>Room Type</th>
                                                        <th>Booking Status</th>
                                                        <th>Check In</th>
                                                        <th>Check Out</th>
                                                        <th>Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="room_grid">
                                                    <?php
                                                        while($res = mysqli_fetch_array($result)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $res['cust_title']?>&nbsp;<?php echo $res['cust_first_name']?>&nbsp;<?php echo $res['cust_middle_name']?>&nbsp;<?php echo $res['cust_last_name']?></td>
                                                        <td><?php echo $res['room_no']?></td>
                                                        <td><?php echo $res['room_type']?></td>
                                                        <td>
                                                        <?php
                                                            if ($res['status'] == 0) {
                                                                echo '<a  class="btn btn-success" style="border-radius:0%" data-toggle="modal" style="border-radius:0%" data-target="#book'.$res['room_no'].'">Book Room</a>';
                                                            } else {
                                                                echo '<a href="#" class="btn btn-danger" style="border-radius:0%">Booked</a>';
                                                            }
                                                            ?>
                                                       </td>
                                                        <td>
                                                            <?php
                                                            if ($res['status'] == 1 && $res['check_in_status'] == 0) {
                                                                echo '<button class="btn btn-warning" id="checkInRoom"  data-id="' . $res['room_no'] . '" data-toggle="modal" style="border-radius:0%" data-target="#checkin'.$res['room_no'].'">Check In</button>';
                                                            } elseif ($res['status'] == 0) {
                                                                echo '-';
                                                            } else {

                                                                echo '<a href="#" class="btn btn-danger" style="border-radius:0%">Checked In</a>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($res['status'] == 1 && $res['check_in_status'] == 1) {
                                                                echo '<button class="btn btn-primary" style="border-radius:0%" id="checkOutRoom" data-id="' . $res['room_id'] . '" data-toggle="modal" style="border-radius:0%" data-target="#checkout'.$res['room_no'].'">Check Out</button>';
                                                            } elseif ($res['status'] == 0) {
                                                                echo '-';
                                                            }
                                                            ?>
                                                        </td>
                                                        
                                                         <td><a href=""data-toggle='modal' data-target="#editRoom<?php echo $res['room_id']?>"><i class='icon-pencil'></i></a>
                                                         &nbsp;
                                                    
                                                            <?php
                                                            if ($res['status'] == 1) {
                                                                echo '<a href="#" title="Customer Information" data-toggle="modal" data-target="#cutomerDetails'.$res['room_no'].'" data-id="' . $res['room_id'] . '" id="cutomerDetails" ><i class="fa fa-eye"></i></a>';
                                                            }
                                                            ?>
                                                            &nbsp;
                                                         <a href="roomtb/delete_room.php?id=<?php echo $res['room_id']?>" onClick="return confirm('Are you sure you want to delete?')"><i class='icon-trash txt-danger'></i></a> </td>
                                                        		
                                                    
                                                    </tr>
                                                    <?php include 'roomtb/edit.php';
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
    <script src="vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
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
    <!-- Select2 JavaScript -->
<script src="vendors/select2/dist/js/select2.full.min.js"></script>

	
</body>
<script>
            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#room_grid tr").filter(function() {
                        $(this).toggle($(this).text()
                        .toLowerCase().indexOf(value) > -1)
                    });
                });
            });
            $(document).ready(function() {
                $("#report_search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#report_grid tr").filter(function() {
                        $(this).toggle($(this).text()
                        .toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
         <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
                $("#selrooms").select2();
            });
                $(document).ready(function() {
                $('.selorg').select2();
                $('.selev').select2();
            });
            </script>
<script>
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"roomtb/msg_data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".lookup-error").html("");
							$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#lookup_processing").css("display","none");
							
						}
					}
				} );
            
			} );
        </script>
        <script>
            if(window.history.replaceState){
                window.history.replaceState(null,null,window.location.href)
            }
            </script>
</html>
<?php } ?>