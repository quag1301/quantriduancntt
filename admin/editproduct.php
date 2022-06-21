<?php include ( "../inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	$user = "";
	header("location: login.php?ono=".$epid."");
}
else {
	if (isset($_REQUEST['epid'])) {
	
		$epid = mysqli_real_escape_string($conn, $_REQUEST['epid']);
	}else {
		header('location: index.php');
	}
	$user = $_SESSION['admin_login'];
	$uname_db = $user;

}
$getposts = mysqli_query($conn, "SELECT * FROM products WHERE id ='$epid'") or die(mysql_error());
	if (mysqli_num_rows($getposts)) {
		$row = mysqli_fetch_assoc($getposts);
		$id = $row['id'];
		$pName = $row['pName'];
		$price = $row['price'];
		$description = $row['description'];
		$picture = $row['picture'];
		//$item = $row['item'];
		//$itemu = ucwords($row['item']);
		//$type = $row['type'];
		//$typeu = ucwords($row['type']);
		$category = $row['category'];
		$categoryu = ucwords($row['category']);
		//$code = $row['pCode'];
		$available =$row['available'];
	}	

//update product
if (isset($_POST['updatepro'])) {
	$pname = $_POST['pname'];
	$price = $_POST['price'];
	$available = $_POST['available'];
	$category = $_POST['category'];
	//$type = $_POST['type'];
	//$item = $_POST['item'];
	//$pCode = $_POST['code'];
	//triming name
	$_POST['pname'] = trim($_POST['pname']);

	if($result = mysqli_query($conn, "UPDATE products SET pName='$_POST[pname]',price='$_POST[price]',description='$_POST[descri]',available='$_POST[available]',category='$_POST[category]' WHERE id='$epid'")){
		header("Location: editproduct.php?epid=".$epid."");

	}else {
		echo "no changed";
	}
}


if (isset($_POST['updatepic'])) {
	if($_FILES['profilepic'] == ""){
		
			echo "not changed";
	} else {
		//finding file extention
	$profile_pic_name = @$_FILES['profilepic']['name'];
	$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
	$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

	if (((@$_FILES['profilepic']['type']=='image/jpeg') || (@$_FILES['profilepic']['type']=='image/png') || (@$_FILES['profilepic']['type']=='image/jpg') || (@$_FILES['profilepic']['type']=='image/gif')) && (@$_FILES['profilepic']['size'] < 1000000)) {

		$item = $item;
		if (file_exists("../image/product/$item")) {
			//nothing
		}else {
			mkdir("../image/product/$item");
		}
		
		
		$filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

		if (file_exists("../image/product/$item/".$filename)) {
			echo @$_FILES["profilepic"]["name"]."Already exists";
		} else {
			if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "../image/product/$item/".$filename)){
				$photos = $filename;
				if($result = mysqli_query($conn, "UPDATE products SET picture='$photos' WHERE id='$epid'")){

					$delete_file = unlink("../image/product/$item/".$picture);
					header("Location: editproduct.php?epid=".$epid."");
				}else {
					echo "Wrong!";
				}
			} else {
				echo "Lỗi khi upload!!!";
			}
			//echo "Uploaded and stored in: userdata/profile_pics/$item/".@$_FILES["profilepic"]["name"];
			
			
		}
		}
		else {
			$error_message = "Hãy chọn hình ảnh!";
		}

	}
}



if (isset($_POST['delprod'])) {
//triming name
	$getposts1 = mysqli_query($conn, "SELECT pid FROM orders WHERE pid='$epid'") or die(mysql_error());
		if ($ttl = mysqli_num_rows($getposts1)) {
			$error_message = "You can not delete this product.<br>Someone ordered this.";
		}
		else {
			if(mysqli_query($conn, "DELETE FROM products WHERE id='$epid'")){
				header('location: allproducts.php');
			}
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
					<style>
						.form-control, .admin-body .btn {
							margin: 5px auto;
						}
					</style>
					<h2>Sửa sản phẩm</h2>
					<div style="float: right;">
					<?php 
						echo '
							<div class="">
							<div class="signupform_text"></div>

								<form action="" method="POST" class="registration">
									<div class="signup_form">
										<div>
												<input name="pname" id="first_name" placeholder="Tên sản phẩm" required="required" class="form-control" type="text" size="40" value="'.$pName.'" >
										</div>
										<div>
												<input name="price" id="last_name" placeholder="Giá" required="required" class="form-control" type="text" size="40" value="'.$price.'" >
										</div>
										<div>
											<input name="available" placeholder="Số lượng" required="required" class="form-control" type="text" size="40" value="'.$available.'">
										</div>
										<div>
											<textarea  name="descri" id="first_name" placeholder="Mô tả" class="form-control" type="text" size="40" rows="5">'.$description.'</textarea>
										</div>
										<div>
												<select name="category" class="form-control">
													<option selected value="'.$category.'">'.$categoryu.'</option>
													<option value="Hoa cưới">Hoa cưới</option>
													<option value="Hoa sinh nhật">Hoa sinh nhật</option>
													<option value="Hoa chúc">Hoa chúc</option>
												</select>
										</div>

										<div>
											<input name="updatepro" class="btn btn-success" type="submit" value="Cập nhật sản phẩm">
										</div>
										<div>
											<input name="delprod" class="btn btn-danger" type="submit" value="Xóa sản phẩm">
										</div>
										<div class="signup_error_msg">
											<?php 
												if (isset($error_message)) {echo $error_message;}
												
											?>
										</div>
									</div>
								</form>
						</div>

						';
						if(isset($success_message)) {echo $success_message;}

					?>
						
					</div>
				</div>
			</div>

			<div style="float: left;">
				<?php
					echo '
					
							<div padding: 0px 25px 25px 25px;">
								<div class="home-prodlist-img prodlist-img">';
								if (file_exists('../image/product/'.$picture.'')){
									echo '<img src="../image/product/'.$picture.'" class="home-prodlist-imgi" style="width:300px;">';
								}else {
									echo '
									<div class="home-prodlist-imgi" style="text-align: center; padding: 0 0 6px 0;">No Image Found!</div>';
								} echo '
									
								</div>
							</div>

							<div>
								<form action="" method="POST enctype="multipart/form-data">
										<div class="signup_form">
											<div>
													<input name="profilepic" class="" type="file" value="Thêm hình ảnh">
											</div>
											<div>
												<input name="updatepic" class="btn btn-success" type="submit" value="Cập nhật hình ảnh">
											</div>
											<div class="signup_error_msg">';
											if(isset($error_message)) {echo $error_message;}
											' </div>
										</div>
									</form>
							</div>

						
					';
				?>
			</div>


		</div>
	</div>
</body>
</html>