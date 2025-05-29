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
         include 'download.php';
         $doc_id = $_GET['docid'];
         
         $query = "SELECT * FROM training_documents WHERE doc_id = '$doc_id'";
           $result = mysqli_query($conn, $query);
           if(!$result){
             echo "Can't retrieve data " . mysqli_error($conn);
             exit;
           }
         
           $row = mysqli_fetch_assoc($result);
           if(!$row){
             echo "Empty book";
             exit;
           }
         ?>
   
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
		
            <div class="row">
                <div class="col-md-3 text-center">
                <img class="img-responsive img-thumbnail" src="training_doc/doc_images/<?php echo $row['doc_image']; ?>"><br><?php echo $row['doc_title']; ?>
                </div>
                <div class="col-md-6">
                <h4>Document Description</h4>
                <p><?php echo $row['doc_descr']; ?></p>
                <h4>Document Details</h4>
                <table class="table">
                    <?php foreach($row as $key => $value){
                    if($key == "doc_descr" || $key == "doc_image" || $key == "doc_title"|| $key == "doc_file"){
                        continue;
                    }
                    switch($key){
                        case "doc_id":
                        $key = "ISBN";
                        break;
                        case "doc_title":
                        $key = "Title";
                        break;
                        case "doc_author":
                        $key = "Author";
                        break;
                        case "doc_trainer":
                            $key = "Trainer";
                            break;
                    case "doc_file":
                        $key = "File name";
                        break;
                    case "uploaded_date":
                        $key = "Uploaded Date";
                        break;
                    }
                    ?>
                    <tr>
                    <td><?php echo $key; ?></td>
                    <?php 
                        if($key=="Trainer"){
                            $sqlt = "SELECT `cust_first_name`,`cust_middle_name`,`cust_title` FROM `customer` WHERE `cust_type`='Trainer' AND `cust_id`= $value AND `deleted`='0' ";
                            $all_trainer = mysqli_query($conn,$sqlt);
                            while ($trainer = mysqli_fetch_array($all_trainer,MYSQLI_ASSOC)):; 
                            ?>
                            <td><?php echo $trainer["cust_title"];?>&nbsp;<?php echo $trainer['cust_first_name']?>&nbsp;<?php echo $trainer['cust_middle_name']?></td>
                            <?php  endwhile; 
                            } else{
                             ?>   
                                <td><?php echo $value; ?></td>
                           <?php }
                            
                            ?>
                       
                    
                    </tr>
                    <?php 
                    } 
                    ?>
                </table>
                    
                <form method="post" action="document.php">
                        <a href="download.php?file_id=<?php echo $doc_id ?>"><button type="button" class="btn waves-effect waves-light">Download</button></a>
                        
                        <a href="training_doc/delete_doc.php?doc_id=<?php echo $doc_id ?>"> <button type="button" class="btn btn-danger waves-effect waves-light">Delete</button></a>
                
                </form>
                    
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




	<script>
        
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
</body>

</html>
<?php } ?>