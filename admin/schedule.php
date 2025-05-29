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
    
  <!-- fullCalendar -->
  <link rel="stylesheet" href="plugins/fullcalendar/main.css">
  <script src="plugins/fullcalendar/main.js"></script>

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
         
    <?php
				  			 if(isset($_POST['add']))
									{

									$room_noo=$_POST['room_noo'];
									$room_type=$_POST['room_type'];

									 $queryr=mysqli_query($conn,"INSERT INTO `room` (`room_no`, `room_type`) VALUES ('$room_noo', '$room_type');");

								 if($queryr)
							{
									 echo("Succsees");
                                     
							}
							else{
								echo("fail");
							} 


							}
                           
				  
				  ?>
        
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
                                    aria-selected="false">Class/Hall Schedule</a>
                                </li>
                             
                                <li class="nav-item mb-5">
                                    <a class="nav-link link-icon-left " 
                                    id="hallList-tab" 
                                    data-toggle="tab" 
                                    href="#hallList" 
                                    role="tab" 
                                    aria-controls="hallList"
                                    aria-selected="true">Class/Hall List</a>
                                </li>
                                <li class="nav-item mb-5">
                                    <a class="nav-link link-icon-left" 
                                    id="report-tab"
                                    data-toggle="tab" 
                                    href="#report" 
                                    role="tab" 
                                    aria-controls="report"
                                    aria-selected="false">Schedule Report</a>
                                </li>

                        </ul>
				<!-- Tab panes -->
				<div class="tab-content" id="tab_content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
 
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Assembly Hall/Romm Schedules</h3>
		<!-- <div class="card-tools">
			<a href="?page=individual/manage_individual" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div id="calendar"></div>
				</div>
				<div class="col-md-4">
					<div class="callout border-0">
						<h5><b>New Schedule</b></h5>
						<hr>
						<form action="" id="add_sched">
							<input type="hidden" name="id" value="">
							<div class="form-group">
								<label for="assembly_hall_id" class="control-label">Assembly Hall/Room</label>
								<select name="assembly_hall_id" id="assembly_hall_id" class="custom-select select2" >
									<option value=""></option>
									<?php 
									$hall_qry = $conn->query("SELECT * FROM `assembly_hall` where status =0  order by `room_name` asc");
									while($row = $hall_qry->fetch_assoc()):
									?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['room_name'] ?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="reserved_by" class="control-label">Reserved By:</label>
								<input type="text" class="form-control" name="reserved_by" id="reserved_by" required>
							</div>
							<div class="form-group">
								<label for="datetime_start" class="control-label">DateTime Start:</label>
								<input type="datetime-local" class="form-control" name="datetime_start" id="datetime_start">
							</div>
							<div class="form-group">
								<label for="datetime_end" class="control-label">DateTime End:</label>
								<input type="datetime-local" class="form-control" name="datetime_end" id="datetime_end">
							</div>
							<div class="form-group">
								<label for="schedule_remarks" class="control-label">Remarks:</label>
								<textarea rows="3" class="form-control" name="schedule_remarks" id="schedule_remarks"></textarea>
							</div>
							<div class="form-group d-flex w-100 justify-content-end">
								<button class="btn btn-flat btn-primary btn-sm mr-2">Save</button>
								<button class="btn btn-flat btn-light btn-sm" type="reset">Reset</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

					</div>
                 
                    <div class="tab-pane fade " id="hallList" role="tabpanel" aria-labelledby="hallList-tab">
                    
					</div>
                    <div class="tab-pane fade " id="report" role="tabpanel" aria-labelledby="report-tab">
                    
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

	 
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-select/js/select.bootstrap4.min.js"></script>
   <!-- AdminLTE App -->
    <script src="includes/js/adminlte.js"></script>
</body>

      
<?php
$sched_qry = $conn->query("SELECT s.*,a.room_name FROM `schedule_list` s inner join assembly_hall a on a.id = s.assembly_hall_id ");
$sched_data = array();
while($row=$sched_qry->fetch_assoc()):
	$sched_data[]=$row;
endwhile;
$sched = json_encode($sched_data);
?>
<script>
	var scheds = $.parseJSON('<?php echo $sched ?>');
	$(function(){
		$('#add_sched').submit(function(e){
			e.preventDefault()
			start_loader()
			$('#add_sched .err-msg').remove()

			$.ajax({
				url:'Master.php?f=save_schedule',
				method:"POST",
				data: $(this).serialize(),
				dataType:"json",
				error:err=>{
					console.log(err)
					end_loader()
					alert_toast("An error occured","error");
				},
				success:function(resp){
					if(resp.status == 'success'){
						location.reload()
					}else if(resp.status == 'failed' && !!resp.err_msg){
						var el = $('<div class="err-msg alert alert-danger mb-1">')
							el.text(resp.err_msg)
						$('#add_sched').prepend(el)
							el.show('slow')
					}else{
						console.log(resp)
						alert_toast("An error occured","error");
					}
					end_loader();
				}
			})
		})
		$('.select2').select2({placeholder:"Please Select Hall/Room here"})
		var Calendar = FullCalendar.Calendar;
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()
		
		var calendarEl = document.getElementById('calendar');
		var calendar = new Calendar(calendarEl, {
                        headerToolbar: {
                            left  : 'prev,next today',
                            center: 'title',
                            right : 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        themeSystem: 'bootstrap',
                        //Random default events
                        events:function(event,successCallback){
                            var days = moment(event.end).diff(moment(event.start),'days')
                            var events = []
							Object.keys(scheds).map(k=>{
								events.push({
									title          : scheds[k].room_name,
									start          : moment(scheds[k].datetime_start).format("YYYY-MM-DD HH:mm"),
									end          : moment(scheds[k].datetime_end).format("YYYY-MM-DD HH:mm"),
									backgroundColor: 'var(--success)', 
									borderColor    : 'var(--primary)',
									'data-id'      : scheds[k].id
								})
							})
							console.log(events)
                            successCallback(events)
                        },
                        eventClick:function(info){
							sched_id = info.event.extendedProps['data-id']
							console.log(sched_id)
                            uni_modal("Schedule Details","schedules/view_details.php?id="+sched_id)
                        },
                        editable  : true,
                        selectable: true,
                        
				});

	calendar.render();
	})
</script>
        <script>
            if(window.history.replaceState){
                window.history.replaceState(null,null,window.location.href)
            }
            </script>
</html>
<?php } ?>