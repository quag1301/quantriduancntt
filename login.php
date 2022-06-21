<?php
include ( "inc/connect.inc.php" );
ob_start();
session_start();

if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	header("location: index.php");
}
$email = "";
$pass = "";


if (isset($_POST['login'])) {
	if (isset($_POST['email']) && isset($_POST['password'])) {

		$user_login0 = mysqli_real_escape_string($conn, $_POST['email']);
		$user_login = mb_convert_case($user_login0, MB_CASE_LOWER, "UTF-8");	
		$password_login = mysqli_real_escape_string($conn, $_POST['password']);		
		$password_login_md5 = md5($password_login);

		$result = mysqli_query($conn, "SELECT * FROM user WHERE (email='$user_login') AND password='$password_login_md5'");
		$account_check = mysqli_num_rows($result);	
		$get_user_email = mysqli_fetch_assoc($result);
		$get_user_uname_db = $get_user_email['id'];
		
		if ($account_check > 0) {
			$_SESSION['user_login'] = $get_user_uname_db;
			setcookie('user_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			
			if (isset($_REQUEST['ono'])) {
				$ono = mysqli_real_escape_string($conn, $_REQUEST['ono']);
				header("location: orderform.php?poid=".$ono."");
			}else {
				header('location: index.php');
			}
			exit();
		}
		else {
			$error_message = "Email hoặc mật khẩu không chính xác";
		}
	}

}



?>

<!doctype html>
<html>
	<head>
		<title>Đăng nhập</title>
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
				margin: 150px auto;
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


		<div class="container">
			<div class="card-header">
				<h2>Đăng nhập</h2>
			</div>

			<div class="card-body">
				<form action="" method="POST">
					<div class="form-group">
						<?php
							echo '
								<div class="form-group">
									<label for="email">Email</label>
									<input name="email" placeholder="" required="required" class="form-control" type="email" value="'.$email.'">
								</div>

								<div class="form-group">
									<label for="password">Mật khẩu</label>
									<input name="password" placeholder="" required="required" class="form-control" type="password" value="'.$pass.'">
								</div>
								
								<div class="">
									<a href="register.php">Chưa có tài khoản?</a>
								</div>
								
								<div class="signup_error_msg">';
									if (isset($error_message)) {echo $error_message;}
								echo'</div>
								<div class="form-group">
									<input name="login" class="btn btn-success" type="submit" value="Đăng nhập">
								</div>
							';
						?>


					</div>
				</form>
			</div>
			
		</div>


	</body>
</html>
