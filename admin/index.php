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
 <!-- Daterangepicker JavaScript -->   
 <script src="dist/js/mychart/Chart.min.js"></script>
	 <script src="dist/js/mychart/jquery.min.js"></script>
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
                            aria-selected="true"><i class="zmdi zmdi-apps"></i>Dashboard</a>
                        </li>
                        <li class="nav-item mb-5">
                            <a class="nav-link link-icon-left" 
                            id="profile-tab"
                            data-toggle="tab" 
                            href="#profile" 
                            role="tab" 
                            aria-controls="profile"
                            aria-selected="false"><i class="fa fa-calendar-o"></i></i>Event Calendar</a></a>
                        </li>

                </ul>
				<!-- Tab panes -->
				<div class="tab-content" id="tab_content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    	<!-- Row -->
						<div class="row">
							<div class="col-xl-12">
										<div class="row">
											<div class="card card-sm">
													<div class="card-body">
														<div class="d-flex align-items-end justify-content-between">
															<div>
                                                                    <?php $query=mysqli_query($conn,"SELECT * FROM `organization` WHERE `deleted`='0'");
                                                                    $countorg=mysqli_num_rows($query);
                                                                    ?>
																<span class="d-block">
																	<span class="display-5 font-weight-400 text-dark"><?php echo htmlentities($countorg);?></span>
																	<small>Customers</small>
																</span>
															</div>
														</div>
													</div>
												</div>
												&nbsp;
												<div class="card card-sm">
													<div class="card-body">
														<div class="d-flex align-items-end justify-content-between">
															<div>
                                                                    <?php $query=mysqli_query($conn,"SELECT * FROM `event` WHERE `deleted`='0'");
                                                                    $countevent=mysqli_num_rows($query);
                                                                    ?>
																<span class="d-block">
																	<span class="display-5 font-weight-400 text-dark"><?php echo htmlentities($countevent);?> </span>
																	<small>Trainings</small>
																</span>
															</div>
															
														</div>
														
													</div>
												</div>
												&nbsp;
												<div class="card card-sm">
													<div class="card-body">
														<div class="d-flex align-items-end justify-content-between">
															<div>
                                                                    <?php $query=mysqli_query($conn,"SELECT * FROM `customer` WHERE `cust_type` = 'Trainee' AND `deleted`='0'");
                                                                    $countevent=mysqli_num_rows($query);
                                                                    ?>
																<span class="d-block">
																	<span class="display-5 font-weight-400 text-dark"><?php echo htmlentities($countevent);?> </span>
																	<small>Trainees</small>
																</span>
															</div>
															
														</div>
														
													</div>
												</div>
								
								</div>
							</div>
						</div>
						<!-- Row -->
						<div class="row">
						
						<div class="card">
											<div class="card-header card-header-action">
												<h6>Trainee Statstics</h6>
												<div class="d-flex align-items-center card-action-wrap">
													
													<a href="#" class="inline-block full-screen">
														<i class="ion ion-md-expand"></i>
													</a>
												</div>
											</div>
											<div class="card-body pa-0">
												<div class="pa-20">
												<div id="chart-container">
													<canvas id="graphCanvas1"></canvas>
												</div>
												</div>
												<div class="table-wrap">
												<?php
												$result = mysqli_query($conn, "SELECT `cust_region`,count(*) as TotalAppearance FROM `customer` WHERE`cust_type`='Trainee' AND `deleted`='0' group by `cust_region`"); // using mysqli_query instead
												?>
													<div class="table-responsive">
													
													
														<table class="table table-sm table-hover mb-0">
															<thead>
																<tr>
																	<th class="w-25">Region</th>
																	<th>Number of Trainees</th>
																	<th>Male</th>
																	<th>Female</th>
																</tr>
															</thead>
															<?php
                                                        while($res = mysqli_fetch_array($result)){
															?>
															<tbody>
																<tr>
															
																<td><?php echo $res['cust_region']?></td>
																<td><?php echo $res['TotalAppearance']?></td>
																<?php
																$region=$res['cust_region'];
																$genderresult = mysqli_query($conn, "SELECT `cust_gender` ,COUNT(*) AS genderCount FROM `customer` WHERE `cust_type`='Trainee' AND `cust_region`= '$region'  AND `deleted`='0' GROUP BY `cust_gender`;"); // using mysqli_query instead
																?>
																<?php
                                                        while($resg = mysqli_fetch_array($genderresult)){
															?>
															
															<td><?php echo $resg['genderCount']?></td>
																
																<?php }   ?>
																</tr>
																<?php }   ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
						

						</div>
						<!-- /Row -->
					</div>


                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            
					<div class="calendarapp-wrap">
                            <div class="calendarapp-sidebar">
                                <div class="nicescroll-bar">
                                    <a id="close_calendarapp_sidebar" href="javascript:void(0)" class="close-calendarapp-sidebar">
                                        <span class="feather-icon"><i data-feather="chevron-left"></i></span>
                                    </a>
                                    
									
									<div class="card mb-4 mb-md-0">
									<div class="card-body">
									
										<?php
															
															$query=mysqli_query($conn,"SELECT * ,COUNT(`org_name`) AS `count` FROM `organization` LEFT JOIN `event` ON `organization`.`org_id`=`event`.`fk_organization` GROUP BY `org_name` ORDER BY `count` DESC;						");
															
															while( $row = mysqli_fetch_array($query) )
															
															{
															?>
										<p class="mb-1" style="font-size: .77rem;"><span class="text-primary font-italic me-1"><?php echo $row['org_name']?></span> | <span class="badge badge-success badge-pill"><?php echo "$row[count] ";?></span></p>
															<?php }?>
										<br>
									</div>
									</div>
                                </div>
                            </div>

                            <div class="calendar-wrap">
                                <div ><iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Africa%2FNairobi&src=ZTF0YnZxMXJiY3VqbnBhbXJlNnVhYmhrbm9AZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&src=ZW4uZXQjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&color=%23D81B60&color=%230B8043" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe></div>
                            </div>
                            
                        </div>
                    
                    
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

	



	
</body>
<script>
            if(window.history.replaceState){
                window.history.replaceState(null,null,window.location.href)
            }
            </script>
			<script>
        $(document).ready(function () {
            lineChart();
        });
   
        function lineChart()
        {
            {
                $.post("chart/datas.php",
                function (data)
                {
                    console.log(data);
                     var year = [];
                     var month = [];
                    var total = [];

                    for (var i in data) {
                        year.push(data[i].year);
                        month.push(data[i].month);
                        total.push(data[i].total);
                    }

                    var chartdata = {
                        labels: year,
                        datasets: [
                            {
                                label: 'Total number of trainees per year',
                                backgroundColor: '#3fb95f',
                                borderColor: '#056b33',
                                hoverBackgroundColor: '#056b33',
                                hoverBorderColor: '#056b33',
                                data: total,
                                backgroundColor: [
                                    'rgba(105, 201, 130, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(19, 132, 49,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas1");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }
        }
        
    </script>
</html>
<?php } ?>