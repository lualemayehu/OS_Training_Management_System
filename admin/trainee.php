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
                                    aria-selected="true"><i class="zmdi zmdi-account-circle"></i>Trainees </a>
                                </li>
                                

                        </ul>
				<!-- Tab panes -->
				<div class="tab-content" id="tab_content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="button-list">
                                    <div class="row"  align="right">
                                            <div class="col-sm">
                                            <div class="btn-group btn-group-sm mb-15" role="group">
                                                <button type="button" class="btn btn-success btn-rounded" data-toggle="modal" data-target="#addtrainee" ><span>&#43;</span> Add New Participant </button>
                                                </div>
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                    <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Trainees List</h5>
                            
                            <div class="row">
                                <div class="col-sm">
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
                                                        <th>Full Name</th>
                                                        <th>Levels of Education</th>
                                                        <th>Training Organizer</th>
                                                        <th>Trainee Inistitute</th>
                                                        <th>Phone</th>
                                                        <th>email</th>
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
                                                    <h5 class="modal-title">New Participant </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">


                                                <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                <form name="addtrainee" method="post" enctype="multipart/form-data" action="traineestb/addTrainee.php">
                                      
                                    <div class="row">
                                    <div class="col-md-6 mb-10">
                                                <label class="req">Organization</label>

                                    <select class="selorg" name="organization">
                                        <option value="">Select Organization </option>          
                                                    
                                                    <?php
                                                            $sql = "SELECT * FROM `organization`";
                                                            $all_org = mysqli_query($conn,$sql);
                                                            while ($org = mysqli_fetch_array($all_org,MYSQLI_ASSOC)):; 
                                                            $org_id=$org["org_id"]
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
                                                        ?>
                                    </select>
                                    </div>
                                        
                                                <div class="col-md-6 mb-10">
                                                <label class="">Training</label>
                                                <select  class="selev" name="event" >
                                                
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
                                    </div>
                                        
                                        <div class="form-group">
                                         <label for="input_tags">Select Topics</label>
                                            <select class="js-example-basic-multiple" name="topic[]" multiple="multiple">
                                        
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
                                        <div class="row">
                                        <div class="col-sm-8">
                                        <div class="card-box">
                                        <label class="" >Photo</label>
                                        <input type="file" class="form-control"  name="cust_img"  >
                                        <br>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        
                                         <div class="col-md-3 form-group">
                                            <label class="" >Title</label>
                                            <input type="text" class="form-control"  name="cust_title" placeholder="Title" required >
								
                                            </div>
                                            <div class="col-md-4 mb-10">
                                            <label class="req"> First Name</label>
								            <input type="text" class="form-control"  name="cust_first_name" placeholder="Enter First Name" required >
								
                                            </div>
                                            <div class="col-md-4 mb-10">
                                            <label class="req" > Middle Name</label>
								            <input type="text" class="form-control" name="cust_middle_name" placeholder="Enter Middle Name"required >
								
                                            </div>
                                            <div class="col-md-4 mb-10">
                                            <label class="req" > Last Name</label>
								            <input type="text" class="form-control" name="cust_last_name" placeholder="Enter Last Name"required >
								
                                            </div>
                                           
                                       
                                        </div>
                                        <div class="row">
                                        <div class="col-md-3 mb-10">
 
                                            <label class="" >Levels of education</label>
                                            <select id= "edu" class="form-control" name="cust_edu"   >
                                            <option value="">Select </option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="Degree">Degree</option>
                                                <option value="M.Sc.">M.Sc.</option>
                                                <option value="LLM.">LLM.</option>
                                                <option value="MBA.">MBA.</option>
                                                <option value="MA.">MA.</option>
                                                <option value="Ph.D.">Ph.D.</option>
                                                <option value="Assoc. Prof.">Assoc. Prof.</option>
                                                <option value="Prof.">Prof.</option>

                                            </select>
                                            
                                            </div> 
                                        <div class="col-md-4 mb-10">
                                            <label > Institution</label>
								            <input type="text" class="form-control"  name="cust_inistitute" placeholder="Job Tittle/Position"  >
										
                                            </div>
                                        <div class="col-md-4 mb-10">
                                            <label > Position</label>
								            <input type="text" class="form-control"  name="cust_position" placeholder="Job Tittle/Position"  >
										
                                            </div>
                                              
                                            <div class="col-md-4 mb-10">
                                            <label class="" ></label>
                                            <input type="hidden" class="form-control"  name="cust_type" value="Trainee">
								            </div> 
                                        
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label > Date of Birth</label>
								<input type="date" class="form-control"  name="cust_dob" placeholder="Enter Date of Birth" >
										
                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label class="req" >Gender</label>
                                            <select class="form-control" name="cust_gender"  onChange="getSubCat(this.value);" required>
                                            <option value="">Select Gender </option>
                                            
                                            <option value="Male">Male</option>
                                                <option value="Female">Female</option>

                                            </select>
                                            </div>
                                            <div class="col-md-3 mb-10">
                                            <label class="">Disability tatus</label>
                                            <select class="form-control" name="cust_disability_status"  onChange="getSubCat(this.value);" >
                                            <option value="">Select Status </option>
                                            
                                            <option value="Non Disabled">Non Disabled</option>
                                                <option value="Disabled">Disabled</option>

                                            </select> 
                                            </div>
                                        </div>
                                        <div class="row">
                                        <section class="hk-sec-wrapper">
                                            
                                            <h5 class="hk-sec-title">Adress</h5>
                                                <div class="row">
                                                <div class="col-md-4 mb-10">
                                            <label class=""> Country </label>
                                    <input type="text" class="form-control"  name="cust_country" placeholder="Enter Country" >
                                    
                                                </div>
                                                <div class="col-md-4 mb-10">
                                            <label class=""> Region </label>
                                    <input type="text" class="form-control"  name="cust_region" placeholder="Enter Region" >
                                    
                                                </div>
                                                <div class="col-md-4 mb-10">
                                            <label class=""> City </label>
                                    <input type="text" class="form-control"  name="cust_city" placeholder="Enter City" >
                                    
                                                </div>
                                                <div class="col-md-4 mb-10">
                                                <label > Sub-City </label>
                                    <input type="text" class="form-control"  name="cust_sub_city" placeholder="Enter Sub-City" >
                                    
                                                </div>
                                                <div class="col-md-4 mb-10">
                                                <label >Phone Number :</label>
                                    <input type="tel" name="cust_phone" class="form-control"  placeholder="(format: xxxxxxxxxx)" >
                                
                                                </div>
                                                <div class="col-md-4 mb-10">
                                                <label >email</label>
                                    <input type="email" class="form-control"  name="cust_email" placeholder="Enter email" >
                                    
                                                </div>
                                               <div class="col-md-3 mb-10">
                                        <label>Trainee or Trainer</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cust_type" value="Trainee" id="cust_type">
                                            <label class="form-check-label" for="roleTrainee">Trainee</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cust_type" value="Trainer" id="cust_type">
                                            <label class="form-check-label" for="roleTrainer">Trainer</label>
                                        </div>
                                                
                                                </div>
                                            </section>
                                        </div>

                                    <div class="row">
                                            <div class="form-group col-md-6 ">
                                            <label class="req">Assign ID</label>
								
                                            
                                            <select id='selrooms' class="form-control req" name="rooms"  required>
                                                <option value="">Select ID </option>
                                                
                                                    <?php
                                                        $sql = " SELECT * FROM `room` WHERE `status` IS NULL ";
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

                <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab">
                

                </div>
                <div class="tab-pane fade" id="guest" role="tabpanel" aria-labelledby="guest-tab">

                   
                    
					
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

<!-- Notification -->
<script src="dist/js/sweetalert2.all.min.js"></script>

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
						url :"traineestb/traineedata.php", // json datasource
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