<?php include ( "./inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($conn, "SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Danh sách sản phẩm</title>
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
			border: 2px solid white;
			border-radius: 8px;
			
		}
		.info1{
			margin: 5px;
		}
	</style>
</head>
<body>
	<?php include ("navbar.php" ); ?>


	<div style="padding: 30px ; padding-left:70px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php 
			$getposts = mysqli_query($conn, "SELECT * FROM products WHERE available >='1' ORDER BY id DESC LIMIT 50") or die(mysqli_error($conn));
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
								<li style="float: left; padding: 25px;">
									<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
										<img src="./image/product/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div class="info1" style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br>Giá: '.$price.' VND</div>
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