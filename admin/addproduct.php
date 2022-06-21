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

$pname = "";
$price = "";
$available = "";
$category = "";
$type = "";
$item = "";
$pCode = "";
$descri = "";

if (isset($_POST['signup'])) {
	//declere veriable
	$pname = $_POST['pname'];
	$price = $_POST['price'];
	$available = $_POST['available'];
	$category = $_POST['category'];
	//$type = $_POST['type'];
	//$item = $_POST['item'];
	//$pCode = $_POST['code'];
	$descri = $_POST['descri'];
	//triming name
	$_POST['pname'] = trim($_POST['pname']);

	//finding file extention
	$profile_pic_name = @$_FILES['profilepic']['name'];
	$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
	$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

	if (((@$_FILES['profilepic']['type']=='image/jpeg') || (@$_FILES['profilepic']['type']=='image/png') || (@$_FILES['profilepic']['type']=='image/gif')) && (@$_FILES['profilepic']['size'] < 1000000)) {

		/*
		$item = $item;
		if (file_exists("../image/product/$item")) {
			//nothing
		}else {
			mkdir("../image/product/$item");
		}
		*/
		
		$filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

		if (file_exists("../image/product/".$filename)) {
			echo @$_FILES["profilepic"]["name"]."Already exists";
		}else {
			if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "../image/product/".$filename)){
				$photos = $filename;
				$result = mysqli_query($conn, "INSERT INTO products(pName,price,description,available,category,picture) VALUES ('$_POST[pname]','$_POST[price]','$_POST[descri]','$_POST[available]','$_POST[category]','$photos')");
					header("Location: allproducts.php");
			}else {
				echo "Something Worng on upload!!!";
			}
			//echo "Uploaded and stored in: userdata/profile_pics/$item/".@$_FILES["profilepic"]["name"];
			
			
		}
	}
	else {
		$error_message = 'Ảnh không hợp lệ';
	}
}
$search_value = "";

?>


<!doctype html>
<html>
	<head>
		<title>Thêm sản phẩm</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		
		<?php include ("./section/navbar.php"); ?>

		<div class="admin-body">
			<?php include ("./section/sidebar.php"); ?>
			
			<?php 
				echo '
					<div class="container">
						
						<form action="" method="POST" enctype="multipart/form-data" style="width: 40%; margin: auto;">
							<h2>Thêm sản phẩm</h2>	
							<div class="signup_form">
								<div class="form-group">
									<input name="pname" placeholder="Tên sản phẩm" required="required" class="form-control" type="text" value="'.$pname.'" >
								</div>

								<div class="form-group">
										<input name="price"placeholder="Giá" required="required" class="form-control" type="text"value="'.$price.'" >
								</div>

								<div class="form-group">
										<input name="available" placeholder="Số lượng" required="required" class="form-control" type="text" value="'.$available.'">
								</div>

								<div class="form-group">
									<textarea  name="descri" placeholder="Mô tả" class="form-control" type="text" size="40" rows="5">'.$descri.'</textarea>

								</div>

								<div>
									<select name="category" class="form-control" placeholder="Danh mục">
										
										<option value="Hoa cưới">Hoa cưới</option>
										<option value="Hoa sinh nhật">Hoa sinh nhật</option>
										<option value="Hoa chúc">Hoa chúc</option>
									</select>
								</div>


								<div class="form-group">
									<input name="profilepic" class="password signupbox" type="file" value="Add Pic">
								</div>

								<div class="form-group signup_error_msg" style="color:red;">';
									if (isset($error_message)) {echo $error_message;}
									echo '</div>

								<div class="form-group">
									<input name="signup" class="btn btn-success" type="submit" value="Thêm sản phẩm">
								</div>
							</div>
						</form>
								
					</div>
				';
			?>
		</div>
	</body>
</html>

