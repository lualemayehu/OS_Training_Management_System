
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
<!-- 
Template Name: dashgrin - Responsive Bootstrap 4 Admin Dashboard Template
Author: Hencework

License: You must have a valid license purchased only from themeforest to legally use the template for your project.
-->
<html lang="en">


    <?php include "includes/head.php"; 


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
	<div class="hk-wrapper">
    

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
            <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" href="javascript:void(0);"><span class="feather-icon"><i data-feather="more-vertical"></i></span></a>
			<a class="navbar-brand" href="index.html">
                <img class="brand-img d-inline-block" src="dist/img/logo-dark.png" alt="brand" />
            </a>
			<ul class="navbar-nav hk-navbar-content order-xl-2">
				
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="dist/img/avatar12.jpg" alt="user" class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
                                <?php     // Checking is User Logged In
                                if(isset($_SESSION['authentication']))
                                {
                                    ?>
                                <span><?= $_SESSION['auth_user']['user_fullname']; ?><i class="zmdi zmdi-chevron-down"></i></span>
                                <?php } ?>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <a class="dropdown-item" href="change_pass.php"><span>Change Password</span></a>
                    <hr>
                    <a class="dropdown-item" href="../logout.php"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                </li>
            </ul>
		
            
		</nav>
       
        <!-- /Top Navbar -->



        <!-- Main Content -->
        <div class="hk-pg-wrapper hk-auth-wrapper">
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 pa-0">
                        <div class="auth-form-wrap pt-xl-0 pt-70">
                            <div class="auth-form w-xl-30 w-sm-50 w-100">
                                <a class="auth-brand text-center d-block mb-20" href="#">
                                    <img class="brand-img" src="dist/img/logo-light.png" alt="brand" />
                                </a>
                                <form action="usr/change_pass_querry.php" method="post">
                                    <h1 class="display-5 mb-30 text-center">Change your password</h1>
                                    
                                    <?php echo !empty($statusMsg)?'<p class="mb-30 text-center">'.$statusMsg.'</p>':''; ?>
                                   
                                    <div class="form-group">
                                        <input class="form-control" name="current_password" placeholder="Current Password" type="password" require>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="password" placeholder="New password" type="password" require>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" name="confirm_password" placeholder="Re-enter new password" type="password" require>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
                                            </div>
                                        </div>
                                    </div>
                                     <button class="btn btn-primary btn-block mb-20" name="changeSubmit" type="submit">Change Password</button>
                                    <p class="text-right"><a href="index.php">Back to login</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
</body>

</html>
<?php } ?>