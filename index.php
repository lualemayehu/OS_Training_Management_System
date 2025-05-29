<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>AFLEX TMS I Login</title>
		<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- Toggles CSS -->
		<link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
		<link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
		
		<!-- Custom CSS -->
		<link href="dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!-- HK Wrapper -->
		<div class="hk-wrapper">
			
			<!-- Main Content -->
			<div class="hk-pg-wrapper hk-auth-wrapper">
				
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12 pa-0">
							<div class="auth-form-wrap pt-xl-0 pt-70">
								<div class="auth-form w-xl-35 w-lg-65 w-sm-85 w-100 card pa-25 shadow-lg">
									<a class="auth-brand text-center d-block mb-20" href="#">
										<img class="brand-img" src="dist/img/logo-light.png" alt="brand"/>
									</a>
									<form action="login.php" method="post">
										<p class="text-center mb-30">Sign in to your account </p> 
									
										<div class="form-floating">
                                                <input type="email" class="form-control" name="email" placeholder="name@example.com">
                                                <label for="floatingInput">Email</label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                <input type="password" class="form-control" name="password" placeholder="Password">
                                                <label for="floatingPassword">Password</label>
                                         </div>
                                         <br>
										<div class="custom-control custom-checkbox mb-25">
											<input class="custom-control-input" id="same-address" type="checkbox" checked>
											<label class="custom-control-label font-14" for="same-address">Keep me logged in</label>
										</div>
                                        <button class="btn btn-success btn-block" type="submit" name="login_button">Login</button>
									</form>
									<hr>
									<footer>
									<div align="center"><a href="forgotPassword.php">Forgot password?</a></div>
									</footer>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Main Content -->
		
		</div>
		
	</body>
</html>