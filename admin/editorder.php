<?php include ( "../inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	$user = "";
	header("location: login.php?ono=".$eoid."");
}
else {
	if (isset($_REQUEST['eoid'])) {
	
		$eoid = mysqli_real_escape_string($conn, $_REQUEST['eoid']);

	}else {
		header('location: index.php');
	}
	$user = $_SESSION['admin_login'];
	$uname_db = $user;


	$result1 = mysqli_query($conn, "SELECT * FROM orders WHERE id='$eoid'");
		$get_order_info = mysqli_fetch_assoc($result1);
			$eouid = $get_order_info['uid'];
			$eopid = $get_order_info['pid'];
			$eoquantity = $get_order_info['quantity'];
			$eoplace = $get_order_info['oplace'];
			$eomobile = $get_order_info['mobile'];
			$eodstatus = $get_order_info['dstatus'];
			$eodustatus = ucwords($get_order_info['dstatus']);
			$eodate = $get_order_info['odate'];
			$eddate = $get_order_info['ddate'];

			$result2 = mysqli_query($conn, "SELECT * FROM user WHERE id='$eouid'");
			$get_order_info2 = mysqli_fetch_assoc($result2);
			$euname = $get_order_info2['firstName'];
			$euemail = $get_order_info2['email'];
			$eumobile = $get_order_info2['mobile'];
}

$getposts = mysqli_query($conn, "SELECT * FROM products WHERE id ='$eopid'") or die(mysql_error());
					if (mysqli_num_rows($getposts)) {
						$row = mysqli_fetch_assoc($getposts);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						//$item = $row['item'];
						$category = $row['category'];
						$available =$row['available'];
					}	

//order

if (isset($_POST['order'])) {
//declere veriable
$eodstatus = $_POST['dstatus'];
$dquantity = $_POST['quantity'];
$ddate = $_POST['ddate'];
//triming name
	try {
		if(empty($_POST['dstatus'])) {
			throw new Exception('Status can not be empty');
			
		}
				if(mysqli_query($conn, "UPDATE orders SET dstatus='$eodstatus', ddate='$ddate', quantity='$dquantity' WHERE id='$eoid'")){
					//success message
				header('location: editorder.php?eoid='.$eoid.'');
				$success_message = '
				<div class="signupform_content"><h2><font face="bookman">Thay đổi thành công!</font></h2>
				</div>';
				}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}
if (isset($_POST['delorder'])) {
//triming name
	if(mysqli_query($conn, "DELETE FROM orders WHERE id='$eoid'")){

	header('location: orders.php');
	}

	}
$search_value = "";


?>

<!DOCTYPE html>
<html>
<head>
	<title>SAREE</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
	<?php include ("./section/navbar.php"); ?>

	<div class="admin-body">
		<?php include ("./section/sidebar.php"); ?>

		<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
			<div class="container signupform_content ">
				<div>
					<h2 style="padding-bottom: 20px;">Thay đổi trạng thái đơn hàng</h2>
					<div style="float: right;">
					<style>
						.form-control, .admin-body .btn {
							margin: 5px auto;
						}
					</style>
					<?php 
						echo '
							<div class="">
							<div class="signupform_text"></div>
							<div>
								<form action="" method="POST" class="registration">
									<div class="signup_form" style=" margin-top: 38px;">
										<div>
											<input name="ddate" placeholder="Delevary date" required="required" class="form-control" type="date" size="30" value="'.$eddate.'">
										</div>
										<div>
												<select name="dstatus" required="required" class="form-control">
															<option selected value="'.$eodstatus.'">'.$eodustatus.'</option>
															<option value="Đã xác nhận">Đã xác nhận</option>
															<option value="Đang giao">Đang giao</option>
															<option value="Đã giao">Đã giao</option>
															<option value="Hủy">Hủy</option>
														</select>
										</div>
										<div>
											<select name="quantity" required="required" class="form-control">
												<option selected value="'.$eoquantity.'">Số lượng: '.$eoquantity.'</option>';
													?><?php
													for ($i=1; $i<=$available; $i++) { 
														echo '<option value="'.$i.'">Số lượng: '.$i.'</option>';
													}
												?>
												<?php echo '
											</select>
										</div>
										<div>
											<input name="order" class="btn btn-success" type="submit" value="Xác nhận thay đổi">
										</div>
										<div>
											<input name="delorder" class="btn btn-danger" type="submit" value="Xóa đơn hàng">
										</div>
										<div class="signup_error_msg"> '; ?>
											<?php 
												if (isset($error_message)) {echo $error_message;}
												
											?>
										<?php echo '</div>
									</div>
								</form>
								
							</div>
						</div>

						';
						if(isset($success_message)) {echo $success_message;}

						?>
						
					</div>
				</div>
			</div>
			<div style="float: left;">
				<div>
					<?php
						echo '
							<div style="float: left; padding: 0px 25px 25px 25px;">
								<div class="home-prodlist-img" >
									<img src="../image/product/'.$picture.'" class="home-prodlist-imgi" style="width:400px;">
									
									<div style="text-align: center; padding: 0 0 6px 0;">'.$pName.'</div>
								</div>
								
							</div>
						';
					?>
				</div>

			</div>
		</div>
	</div>
</body>
</html>