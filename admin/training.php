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
				  			 if(isset($_POST['add_topic']))
									{

									$topic_title=$_POST['topic_title'];
									$fk_event=$_POST['fk_event'];

									 $queryr_topic=mysqli_query($conn,"INSERT INTO `topic` (`topic_id`, `topic_title`, `fk_event`) VALUES (NULL, '$topic_title', '$fk_event')");

								 if($queryr_topic)
							{
									 echo("Succsees");
							}
							else{
								echo("fail");
							} 


							}
				  
				  ?>
    <?php
				  			
				  			 if(isset($_POST['add']))
									{
								 
                                    $ev_round=$_POST['ev_round'];
									$ev_tittle_subject=$_POST['ev_tittle_subject'];
									$ev_request_date=$_POST['ev_request_date'];
									$ev_start_date=$_POST['ev_start_date'];
									$ev_end_date=$_POST['ev_end_date'];
									$ev_level=$_POST['ev_level'];
									$ev_objective=$_POST['ev_objective'];
									$ev_mode_of_delivery=$_POST['ev_mode_of_delivery'];
									$ev_language=$_POST['ev_language'];
									$ev_key_note=$_POST['ev_key_note'];
								 	$fk_organization=$_POST['fk_organization'];
								 
					$allowedExts = array("pdf");
					$temp = explode(".", $_FILES["pdf_file"]["name"]);
					$extension = end($temp);
					$upload_pdf=$_FILES["pdf_file"]["name"];
					move_uploaded_file($_FILES["pdf_file"]["tmp_name"],"letters/" . $_FILES["pdf_file"]["name"]);
								 
									 $queryr=mysqli_query($conn,"INSERT INTO `event` ( `ev_round`,`ev_tittle_subject`, `ev_request_date`, `ev_request_letter`, `ev_start_date`, `ev_end_date`, `ev_level`, `ev_objective`, `ev_mode_of_delivery`, `ev_language`, `ev_key_note`, `fk_organization`) VALUES ( '$ev_round','$ev_tittle_subject', '$ev_request_date', '$upload_pdf', '$ev_start_date', '$ev_end_date', '$ev_level', '$ev_objective', '$ev_mode_of_delivery', '$ev_language', '$ev_key_note','$fk_organization')");

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
                                    aria-selected="true"><i class="zmdi zmdi-apps"></i>Training</a>
                                </li>
                                <li class="nav-item mb-5">
                                    <a class="nav-link link-icon-left" 
                                    id="topic-tab"
                                    data-toggle="tab" 
                                    href="#topic" 
                                    role="tab" 
                                    aria-controls="topic"
                                    aria-selected="false"><i class="fa fa-briefcase"></i>Topic</a>
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

                <div class="tab-pane fade " id="topic" role="tabpanel" aria-labelledby="topic-tab">
                <div class="row">
                        <div class="col-xl-12">
								<div class="row">
                                <div class="col-4" >
                                <form name="addroom" method="post" enctype="multipart/form-data" >
                                            <div class="form-group m-b-20">
                                                    <label >Training</label>
                                                    <select class="form-control" name="fk_event"  onChange="getSubCat(this.value);" >
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
                                                                // While loop must be terminatedorg
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group m-b-20 ">
                                                    <label >Topic</label>
                                                        <input type="text" class="form-control " id="topic_title" name="topic_title" placeholder="Title" >
                                                    </div>
                                                 

                                                <button type="submit" name="add_topic" class="btn btn-success waves-effect waves-light">Add</button>
                                                <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                                    </form>
                                </div>
                                <div class="col-8" >
                               
                    <section class="hk-sec-wrapper">
                                <?php
                        $result = mysqli_query($conn, "SELECT * FROM `topic` ORDER BY `topic`.`topic_id` DESC"); // using mysqli_query instead
                        ?>
                            <h5 class="hk-sec-title">Topics List</h5>
                            <input type="text" id="topicInput" onkeyup="myFunction()" placeholder="Search" class="form-control mt-15" style="width: 30%">
                            <br>
                            	<hr>		
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Topic </th>
                                                        <th>Training</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="topic_grid">
                                                    <?php
                                                        while($res = mysqli_fetch_array($result)){
                                                            $topic_ev=$res['fk_event'];
                                                            $ev_topic = mysqli_query($conn, "SELECT * FROM `event` WHERE `ev_id`=$topic_ev"); 
                                                    ?>
                                                    <tr>
                                                    <?php
                                                        while($ev_res = mysqli_fetch_array($ev_topic)){
                                                    ?>                                                       
                                                            
                                                        <td><?php echo $res['topic_title']?></td>
                                                        <td><?php echo $ev_res["ev_tittle_subject"]?></td>
                                                         <td><a href="topic/delete.php?id=<?php echo $res['topic_id']?>" onClick="return confirm('Are you sure you want to delete?')"><i class='icon-trash txt-danger'></i></a> </td>
                                                       
                                                         <?php  }?>
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
							</div>
						</div>
						<!-- /Row -->
                            
                </div>
                            <!-- /Topic -->

                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                    <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Trainings</h5>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="button-list">
                                       
                                    <div class="row"  align="right">
                                            <div class="col-sm">
                                            <div class="btn-group btn-group-sm mb-15" role="group">
                                                <button type="button" class="btn btn-success btn-rounded" data-toggle="modal" data-target="#addtraining" ><span>&#43;</span> Add New Training</button>
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
                                                            <th >Training Round</th>					  
                                                            <th >Organization</th>
                                                            <th >Subject / Tittle</th>
                                                            <th >Requested Date</th>	
                                                            <th >Starting Date</th>
                                                            <th >End Date</th>
                                                            <th >Coordinator </th>                                                           
                                                            <th >Phone</th>
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
                                    <div class="modal fade" id="addtraining" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge01" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">New Training</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">


                                                <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Add Training</h5>
                            <div class="row">
                                <div class="col-sm">
                                <form name="addtraining" method="post" enctype="multipart/form-data" >
                                        <div class="row">
                                            <div class="col-md-2 form-group">
                                            <label class=""> Round </label>
													<input type="text" class="form-control" name="ev_round" placeholder="Round" >
													 
                                            </div>
                                            <div class="col-md-4 form-group">
                                                
                                            <label class="">Customer</label>

                                            <select class="form-control" id="selorg" name="fk_organization"   required>
                                                <option value="">Select Customer </option>

                                                    <?php
                                                        $sql = "SELECT * FROM `organization`";
                                                        $all_org = mysqli_query($conn,$sql);
                                                        while ($org = mysqli_fetch_array($all_org,MYSQLI_ASSOC)):; 
                                                    ?>
                                                        <option value="<?php echo $org["org_id"];
                                                            // The value we usually set is the primary key
                                                        ?>">
                                                            <?php echo $org["org_name"];
                                                                // To show the category name to the user
                                                            ?>
                                                        </option>
                                                    <?php 
                                                        endwhile; 
                                                        // While loop must be terminated
                                                    ?>
                                                </select>
                                        </div>
                                            <div class="col-md-6 form-group">
                                            <label class=""> Tittle</label>
													<input type="text" class="form-control" name="ev_tittle_subject" placeholder="Enter Training Tittle" >
													 
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                        <section class="hk-sec-wrapper">
                                            <h5 class="hk-sec-title">Request</h5>
                                            
                                            <div class="row">
                                            <div class="col-md-6 form-group">
                                            <label class=""> Date</label>
													<input type="date" class="form-control" name="ev_request_date" placeholder="e.g yyyy-mm-dd" >

                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label class="">Letter</label>
													<input type="file" class="form-control"  name="pdf_file"  accept="application/pdf" >
												
                                            </div>
                                        </div>
                                            
                                            </section>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                            <label class="">Start Date </label>
													<input type="date" class="form-control"  name="ev_start_date" placeholder="Enter Phone" >
												
                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label class="">End Date</label> 
													<input type="date" class="form-control"  name="ev_end_date" placeholder="Enter Phone" >
													
                                            </div>
                                        </div>
                                        <div class="row">
                                           
                                            <div class="col-md-5 mb-10">
                                            <label class="">Training Level</label>
															<select class="form-control" name="ev_level"  onChange="getSubCat(this.value);" >
															<option value="">Select level </option>

															<option value="Senior">Senior</option>
																<option value="Top">Top</option>
																<option value="Mid-level">Mid-level</option>
																<option value="Emerging leaders ">Emerging leaders </option>
															</select> 
                                            </div>
                                            
                                        </div>
                                        
                                       
                                        <section class="hk-sec-wrapper">
                                        <h5 class="hk-sec-title">Objective of The Training</h5>
                                           <textarea class="summernote" name="ev_objective" style="width: 100%;height: 150px" ></textarea>
										 </section>
                                        
                                         <div class="row">
                                            <div class="col-md-6 form-group">
                                            <label class="">Mode of Delivery</label>
															<select class="form-control" name="ev_mode_of_delivery" onChange="getSubCat(this.value);" >
															<option value="">Select Mode </option>

															<option value="Online ">Online </option>
																<option value="In Class room ">In Class room </option>
																<option value="In halls ">In halls </option>
																<option value="On job training ">On job training </option>
																<option value="Outside/field visit ">Outside/field visit </option>

															</select> 	
                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label  >Medium of Communication</label>
													<input type="text" class="form-control"  name="ev_language" placeholder="Enter Language" >
															
                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label >Key note Speaker</label>
													<input type="text" class="form-control" name="ev_key_note" placeholder="Enter Key note Speaker" >
																	
                                            </div>
                                        </div>

                                       
                                        <hr>
                                        <button type="submit" name="add" class="btn btn-success waves-effect waves-light">Add</button>
												<button type="reset" class=" btn btn-danger waves-effect waves-light">Discard</button>
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
                        $result = mysqli_query($conn, "SELECT * FROM `event` ORDER BY `event`.`ev_id` DESC"); // using mysqli_query instead
                        ?>
					<section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Manage Training</h5>
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
                                                        <th>Organization</th>
                                                        <th>Training Subject / Title</th>
                                                        <th>Starting Date</th>
                                                        <th>End Date</th>
                                                        <th>Level</th>
                                                        <th>Objective</th>
                                                        <th>Mode of Delivery</th>
                                                        <th>Medium of Communication</th>
                                                        <th>Key Note Speaker</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="training_grid">
                                                    <?php
                                                        while($res = mysqli_fetch_array($result)){
                                                    ?>
                                                    <tr>  
                                                                       
                                                    <?php
                                                        $or_id=$res ['fk_organization']; 
                                                        $sql = "SELECT * FROM `organization` WHERE `org_id`= $or_id";
                                                        $all_org = mysqli_query($conn,$sql);
                                                        while ($org = mysqli_fetch_array($all_org,MYSQLI_ASSOC)):; 
                                                    ?>
                                                        
                                                        
                                                        <td><a href=""><?php echo $res['ev_tittle_subject']?></a></td>
                                                        <td><?php echo $org['org_name']?></td>
                                                        <td><?php echo $res['ev_start_date']?></td>
                                                        <td><?php echo $res['ev_end_date']?></td>
                                                        <td><?php echo $res['ev_level']?></td>
                                                        <td><?php echo $res['ev_objective']?></td>
                                                        <td><?php echo $res['ev_mode_of_delivery']?></td>
                                                        <td><?php echo $res['ev_language']?></td>
                                                        <td><?php echo $res['ev_key_note']?></td>
                                                         <td><a href=""data-toggle='modal' data-target="#editev<?php echo $res['ev_id']?>"><i class='icon-pencil'></i></a>&nbsp;&nbsp;<a href="trainingstb/delete_event.php?id=<?php echo $res['ev_id']?>" onClick="return confirm('Are you sure you want to delete?')"><i class='icon-trash txt-danger'></i></a> </td>
                                                        	
                                                    
                                                    </tr>
                                                    <?php include 'trainingstb/edit_event.php';
                                                    endwhile; 
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
			
                        <!-- Floating Toggle Button -->
            <div id="chat-toggle" onclick="toggleChat()">💬</div>

            <!-- Chat Widget -->
            <div id="chat-widget">
            <div id="chat-header" onclick="toggleChat()">AI Assistant</div>
            <div id="chatbox"></div>
            <div id="chat-input-area">
                <input type="text" id="user-input" placeholder="Type a message..." onkeypress="if(event.key === 'Enter') sendMessage()">
                <button id="send-btn" onclick="sendMessage()">Send</button>
            </div>
            </div>
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
	
	
	<!-- Dropify JavaScript -->
	<script src="vendors/dropify/dist/js/dropify.min.js"></script>
	
	<!-- Form Flie Upload Data JavaScript -->
	<script src="dist/js/form-file-upload-data.js"></script>
	<!-- Select2 JavaScript -->
<script src="vendors/select2/dist/js/select2.full.min.js"></script>



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
                $("#topicInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#topic_grid tr").filter(function() {
                        $(this).toggle($(this).text()
                        .toLowerCase().indexOf(value) > -1)
                    });
                });
            });
            $(document).ready(function() {
                $('#selorg').select2();
            });
        </script>
<script>
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"trainingstb/ajax-data.php", // json datasource
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
            const chatWidget = document.getElementById('chat-widget');
  const chatToggle = document.getElementById('chat-toggle');

  function toggleChat() {
    chatWidget.style.display = chatWidget.style.display === 'flex' ? 'none' : 'flex';
  }

  async function sendMessage() {
    const inputBox = document.getElementById('user-input');
    const chatbox = document.getElementById('chatbox');
    const userText = inputBox.value.trim();
    if (!userText) return;

    chatbox.innerHTML += `<div class="message"><b>You:</b> ${userText}</div>`;
    inputBox.value = '';
    chatbox.scrollTop = chatbox.scrollHeight;

    const response = await fetch('chatbot.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({ message: userText })
    });

    const data = await response.json();
    chatbox.innerHTML += `<div class="message"><b>TMS Assistant:</b> ${data.reply}</div>`;
    chatbox.scrollTop = chatbox.scrollHeight;
  }

</script>
</html>
<?php } ?>