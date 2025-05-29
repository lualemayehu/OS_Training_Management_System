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
         
   
    <?php
				  			
				  
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
                                    aria-selected="true"><i class="zmdi zmdi-apps"></i>Organization</a>
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
                            <h5 class="hk-sec-title">Organization</h5>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="button-list">
                                       
                                    <div class="row"  align="right">
                                            <div class="col-sm">
                                            <div class="btn-group btn-group-sm mb-15" role="group">
                                                <button type="button" class="btn btn-success btn-rounded" data-toggle="modal" data-target="#addOrg" ><span>&#43;</span> Add New Customer</button>
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
                                                            <th >Name</th>
                                                            <th >Region</th>	
                                                            <th >City</th>
                                                            <th >Phone</th>							  
                                                            <th >Secondary Phone</th>
                                                            <th > e-mail</th>
                                                            <th >Training to come</th>
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
                                    <div class="modal fade" id="addOrg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge01" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">New Organization</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                
                                        <form name="addOrg" method="post" action="orgtb/addOrg.php">
                                        
                                       <div class="row">
                                            <div class="col-md-4 form-group">
                                            <label class="" >Type</label>
                                            <select class="form-control" id="org_type" name="org_type"  onChange="getSubCat(this.value);" >
                                            <option value="">Select </option>
                                                <option value="Non Government">Non Government</option>
                                                <option value="Government">Government</option>

                                            </select>
                                        </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Name</label>
                                                <input class="form-control" id="org_name" name="org_name" placeholder="Name" value="" type="text">
                                            </div>
                                            
                                        </div>
                                       
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label for="lastName">Country</label>
                                                <input class="form-control" id="org_country" name="org_country" placeholder="Country" value="" type="text">
                                            </div>
                                            <div class="col-md-5 mb-10">
                                                <label for="firstName">Region</label>
                                                <input class="form-control" id="org_region" name="org_region" placeholder="" value="" type="text">
                                            
                                            </div>
                                            <div class="col-md-4 mb-10">
                                                <label for="lastName">City</label>
                                                <input class="form-control" id="org_city" name="org_city" placeholder="" value="" type="text">
                                            
                                            </div>
                                            <div class="col-md-3 mb-10">
                                                <label for="lastName">Sub-City</label>
                                                <input class="form-control" id="org_sub_city" name="org_sub_city" placeholder="" value="" type="text">
                                           </div>
                                           <div class="col-md-3 mb-10">
                                                <label for="lastName">Woreda</label>
                                                <input class="form-control" id="org_woreda" name="org_woreda" placeholder="" value="" type="text">
                                           </div>
                                         
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" id="org_email" name="org_email" placeholder="name@example.com" type="email">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstPhone">Phone</label>
                                                <input type="number" class="form-control" id="org_phone" name="org_phone" placeholder="Enter  Phone" value="" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="secondPhone">Alternative Phone</label>
                                                <input type="number" class="form-control" id="org_phone_2" name="org_phone_2" placeholder="Enter Alternative Phone" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-4 mb-10" >
                                            <section class="hk-sec-wrapper"style="height: 80%;">
                                                    <h5 class="hk-sec-title">Logo</h5>
                                                    
                                                         <div class="dropify-wrapper" style="height: 80%;">
                                                             <div class="dropify-message">
                                                                 
                                                                 <span class="file-icon"></span>
                                                             <p>Drag and drop a file here or click</p>
                                                             <p class="dropify-error">something wrong appended.</p></div>
                                                             <div class="dropify-loader"></div>
                                                             <div class="dropify-errors-container"><ul></ul></div>
                                                             <input type="file" id="org_logo" name="org_logo" class="dropify">
                                                             <button type="button" class="dropify-clear">Remove</button>
                                                             <div class="dropify-preview">
                                                                 <span class="dropify-render"></span>
                                                             <div class="dropify-infos"><div class="dropify-infos-inner">
                                                                 <p class="dropify-filename"><span class="file-icon"></span> 
                                                                 <span class="dropify-filename-inner"></span></p>
                                                            <p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
                                                   
                                                </section>
                                        </div>
                                        </div>
                                        
                                 
                                          
                                                </div>
                                                <div class="modal-footer">
                                                      <hr>
                                                    <button type="submit" name="add" class="btn btn-primary">Add </button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                </div>

                                         </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </section>

                    	
					</div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                     

                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM `organization` ORDER BY `organization`.`org_id` DESC"); // using mysqli_query instead
                        ?>
					<section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Manage Organization</h5>
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
                                                        <th>Region</th>
                                                        <th>Sub-City</th>
                                                        <th>Woreda</th>
                                                        <th>City</th>
                                                        <th>Phone</th>
                                                        <th>Second Phone</th>
                                                        <th>E-mail</th>
                                                        <th>Type</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="org_grid">
                                                    <?php
                                                        while($res = mysqli_fetch_array($result)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $res['org_name']?></td>
                                                        <td><?php echo $res['org_region']?></td>
                                                        <td><?php echo $res['org_sub_city']?></td>
                                                        <td><?php echo $res['org_woreda']?></td>
                                                        <td><?php echo $res['org_city']?></td>
                                                        <td><?php echo $res['org_phone']?></td>
                                                        <td><?php echo $res['org_phone_2']?></td>
                                                        <td><?php echo $res['org_email']?></td>
                                                        <td><?php echo $res['org_type']?></td>
                                                         <td><a href=""data-toggle='modal' data-target="#editOrg<?php echo $res['org_id']?>"><i class='icon-pencil'></i></a>&nbsp;&nbsp;<a href="orgtb/delete_org.php?id=<?php echo $res['org_id']?>" onClick="return confirm('Are you sure you want to delete?')"><i class='icon-trash txt-danger'></i></a> </td>
                                                        		
                                                    
                                                    </tr>
                                                    <?php include 'orgtb/edit.php';
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
	


</body>
<script>
            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#org_grid tr").filter(function() {
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
						url :"orgtb/ajax-data.php", // json datasource
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