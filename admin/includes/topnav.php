        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
            <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" href="javascript:void(0);"><span class="feather-icon"><i data-feather="more-vertical"></i></span></a>
			<a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
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
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-0">
					
					<li class="nav-item">
						<a href="report.php" class="nav-link">Report</a>
					</li>

				</ul>
            </div>
            
		</nav>
       
        <!-- /Top Navbar -->
