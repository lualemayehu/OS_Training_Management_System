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
  <!-- AZ list-->
  <link href="dist/css/doc.css" rel="stylesheet" type="text/css">
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

                                        
                                        if (isset($_GET['pageno'])) {
                                                $pageno = $_GET['pageno'];
                                            } else {
                                                $pageno = 1;
                                            }
                                            $no_of_records_per_page = 30;
                                            $offset = ($pageno-1) * $no_of_records_per_page;


                                            $total_pages_sql = "SELECT COUNT(*) FROM training_documents";
                                            $result = mysqli_query($conn,$total_pages_sql);
                                            $total_rows = mysqli_fetch_array($result)[0];
                                            $total_pages = ceil($total_rows / $no_of_records_per_page);
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
            <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Training Documents</h5>
                           
                            <div class="row">
                                <div class="col-sm">
                                    <div class="button-list">
                                       <div class="row"  align="right">
                                               <div class="col-sm">
                                               <div class="btn-group btn-group-sm mb-15" role="group">
                                                   <button type="button" class="btn btn-success btn-rounded" data-toggle="modal" data-target="#adddoc" ><span>&#43;</span> Add New Trainee</button>
                                                   </div>
                                                   <br>
                                                   
                                               </div>
                                           </div>
                                       </div>
                                
                                    <!-- Modal -->
                                    <div class="modal fade" id="adddoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge01" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Document</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                        <div class="modal-body">
                                                   
                             <form name="add_book" method="post" enctype="multipart/form-data" action="training_doc/add_doc.php">
                             <div class="row">
                                            <div class="col-md-5 mb-10">
                                <div class="form-group m-b-20">
                                <label for="exampleInputEmail1">Document ISBN</label>
                                    <!-- international standard book number-->
                                <input type="text" class="form-control" name="doc_id" placeholder="Enter ISBN Number" required>
                                </div>
                                            </div>
                                            <div class="col-md-5 mb-10">
                                                
                                <div class="form-group m-b-20">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" name="doc_title" placeholder="Enter Title" required>
                                </div>
                                            </div>
                                            <div class="col-md-5 mb-10">
                                <div class="form-group m-b-20">
                                <label for="exampleInputEmail1">Author</label>
                                <input type="text" class="form-control" name="doc_author" placeholder="Enter Author" required>
                                </div>
                                            </div>
                                            <div class="col-md-5 mb-10">
                                            <div class="form-group m-b-20">
                                <label for="exampleInputEmail1">Trainer</label>
                                
                                <select class="form-control" name="doc_trainer"  onChange="getSubCat(this.value);" required>
                                    <option value="">Select Trainer </option>
                                    
                                        <?php
                                            $sqlt = "SELECT * FROM `trainer`";
                                            $all_trainer = mysqli_query($conn,$sqlt);
                                            while ($trainer = mysqli_fetch_array($all_trainer,MYSQLI_ASSOC)):; 
                                        ?>
                                            <option value="<?php echo $trainer["trner_id"];
                                                // The value we usually set is the primary key
                                            ?>">
                                                <?php echo $trainer["trner_title"];?>&nbsp;<?php echo $trainer['trner_first_name']?>&nbsp;<?php echo $trainer['trner_middle_name']?>
                                            </option>
                                        <?php 
                                            endwhile; 
                                            // While loop must be terminated
                                        ?>
                                    </select>
                            
                            
                                </div>
                                            </div>
                                            
                             </div>
                             
                            
                                    <div class="row">
                                <div class="col-sm-12">
                                <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                <input type="file" class="form-control"  name="doc_image"  required>
                                </div>
                                </div>
                                </div>
                            <br>

                                <div class="row">
                                <div class="col-sm-12">
                                <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title"><b>Description</b></h4>
                                <textarea class="summernote" name="doc_descr" required style="width: 100%; height: 200px;"></textarea>
                                </div>
                                </div>
                                </div>
                            
                                
                                    <div class="row">
                                <div class="col-sm-12">
                                <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title"><b>PDF File</b></h4>
                                <input type="file" class="form-control"  name="doc_file"  accept="application/pdf" required>
                                </div>
                                </div>
                                </div>
                            <br>

                            <hr>
                                        <button type="submit" name="add" class="btn btn-success waves-effect waves-light">Add</button>
								        <br>
                                </form>

                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                  
             <div class="container">
		   <div class="container-fluid">
			    <div class="card mb-4">
					
						<div class="card-body">
                      
                        <div id="content">
                            <div class="row" style="padding: 0 2em;">
                            <form class="form-inline my-2 my-lg-0" name="searchform" action="doc_search.php" method="post">
										 <input class="form-control mr-sm-2" type="search" placeholder="Search Book" aria-label="Search" name="search">
										 <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
									  </form>
									
                                </div>
                                <br>
                        <div id="azindex" role="group">
                              <!-- Alphabets Sort -->
                              <ul id="index">
                                <?php
                                echo '<h5><li ><a href="training_doc.php" '; 
                                if( !isset($_GET['char']) ){
                                echo ' class="active" ';
                                }
                                echo ' >All</a></h5></li>';

                                ?>
                                </ul>
                            </div>
                            
                            <br><br>

                                
                            
                                </div>
                                
                            </div>
                        </div>
                     </div>
                            
                            </div>
                                 
                            </div>
                        </section>
            
                            <div class="container-fluid">
                            <div class="row">
					 
                     <?php
                         

                         if (isset($_GET['pageno'])) {
                             $pageno = $_GET['pageno'];
                         } else {
                             $pageno = 1;
                         }
                         $no_of_records_per_page = 30;
                         $offset = ($pageno-1) * $no_of_records_per_page;


                         $total_pages_sql = "SELECT COUNT(*) FROM training_documents";
                         $result = mysqli_query($conn,$total_pages_sql);
                         $total_rows = mysqli_fetch_array($result)[0];
                         $total_pages = ceil($total_rows / $no_of_records_per_page);
                         
                         $search = $_POST['search'];

                     if(!empty($_POST['search']))
                     {
                         
                         
                          
                       $query=mysqli_query($conn,"SELECT *  FROM `training_documents` WHERE `doc_title` LIKE '%$search%' OR`doc_author`LIKE '%$search%' ORDER BY`uploaded_date` DESC LIMIT $offset, $no_of_records_per_page");
                         
                         
                          
                             while ($row=mysqli_fetch_array($query)) { 						
                     
                     ?>
                                 <div class="col-lg-2">
                                                     <div class="card">
                                                         <div id="owl_demo_6" class="owl-carousel owl-theme dots-on-item overflow-hide card-img-top owl-loaded owl-drag">
                                                         <a href="document.php?docid=<?php echo $row['doc_id']; ?>">
                                                         <img class="img-responsive img-thumbnail" src="training_doc/doc_images/<?php echo $row['doc_image']; ?>">
                                                         </a> 
                                                                             
                                                         </div>
                                                         <div class="card-body">
                                                         <h5><?php echo htmlentities($row['doc_title']);?></h5>
                                                         <div class="card-footer text-muted">
                                                         Uploaded Date <?php echo htmlentities($row['uploaded_date']);?>

                                                         </div>
                                     
                                                     </div>
                                                     </div>
                                                 </div>
                     <?php } ?>
                     <?php
                         }
                         else
                         {
                             
                               ?><h2 class="card-title"><?php echo $search;?> Not found</h2>
                     <?php
                         }
                     
                     
                     ?>
                </div>
                                        <ul class="pagination justify-content-center mb-4">
                                                <li class="page-item"><a href="?pageno=1"  class="page-link">First</a></li>
                                                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                                                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
                                                </li>
                                                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item"><a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
                                                </li>
                                                <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                                            </ul>
                            </div>
						<!-- /Row -->  
                 
            
            
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




	
</body>
<script>
            if(window.history.replaceState){
                window.history.replaceState(null,null,window.location.href)
            }
            </script>
</html>
<?php } ?>