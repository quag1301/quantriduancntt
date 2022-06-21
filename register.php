<?php
include ("inc/connect.inc.php" );

//ob_start();
session_start();

if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	header("location: index.php");
}

$u_fname = "";
$u_lname = "";
$u_email = "";
$u_mobile = "";
$u_address = "";
$u_pass = "";

if (isset($_POST['signup'])) {
	//declere veriable
	$u_fname = $_POST['first_name'];
	$u_lname = $_POST['last_name'];
	$u_email = $_POST['email'];
	$u_mobile = $_POST['mobile'];
	$u_address = $_POST['signupaddress'];
	$u_pass = $_POST['password'];

	//triming name
	$_POST['first_name'] = trim($_POST['first_name']);
	$_POST['last_name'] = trim($_POST['last_name']);
	


	// Check if email already exists
	$row = mysqli_query($conn, "SELECT email FROM `user` WHERE email='$u_email'");
	$email_check = mysqli_num_rows($row);
	
	if ($email_check == 0) {
		$_POST['first_name'] = ucwords($_POST['first_name']);
		$_POST['last_name'] = ucwords($_POST['last_name']);
		$_POST['email'] = mb_convert_case($u_email, MB_CASE_LOWER, "UTF-8");
		$_POST['password'] = md5($_POST['password']);
		$confirmCode   = substr( rand() * 900000 + 100000, 0, 6 );

		$result = mysqli_query($conn, "INSERT INTO user (firstName,lastName,email,mobile,address,password,confirmCode) 
										VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[mobile]','$_POST[signupaddress]','$_POST[password]','$confirmCode')");
		$success_message = "Đăng ký thành công";
	}
	else {
		$error_message = 'Email đã tồn tại';
	}

}


?>



<!doctype html>
<html>
	<head>
		<title>Đăng ký</title>
		<style>
			body{
				background-color: #c5645d;	
			}

			.nav-main{
				overflow: hidden;
				background-color: #fff;
				width: 100%;
				height: 80px;
				margin: auto;
				box-shadow: 0px 6px 16px -6px rgb(1 1 1 / 50%);
				transition: 0.5s;
				font-family:  sans-serif;
			}

			.nav-main-logo img {
				height:100%;
				width:auto;
			}
			.container {
				background-color: white;
				margin: 90px auto;
				padding:0;
				width: 30%;
				border-radius: .25rem;
				box-shadow: 0px 6px 16px -6px rgb(1 1 1 / 50%);
			}

			.card-header {
				text-align: center;
				font-size: 1.75rem;

			}
			.btn-success {
				margin-top: 10px;
			}

			.signup_error_msg {
				color: red;
			}
		</style>
	</head>

	<body>
		<?php include ("navbar.php"); ?>

		
		<?php 
			echo '
				<div class="container">
					<div class="card-header">
						<h2>Đăng ký</h2>
					</div>

					<div class="card-body">
						<form action="" method="POST">
							<div class="form-group">
								<div class="form-group">
									<input name="first_name" placeholder="Họ" required="required" class="form-control" type="text" value="'.$u_fname.'" >
								</div>

								<div class="form-group">
										<input name="last_name" placeholder="Tên" required="required" class="form-control" type="text" value="'.$u_lname.'" >
								</div>

								<div class="form-group">
										<input name="email" placeholder="Email" required="required" class="form-control" type="email"  value="'.$u_email.'">									
								</div>

								<div class="form-group">
									<input name="password" required="required"  placeholder="Mật khẩu" class="form-control" type="password" value="'.$u_pass.'">
								</div>

								<div class="form-group">
										<input name="mobile" placeholder="Số điện thoại	" required="required" class="form-control" type="text" value="'.$u_mobile.'">
								</div>

								<div class="form-group">
										<input name="signupaddress" placeholder="Địa chỉ" required="required" class="form-control" type="text"  value="'.$u_address.'">
								</div>
								
								<div class="signup_error_msg">';
									if (isset($error_message)) {echo $error_message;}
								
								echo'</div>
								<div class="signup_success_msg">';
									if (isset($success_message)) {echo $success_message;}
								
								echo'</div>
								<div class="form-group">
									<input name="signup" class="btn btn-success" type="submit" value="Đăng ký">
								</div>

							</div>
						</form>
								
					</div>
				
				</div>
			';
		 ?>
	</body>
</html>
