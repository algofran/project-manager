<!doctype html>
<html class="fixed">
    <?php 
    session_start();
    include('./include/db_connect.php');
   
    if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");
 
	if (isset($_POST['submit'])) {
		$email = $_POST['email'];
		$password = md5($_POST['password']);
	
		$sql = "SELECT *,concat(firstname,' ',lastname) as name FROM users where username = '".$email."' and password = '".$password."'  ";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['login_id'] = $row['id'];
			$_SESSION['username'] = $row['name'];
			$_SESSION['avatar']=$row['avatar'];
			$BaseURL ="localhost/pms/";
			
			$t = $row['type'];

			if ($t == 0) {
				$_SESSION['type'] ="Administrator";
			} elseif ($t == 1) {
				$_SESSION['type'] ="Manager";
			} else {
				$_SESSION['type'] ="Staff";
			}

			
			header("location:index.php?page=home");
		} else {
			echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
		}
	}
	
	?>


	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="Visdat Project Management System" />
		<meta name="description" content="Visdat Project Management System">
		<meta name="author" content="Datasoft-Makassar">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
	

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<link rel="stylesheet" href="assets/css/bubble-style.css">  

	</head>
	<body style="background-image: url('assets/images/bg.jpg'); no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">

        <div class="login-box animated fadeInDown">
		<!-- start: page -->
		<section class="body-sign">
            
			<div class="center-sign">


				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-left">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> VISDAT | Project Management System</h2>
					</div>
					<div class="panel-body">
						<form action="" id="login-form" method="POST">
							<div class="form-group mb-lg">
								<label>Nama Pengguna</label>
								<div class="input-group input-group-icon">
									<input id="email" name="email" type="text" class="form-control input-lg" required />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Kata Sandi</label>
									<a href="pages-recover-password.html" class="pull-right">Lupa Password?</a>
								</div>
								<div class="input-group input-group-icon">
									<input id="passwrod" name="password" type="password" class="form-control input-lg" required />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="remember" name="remember" type="checkbox"/>
										<label for="remember">Ingat saya</label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									
									<button type="submit" name="submit" class="btn btn-login btn-primary btn-block">Log In</button>
								</div>
							</div>
						
						</form>
					</div>
				</div>
               
				<p class="text-center mt-md mb-md">&copy; Copyright 2023. All rights reserved. By <a href="https://visualdata.co.id">Visual Data</a>.</p>
			</div>
		
        </section>
		<!-- end: page -->

			
        <ul class="bg-bubbles"  style="position:relative;">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>

        </ul>
    </div>


		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>