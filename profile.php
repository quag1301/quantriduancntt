
<?php 
include ( "inc/connect.inc.php" ); 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
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

if (isset($_REQUEST['uid'])) {
	
	$user2 = mysqli_real_escape_string($conn, $_REQUEST['uid']);
	if($user != $user2){
		header('location: index.php');
	}
}else {
	header('location: index.php');
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>


	<style>
		body{
			background-color: #c5645d!important;	
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

	<div style="margin-top: 50px;">
		<div style="width: 80%; margin:  auto;">

			
			<div>

				<div style="background-color: #fff;">
					<table class="table table-striped table-bordered">
						<tr style="font-weight: bold;" colspan="10" background-color="#3A5487">
							<th>Tên sản phẩm</th>
							<th>Giá</th>
							<th>Số lượng</th>
							<th>Ngày đặt</th>
							<th>Ngày giao</th>
							<th>Địa chỉ giao hàng</th>
							<th>SĐT</th>
							<th>Tình trạng</th>
							<th>Hình ảnh</th>
							<th></th>
						</tr>
						<tr>
							<?php include ( "inc/connect.inc.php");
							$query = "SELECT * FROM orders WHERE uid='$user' ORDER BY id DESC";
							$run = mysqli_query($conn, $query);
							while ($row=mysqli_fetch_assoc($run)) {
								$pid = $row['pid'];
								$oid = $row['id'];
								$quantity = $row['quantity'];
								$oplace = $row['oplace'];
								$mobile = $row['mobile'];
								$odate = $row['odate'];
								$ddate = $row['ddate'];
								$dstatus = $row['dstatus'];
								
								//get product info
								$query1 = "SELECT * FROM products WHERE id='$pid'";
								$run1 = mysqli_query($conn, $query1);
								$row1=mysqli_fetch_assoc($run1);
								$pId = $row1['id'];
								$pName = substr($row1['pName'], 0,50);
								$price = $row1['price'];
								$picture = $row1['picture'];
							
								$category = $row1['category'];
								?>
							<td><?php echo $pName; ?></td>
							<td><?php echo $price; ?></td>
							<td><?php echo $quantity; ?></td>
							<td><?php echo $odate; ?></td>
							<td><?php echo $ddate; ?></td>
							<td><?php echo $oplace; ?></td>
							<td><?php echo $mobile; ?></td>
							<td><?php echo $dstatus; ?></td>
							<td><?php echo '<div class="home-prodlist-img"><a href="view_product.php?pid='.$pId.'">
											<img src="image/product/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
											</a>
										</div>' ?></th>

							<?php 
							if ($dstatus != "Hủy"){
								echo '
								<td >
									<a class="btn btn-warning" href="editorder.php?eoid='.$oid.'"><i class="fa fa-edit"></i></a>
								</td>';
							}
							else {
								echo '<td></td>';
							}
							?>


						</tr>
						<?php } ?>
					</table>
				</div>

			</div>
		</div>
	</div>

	
</body>
</html>