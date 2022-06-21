<?php include ( "./inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
	header('location: login.php');
}
else {
	$user = $_SESSION['user_login'];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE id='$user'");
	$get_user_email = mysqli_fetch_assoc($result);
	$uname_db = $get_user_email['firstName'];
	$uemail_db = $get_user_email['email'];
	$umob_db = $get_user_email['mobile'];
	$uadd_db = $get_user_email['address'];
}


if (isset($_REQUEST['pid'])) {
	$pid = mysqli_real_escape_string($conn, $_REQUEST['pid']);
} else {
	header('location: index.php');
}


$getposts = mysqli_query($conn, "SELECT * FROM products WHERE id ='$pid'") or die(mysqli_error());

if (mysqli_num_rows($getposts)) {
	$row = mysqli_fetch_assoc($getposts);
	$id = $row['id'];
	$pName = $row['pName'];
	$price = $row['price'];
	$description = $row['description'];
	$picture = $row['picture'];
	$category = $row['category'];
	$available =$row['available'];
}	



?>

<!DOCTYPE html>
<html>
<head>
	<title>Chi tiết sản phẩm</title>
	<link rel="stylesheet" type="text/css" href="./css/style0.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>		
		.home-prodlist-img:hover {
			background-color: #9a3489;
			border-radius: 8px;
			color: #fff;
			transform: scale(1.1, 1.1);
			box-shadow: 0px 6px 16px -6px rgb(1 1 1 / 50%);
			transition: 0.5s;
		}

		.home-prodlist-imgi {
			height: 300px;
			width: 300px;
			padding: 3px;
			border: 1px solid white;
			border-radius: 8px;
			
		}
		.info1{
			margin: 5px;
		}
	</style>
</head>
<body>
	<?php include ("navbar.php" ); ?>

	<div class="info" style="margin: 50px 120px; padding: 10px;">

		<?php 
			echo '
				<div style="float: left;" style="">
					<div>
						<img src="./image/product/'.$picture.'" style="box-shadow: 0px 6px 16px -6px rgb(1 1 1 / 50%); height: 400px; width: 520px; padding: 3px; border: 2px solid white; border-radius:8px;">
					</div>
				</div>

				<div style="box-shadow: 0px 6px 16px -6px rgb(1 1 1 / 50%); position:relative; float: right; height: 402px; width: 50%; color: #067165; background-color: #fff; padding: 20px;  border-radius:4px;">
					<form id="" method="POST" action="orderform.php?poid='.$pid.'">
						<h2 style="font-size: 25px; font-weight: bold; ">'.$pName.'</h2><hr>
						<h1 style="padding: 20px 0 0 0; font-size: 22px;">Giá: '.$price.' VND</h1>

						<div>

							<select style="width:160px;" name="qty" required="required" class="form-control">
							<option selected  value="'.$available.'">Số lượng: '.$available.'</option>';
								?><?php
								for ($i=1; $i<=$available; $i++) { 
									echo '<option value="'.$i.'">Số lượng: '.$i.'</option>';
								}
							?>
							<?php echo '
							</select>						
						</div>

						<h2 style="padding: 20px 0 0 0; font-size: 20px;">Mô tả:</h2>
						<p>
							'.$description.'
						</p>

						<div style="">
							
							<div style="position:absolute; bottom:20px;left: 20px;">
								<input name="order" type="submit" value="Mua ngay" class="btn btn-success">
								<span class="signup_error_msg"> '; ?>
								<?php 
									if (isset($error_message)) {echo $error_message;}
								?>
								<?php echo '</span>
								<div class="srcclear"></div>
							</div>
						</div>

					</form>
				</div>

			';
		?>

	</div>

	<div style="padding: 30px 95px; font-size: 25px; margin: 0 auto; display: table; width: 96%; ">
		<h3 style="padding-bottom: 20px">Có thể bạn sẽ thích:</h3>
		<div>
		<?php 
			$getposts = mysqli_query($conn, "SELECT * FROM products WHERE available >='1' AND id != '".$pid."' ORDER BY RAND() LIMIT 3") or die(mysql_error());
					if (mysqli_num_rows($getposts)) {
					echo '<ul id="recs">';
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						
						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img">
										<a href="view_product.php?pid='.$id.'">
											<img src="./image/product/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div class="info1" style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Giá: '.$price.' VND</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}
		?>
			
		</div>
	</div>
</body>
</html>
