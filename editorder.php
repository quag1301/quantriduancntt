<?php include ( "./inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
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

if (isset($_REQUEST['eoid'])) {
	$eoid = mysqli_real_escape_string($conn, $_REQUEST['eoid']);

	// order
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

	//user
	$result2 = mysqli_query($conn, "SELECT * FROM user WHERE id='$user'");
	$get_order_info2 = mysqli_fetch_assoc($result2);
	$euname = $get_order_info2['firstName'];
	$euemail = $get_order_info2['email'];
	$eumobile = $get_order_info2['mobile'];

	// product
	$result3 = mysqli_query($conn, "SELECT * FROM products WHERE id ='$eopid'") or die(mysqli_error());
	$row = mysqli_fetch_assoc($result3);
	$id = $row['id'];
	$pName = $row['pName'];
	$price = $row['price'];
	$description = $row['description'];
	$picture = $row['picture'];
	$category = $row['category'];
	$available =$row['available'];

}else {
	header('location: index.php');
}






//order

if (isset($_POST['order'])) {
	//declere veriable
	$eodstatus = $_POST['dstatus'];
	$dquantity = $_POST['quantity'];
	$ddate = $_POST['ddate'];
	//triming name
	
	
		if(mysqli_query($conn, "UPDATE orders SET ddate='$ddate', quantity='$dquantity', oplace='$_POST[daddres]', mobile='$_POST[dmolb]' WHERE id='$eoid'")){
			//success message
			header('location: profile.php?uid='.$user.'');
		}

	}
else if (isset($_POST['dstatus'])){
	if(mysqli_query($conn, "UPDATE orders SET dstatus='Hủy' WHERE id='$eoid'")){
		//success message
		header('location: profile.php?uid='.$user.'');
	}
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Đơn hàng</title>
	

</head>
<body>
	<?php include ("navbar.php"); ?>

	<div class="admin-body">


		<div class="" style="padding: 20px 20%; height: 500px;">
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
											<div>Ngày nhận</div>
											<input name="ddate" placeholder="Delevary date" required="required" class="form-control" type="date" size="30" value="'.$eddate.'">
										</div>


										<div>
											<div>Số lượng</div>
											<select name="quantity" required="required" class="form-control">
												<option selected value="'.$eoquantity.'">'.$eoquantity.'</option>';
													?><?php
													for ($i=1; $i<=$available; $i++) { 
														echo '<option value="'.$i.'">'.$i.'</option>';
													}
												?>
												<?php echo '
											</select>
										</div>

										<div>
											<div>Địa chỉ</div>
											<input name="daddres" placeholder="Địa chỉ" required="required" class="form-control" type="text" size="30" value="'.$eoplace.'">
										</div>

										<div>
											<div>SĐT</div>
											<input name="dmolb" placeholder="Số điện thoại" required="required" class="form-control" type="text" size="30" value="'.$eomobile.'">
										</div>



										<div>
											<input name="order" class="btn btn-success" type="submit" value="Xác nhận thay đổi">
										</div>
										<div>
											<input name="dstatus" class="btn btn-danger" type="submit" value="Hủy đơn hàng">
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
									<img src="./image/product/'.$picture.'" class="home-prodlist-imgi" style="width:400px;">
									
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