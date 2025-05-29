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
         
    <?php
				  			 if(isset($_POST['add']))
                               {

                               $trner_title=$_POST['trner_title'];
                               $trner_first_name=$_POST['trner_first_name'];
                               $trner_middle_name=$_POST['trner_middle_name'];
                               $trner_last_name=$_POST['trner_last_name'];
                               $trner_birth_date=$_POST['trner_birth_date'];
                               $trner_gender=$_POST['trner_gender'];
                               $trner_email=$_POST['trner_email'];
                               $trner_phone=$_POST['trner_phone'];
                                $trner_region=$_POST['trner_region'];
                                $trner_city=$_POST['trner_city'];
                               $trner_sub_city=$_POST['trner_sub_city'];
                               $trner_inistitute=$_POST['trner_inistitute'];
                               $trner_edu=$_POST['trner_edu'];
                               $fk_topic=$_POST['topic'];
                               $fk_room=$_POST['rooms'];
                               $fk_event=$_POST['event'];
                            
                              $queryr=mysqli_query($conn,"INSERT INTO `trainer` ( `trner_title`,`trner_first_name`,`trner_middle_name`, 
                              `trner_last_name`,`trner_birth_date`,`trner_gender`,`trner_email`, `trner_phone`, `trner_region`, `trner_city`, 
                               `trner_sub_city`, `trner_inistitute`,`trner_edu`, `fk_topic`, `fk_room`, `fk_event`)
                               VALUES ('$trner_title', '$trner_first_name', '$trner_middle_name',
                                '$trner_last_name', '$trner_birth_date','$trner_gender', '$trner_email', '$trner_phone', '$trner_region', ' $trner_city', '$trner_sub_city', 
                                 '$trner_inistitute','$trner_edu', '$fk_topic', '$fk_room', '$fk_event');");
               

                            if($queryr)
                       {
                                
                                echo("Succsees");
                                $room_query=mysqli_query($conn,"UPDATE `room` SET `room_booked` = 'Booked' WHERE `room`.`room_no` = '$fk_room';");
                                $room_date=mysqli_query($conn,"UPDATE `room`LEFT JOIN `trainer` ON `room`.`room_no`=`trainer`.`fk_room` LEFT JOIN `event` ON `trainer`.`fk_event` SET `room`.`check_in_date`= `event`.`ev_start_date`, `room`.`check_out_date`=`event`.`ev_end_date` WHERE `room`.`room_no`='$fk_room'");
                                $tr_date=mysqli_query($conn,"UPDATE `room`LEFT JOIN `trainer` ON `room`.`room_no`=`trainer`.`fk_room` LEFT JOIN `event` ON `trainer`.`fk_event` SET `trainer`.`trner_check_in_date`=`event`.`ev_start_date` , `trainer`.`trner_check_out_date`=`event`.`ev_end_date` WHERE `room`.`room_no`='$fk_room'");
                                   // While loop must be terminated
                                   
                           

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
                                    aria-selected="true"><i class="zmdi zmdi-apps"></i>Trainee</a>
                                </li>
                                <li class="nav-item mb-5">
                                    <a class="nav-link link-icon-left" 
                                    id="profile-tab"
                                    data-toggle="tab" 
                                    href="#profile" 
                                    role="tab" 
                                    aria-controls="profile"
                                    aria-selected="false"><i class="fa fa-briefcase"></i>Manage</a>
                                </li>

                        </ul>
				<!-- Tab panes -->
				<div class="tab-content" id="tab_content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                    <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Trainees</h5>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="button-list">
                                       
                                    <div class="row"  align="right">
                                            <div class="col-sm">
                                            <div class="btn-group btn-group-sm mb-15" role="group">
                                                <button type="button" class="btn btn-success btn-rounded" data-toggle="modal" data-target="#addtrainee" ><span>&#43;</span> Add New Trainer</button>
                                                </div>
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row -->
						<div class="row">
                            
                            <div class="col-xl-12">
                            <section class="hk-sec-wrapper">
                                
                                <div class="row">
                                    
                                    <div class="col-sm">
                                        <div class="table-wrap">
                                   <div id="datable_5_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table id="lookup" class="table table-hover w-100 display dataTable no-footer dtr-inline collapsed" role="grid" style="width: 100%;">
                            
                                                    <thead class="table-dark">
                                                    <tr role="row">	
                                                        
                                                    <th ></th>						  
                                                    <th >First Name</th>
                                                    <th >Middle Name</th>
                                                    <th >Last Name</th>
                                                    <th >Phone</th>
                                                    <th >Check in Date</th>
                                                    <th >Check out Date</th>
                                                    <th >Room</th>
                                                    <th >Organization</th>
                                                    <th >Training</th>
                                                    <th >Topic</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
                                   
                                </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                                </div>
                            </div>
                            <!-- /Row -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="addtrainee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge01" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">New Trainer</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                <section class="hk-sec-wrapper">
                           <div class="row">
                                <div class="col-sm">
                                    <form name="addtrainer" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label class="required" >Title</label>
                                            <select class="form-control" name="trner_title"  onChange="getSubCat(this.value);" required>
                                            <option value="">Select Title </option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Miss.">Miss.</option>
                                                <option value="Dr.">Dr.</option>
                                                <option value="Pro.">Pro.</option>
                                                <option value="President.">President.</option>
                                                <option value="Ambassador">Ambassador.</option>
                                                <option value="Minister.">Minister.</option>

                                            </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="firstName">First name</label>
                                                <input class="form-control" name="trner_first_name" placeholder="First name" value="" type="text">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="lastName">Middle name</label>
                                                <input class="form-control" name="trner_middle_name" placeholder="Middle name" value="" type="text">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="lastName">Last name</label>
                                                <input class="form-control" name="trner_last_name" placeholder="Last name" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label > Date of Birth</label>
								            <input type="date" class="form-control"  name="trner_birth_date" placeholder="Enter Date of Birth" >
										
                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label class="required" >Gender</label>
                                            <select class="form-control" name="trner_gender"  onChange="getSubCat(this.value);" required>
                                            <option value="">Select Gender </option>
                                            
                                            <option value="Male">Male</option>
                                                <option value="Female">Female</option>

                                            </select>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <h5 class="hk-sec-title">Adress</h5>
                                        <div class="row">
                                        <div class="col-md-4 mb-10">
                                        <label class="required"> Region </label>
								<input type="text" class="form-control"  name="trner_region" placeholder="Region" required>
								         </div>
                                        <div class="col-md-4 mb-10">
                                        <label class="required"> City </label>
								<input type="text" class="form-control"  name="trner_city" placeholder="Enter City" required>
								         </div>
                                            <div class="col-md-4 mb-10">
                                            <label > Sub-City </label>
								<input type="text" class="form-control"  name="trner_sub_city" placeholder="Sub-City " >
								
                                            </div>
                                            <div class="col-md-6 mb-10">
                                            <label >Phone Number :</label>
								<input type="tel" name="trner_phone" class="form-control" pattern="^\d{10}$" placeholder="(format: xxxxxxxxxx)" >
							
                                            </div>
                                            <div class="col-md-6 mb-10">
                                            <label >email</label>
								<input type="email" class="form-control"  name="trner_email" placeholder="you@example.com" >
								
                                            </div>
                                           
                                            </div>
                                        
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">Institution</label>
                                                <input class="form-control" name="trner_inistitute" placeholder="Institution" value="" type="text">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Level of Education</label>
                                                <input class="form-control" name="trner_edu" placeholder="Level of Education" value="" type="text">
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                        <div class="col-md-6 mb-10">
                                            <label class="required">Training</label>
									
                                            <select class="form-control" name="event"  onChange="getSubCat(this.value);" required>
                                                <option value="">Select Training </option>
                                                
                                                    <?php
                                                        $sql = "SELECT * FROM `event`";
                                                        $all_ev = mysqli_query($conn,$sql);
                                                        while ($ev = mysqli_fetch_array($all_ev,MYSQLI_ASSOC)):; 
                                                    ?>
                                                        <option value="<?php echo $ev["ev_id"];
                                                            // The value we usually set is the primary key
                                                        ?>">
                                                            <?php echo $ev["ev_tittle_subject"];
                                                                // To show the category name to the user
                                                            ?>
                                                        </option>
                                                    <?php 
                                                        endwhile; 
                                                    ?>
                                                   
                                                </select>
                                            </div>

                                        <div class="col-md-6 mb-10">
                                            <label class="required">Training Tospic</label>
									
                                            <select class="form-control" name="topic"  onChange="getSubCat(this.value);" required>
                                                <option value="">Select Topic</option>
                                                
                                                <?php
                                                    $sql = "SELECT * FROM `topic`";
                                                    $all_topic = mysqli_query($conn,$sql);
                                                    while ($tp = mysqli_fetch_array($all_topic,MYSQLI_ASSOC)):; 
                                                ?>
                                                          <option value="<?php echo $tp["topic_id"];
                                                        // The value we usually set is the primary key
                                                    ?>">
                                                        <?php echo $tp["topic_title"];
                                                            // To show the category name to the user
                                                        ?>
                                                    </option>
                                                    <?php 
                                                        endwhile; 
                                                        // While loop must be terminatedorg
                                                    ?>
                                                </select>
                                        
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                            <label class="required">Assign Room</label>
								
                                            <select class="form-control " name="rooms"  onChange="getSubCat(this.value);" data-live-search="true" required>
                                                <option value="">Select Room </option>
                                                
                                                    <?php
                                                        $sql = "SELECT * FROM `room` WHERE `room_booked`='Available' ORDER BY `room`.`room_no`";
                                                        $all_room = mysqli_query($conn,$sql);
                                                        while ($rooms = mysqli_fetch_array($all_room,MYSQLI_ASSOC)):; 
                                                    ?>
                                                        <option value="<?php echo $rooms["room_no"];
                                                        ?>">
                                                            <?php echo $rooms["room_no"];
                                                                // To show the category name to the user
                                                            ?>
                                                        </option>
                                                    <?php 
                                                        endwhile; 
                                                        // While loop must be terminated
                                                    ?>
                                                </select>
                                            </div>
                                          
                                        </div>


                                        <hr>
                                        <button type="submit" name="add" class="btn btn-success waves-effect waves-light">Add</button>
								        <br>
                                   </form>
                                </div>
                            </div>
                        </section>
                        

                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </section>

                    	
					</div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                     

                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM `trainer` WHERE `trner_deleted`='0' ORDER BY `trainer`.`trner_id` DESC"); // using mysqli_query instead
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
                                                    

                                                        <th>Full Name</th>
                                                        <th>Age</th>
                                                        <th>Gender</th>
                                                        <th>e-mail</th>
                                                        <th>Phone</th>
                                                        <th>Rigion</th>
                                                        <th>City</th>
                                                        <th>Sub-city</th>
                                                        <th>Level of Education</th>
                                                        <th>Institution</th>
                                                        <th>Training</th>
                                                        <th>Topic</th>
                                                        <th>Assigned Room</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="training_grid">
                                                    <?php
                                                        while($res = mysqli_fetch_array($result)){
                                                    ?>
                                                    <tr>  
                                                                       
                                                    <?php
                                                        $topic_id=$res ['fk_topic']; 
                                                        $sql = "SELECT * FROM `topic` WHERE `topic_id`= $topic_id";
                                                        $all_topic = mysqli_query($conn,$sql);
                                                        while ($topic = mysqli_fetch_array($all_topic,MYSQLI_ASSOC)):; 

                                                        $age=$res['trner_birth_date'];
                                                        if($age=='0000-00-00'||$age=='NULL'){
                                                            $diff='NuLL';
                                                        }else{
                                                            
                                                            $diff = (date('Y') - date('Y',strtotime($age)));
                                                        }

                                                    ?>
                                                    
                                                   
                                                        <td><a href="trainee_detail.php?id=<?php echo $res['trner_id']?>"><?php echo $res['trner_title']?>&nbsp;<?php echo $res['trner_first_name']?>&nbsp;<?php echo $res['trner_middle_name']?>&nbsp;<?php echo $res['trner_last_name']?></a></td>
                                                        <td><?php echo $diff?></td>
                                                        <td><?php echo $res['trner_gender']?></td>
                                                        <td><?php echo $res['trner_email']?></td>
                                                        <td><?php echo $res['trner_phone']?></td>
                                                        <td><?php echo $res['trner_region']?></td>
                                                        <td><?php echo $res['trner_city']?></td>
                                                        <td><?php echo $res['trner_sub_city']?></td>
                                                        <td><?php echo $res['trner_edu']?></td>
                                                        <td><?php echo $res['trner_inistitute']?></td>
                                                        <?php
                                                        $trner_ev_id=$res ['fk_event']; 
                                                        $sql2 = "SELECT * FROM `event` WHERE `ev_id`= $trner_ev_id";
                                                        $all_ev = mysqli_query($conn,$sql2);
                                                        while ($ev = mysqli_fetch_array($all_ev,MYSQLI_ASSOC)):; 
                                                    ?>
                                                        <td><?php echo $ev['ev_tittle_subject']?></td>

                                                        <?php endwhile; ?>
                                                        <td><?php echo $topic['topic_title']?></td>
                                                        <?php endwhile; ?>

                                                        <td><?php echo $res['fk_room']?></td>

                                                       
                                                         <td><a href=""data-toggle='modal' data-target="#editTr<?php echo $res['trner_id']?>"><i class='icon-pencil'></i></a>&nbsp;&nbsp;<a href="trainerstb/delete_trainer.php?id=<?php echo $res['trner_id']?>" onClick="return confirm('Are you sure you want to delete?')"><i class='icon-trash txt-danger'></i></a> </td>
                                                        	
                                                    
                                                    </tr>
                                                    <?php include 'trainerstb/edit_trainer.php';
                                                    
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
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"trainerstb/ajax-data.php", // json datasource
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
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });
            </script>
            <script>
            if(window.history.replaceState){
                window.history.replaceState(null,null,window.location.href)
            }
            </script>
</html>
<?php } ?>