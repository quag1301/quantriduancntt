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

$search_value = "";

?>


<!doctype html>
<html>
	<head>
		<title>Quản lý sản phẩm</title>
		
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>

		<?php include ("./section/navbar.php"); ?>

		<div class="admin-body">
			<?php include ("./section/sidebar.php"); ?>

			<div class="container">
				<h2 style="float:left; margin-top: 8px;">Danh sách sản phẩm</h2>
				<div class="table-before">
					
					<input id="product-search" class="form-control" placeholder="Tìm kiếm sản phẩm theo tên"/>
					<a class="btn btn-success" href="addproduct.php">Thêm</a>
				</div>
				<table class="table table-striped table-bordered">
					<tr style="font-weight: bold;" colspan="10" background-color="#4DB849">
						<th>Id</th>
						<th>Tên sản phẩm</th>
						<th>Mô tả</th>
						<th>Giá</th>
						<th>Số lượng</th>
						<th>Danh mục</th>
						<th>Hình ảnh</th>
						<th></th>
					</tr>
					<tr>
						<?php include ( "../inc/connect.inc.php");
						$query = "SELECT * FROM products ORDER BY id DESC";
						$run = mysqli_query($conn, $query);
						while ($row=mysqli_fetch_assoc($run)) {
							$id = $row['id'];
							$pName = substr($row['pName'], 0,50);
							$descri = $row['description'];
							$price = $row['price'];
							$available = $row['available'];
							$category = $row['category'];
							//$type = $row['type'];
							//$item = $row['item'];
							//$pCode = $row['pCode'];
							$picture = $row['picture'];
						
						?>
						<td><?php echo $id; ?></td>
						<td><?php echo $pName; ?></td>
						<td><?php echo $descri; ?></td>
						<td><?php echo $price; ?></td>
						<td><?php echo $available; ?></td>
						<td><?php echo $category; ?></td>
						<td><?php echo '<div class="home-prodlist-img">
										<img src="../image/product/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
										</div>' ?></td>
						<td >
							<a class="btn btn-warning" href="editproduct.php?epid=<?php echo $id; ?>"><i class="fa fa-edit"></i></a>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</body>
</html>

<script src="../js/script.js"></script>