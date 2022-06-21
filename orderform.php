<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
	header("location: login.php?ono=".$poid."");
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

if (isset($_REQUEST['poid'])) {
	$poid = mysqli_real_escape_string($conn, $_REQUEST['poid']);
} else {
	header('location: index.php');
}

$getposts = mysqli_query($conn, "SELECT * FROM products WHERE id ='$poid'") or die(mysqli_error());
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

//order

// order
if (isset($_REQUEST['poid'])) {
	$pid = mysqli_real_escape_string($conn, $_REQUEST['poid']);

	try{
		$d = date("Y-m-d"); //Year - Month - Day
		$timestamp = time();
		$date = strtotime("+7 day", $timestamp);
		$date = date('Y-m-d', $date);
		
		if(mysqli_query($conn, "INSERT INTO orders (uid,pid,quantity,dstatus,oplace,mobile,odate,ddate) VALUES ('$user','$pid',$_POST[qty],'Chờ xác nhận','$uadd_db','$umob_db','$d','$date')")){
			header('location: profile.php?uid='.$user);
			$success_message = "Mua thành công";
		}else{
			$error_message = 'Mua không thành công!';
		}
		//}

	}
	catch (Exception $e) {
		$error_message = $e->getMessage();
	}
}else


?>

<!DOCTYPE html>
<html>
<head>
	<title>SAREE</title>
	<link rel="stylesheet" type="text/css" href="css/style0.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url(image/homebackgrndimg1.png);">
	<?php include ("navbar.php" ); ?>

	<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
		<div class="container signupform_content ">
			<div>

				<h2 style="padding-bottom: 20px;">Order Form</h2>
				<div style="float: right;">
				<?php 
					if(isset($success_message)) {echo $success_message;}
					else {
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form" style="    margin-top: 38px;">
									<div>
										<td>
											<input name="mobile" placeholder="Your mobile number" required="required" class="email signupbox" type="text" size="30" value="'.$umob_db.'">
										</td>
									</div>
									<div>
										<td>
											<input name="address" id="password-1" required="required"  placeholder="Write your full address" class="password signupbox " type="text" size="30" value="'.$uadd_db.'">
										</td>
									</div>
									<div>
										<td>
											<select onchange="changeAmount()" name="quantity" required="required" id="productAmount" style=" font-size: 20px;
										font-style: italic; margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;" class="">';

					

				 ?><?php
												for ($i=1; $i<=$available; $i++) { 
													echo '<option  value="'.$i.'">Quantity: '.$i.'</option>';
												}
											?>
											<?php echo '
											</select>
										</td>
									</div>
									<div>
										<input name="order" class="uisignupbutton signupbutton" type="submit" value="Confirm Order">
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

					}

				 ?>
					
				</div>
			</div>
		</div>
		<div style="float: left; font-size: 23px;">
			<div>
				<?php
					echo '
						<ul style="float: left;">
							<li style="float: left; padding: 0px 25px 25px 25px;">
								<div class="home-prodlist-img"><a href="'.$category.'/view_product.php?pid='.$id.'">
									<img src="image/product/'.$picture.'" class="home-prodlist-imgi">
									</a>
									<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Giá: <span id="amountText">'.$price.'</span> VND<span id="aHiddenText" style="display:none">'.$price.'</span></div>
								</div>
								
							</li>
						</ul>
					';
				?>
			</div>

		</div>
	</div>
	<script type="text/javascript">
	function changeAmount() {
	    var v = document.getElementById("aHiddenText").innerHTML;
	    document.getElementById("amountText").innerHTML = v;
	    var sBox = document.getElementById("productAmount");
    	var y = sBox.value;
	    var x = document.getElementById("amountText").innerHTML;
	    var y = parseInt(y);
	    var x = parseInt(x);
	    document.getElementById("amountText").innerHTML = x+"x"+y+ " = " + x*y;
	}
	</script>
</body>
</html>
