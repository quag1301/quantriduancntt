<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	header("location: login.php");
	$user = "";
}
else {
	$user = $_SESSION['admin_login'];
	$uname_db = $user;
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Admin</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<div class="homepageheader admin-header">
			<div class="nav-logo">
				<a href="index.php">
					<img src="../image/ebuybdlogo.png">
				</a>
			</div>

			<div class="nav-right">
				<div class="nav-name">
					<?php 
						echo '<a style="text-decoration: underline;color: #fff;" href="login.php">'.$uname_db.'</a>';
					 ?>
				</div>

				<div class="nav-logout btn btn-danger btn-lg">
					<?php 
						echo '<a style="text-decoration: none;color: #fff;" href="logout.php">Đăng xuất</a>';
					 ?>
				</div>
			</div>

		</div>

		<div class="admin-body">
			<div class="nav-side">

				<a href="index.php">Tổng quan</a>
				<a href="allproducts.php">Quản lý sản phẩm</a>
				<a href="orders.php" >Quản lý đặt hàng</a>

			</div>

			<div class="container">

			</div>
		</div>
		
	</body>
</html>