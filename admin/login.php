<?php include ( "../inc/connect.inc.php" ); ?>

<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
}
else {
	header("location: index.php");
}

if (isset($_POST['login'])) {
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$user_login0 = mysqli_real_escape_string($conn, $_POST['username']);
		$user_login = mb_convert_case($user_login0, MB_CASE_LOWER, "UTF-8");	
		$password_login = mysqli_real_escape_string($conn, $_POST['password']);	
		$password_login_md5 = md5($password_login);

		$result = mysqli_query($conn, "SELECT * FROM admin WHERE (username='$user_login') AND password='$password_login_md5'");
		$account_check = mysqli_num_rows($result);

		if ($account_check > 0) {
			$_SESSION['admin_login'] = $user_login;
			setcookie('admin_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			header('location: index.php');
			exit();
		}
		else {
			$error_message = "Tài khoản hoặc mật khẩu không chính xác";
		}
	}

}


?>

<!doctype html>
<html>
	<head>
		<title>Đăng nhập Admin</title>
		<style>
			body{
				background-color: #3c78d0;	
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
									<label for="username">Tài khoản</label>
									<input name="username" placeholder="" required="required" class="form-control" type="text">
								</div>

								<div class="form-group">
									<label for="password">Mật khẩu</label>
									<input name="password" placeholder="" required="required" class="form-control" type="password">
								</div>
								
								<div class="signup_error_msg" style="color:red;">';
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