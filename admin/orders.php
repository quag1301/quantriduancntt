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


<!doctype html>
<html>
	<head>
		<title>Quản lý đơn hàng</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body >
		<?php include ("./section/navbar.php"); ?>
		
		<div class="admin-body">
			<?php include ("./section/sidebar.php"); ?>

			<div class="container">
				<h2 style="float:left; margin-top: 8px;">Danh sách đơn hàng</h2>
				<div class="table-before">
					
					<input id="order-search" style="width:300px;" class="form-control" placeholder="Tìm kiếm đơn hàng theo ID Sản phẩm"/>
					<!--<a class="btn btn-success" href="addproduct.php">Thêm</a>-->
				</div>

				<table class="table table-striped table-bordered">
					<tr style="font-weight: bold;" colspan="10" >
						<th>Id</th>
						<th>Id Khách hàng</th>
						<th>Id Sản phẩm</th>
						<th>Q*P=T</th>
						<th>Địa chỉ giao hàng</th>
						<th>Tình trạng</th>
						<th>Ngày đặt</th>
						<th>Ngày giao</th>
						<th>Họ tên</th>
						<th>SĐT</th>
						<th>Email</th>
						<th>Hình ảnh</th>
						<th></th>
					</tr>
					<tr>
						<?php include ( "../inc/connect.inc.php");
						$query = "SELECT * FROM orders ORDER BY id DESC";
						$run = mysqli_query($conn, $query);
						while ($row = mysqli_fetch_assoc($run)) {
							$oid = $row['id'];
							$ouid = $row['uid'];
							$opid = $row['pid'];
							$oquantity = $row['quantity'];
							$oplace = $row['oplace'];
							$omobile = $row['mobile'];
							$odstatus = $row['dstatus'];
							$odate = $row['odate'];
							$ddate = $row['ddate'];
							//getting user info
							$query1 = "SELECT * FROM user WHERE id='$ouid'";
							$run1 = mysqli_query($conn, $query1);
							$row1 = mysqli_fetch_assoc($run1);
							$ofname = $row1['firstName'];
							$oumobile = $row1['mobile'];
							$ouemail = $row1['email'];

							//product info
							$query2 = "SELECT * FROM products WHERE id='$opid'";
							$run2 = mysqli_query($conn, $query2);
							$row2=mysqli_fetch_assoc($run2);
							$opcate = $row2['category'];
							//$opitem = $row2['item'];
							$oppicture = $row2['picture'];
							$oprice = $row2['price'];

						
							?>
						<td><?php echo $oid; ?></td>
						<td><?php echo $ouid; ?></td>
						<td><?php echo $opid; ?></td>
						<td><?php echo ''.$oquantity.' * '.$oprice.' = '.$oquantity*$oprice.''; ?></td>
						<td><?php echo $oplace; ?></td>
						<td><?php echo $odstatus; ?></td>
						<td><?php echo $odate; ?></td>
						<td><?php echo $ddate; ?></td>

						<td><?php echo $ofname; ?></td>
						<td><?php echo $oumobile; ?></td>
						<td><?php echo $ouemail; ?></td>
						<td><?php echo '<div class="home-prodlist-img">
										<img src="../image/product/'.$oppicture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
									</div>' ?></td>
						<td>
							<a class="btn btn-warning" href="editorder.php?eoid=<?php echo $oid; ?>"><i class="fa fa-edit"></i></a>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</body>
</html>

<script src="../js/script.js"></script>