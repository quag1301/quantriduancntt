<style>

	body{
		background-color: #c5645d;	
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

	.btn-success {
		margin-top: 10px;
	}
	.signup_success_msg {
		color:green;
	}
	.signup_error_msg {
		color: red;
	}

</style>


<div class="nav-main">
	<div class="nav-logo">
        <a href="index.php">
            <img src="./image/ebuybdlogo.png" style="height: 100%;">
        </a>
    </div>



    <div class="nav-right">

		<?php 
		
		if ($user != ""){ 
			
			echo '
				<div style="top: 15px; position: absolute; right: 20px;">
					<div class="nav-name" style="display: inline-block;">
						<a style="text-decoration: underline;color: #007bff; font-size:1.5rem;" href="profile.php?uid='.$user.'">'.$uname_db.'</a>
					</div>
				
					<div class="nav-logout btn btn-danger btn-lg">
						<a style="text-decoration: none;color: white;" href="logout.php">Đăng xuất</a>
					</div>
				</div>
				';
		}
		else {
			echo '<div class="nav-logout btn btn-success btn-lg" style="top: 5px; position: absolute; right: 20px;">
					<a style="text-decoration: none;color: white;" href="login.php">Đăng nhập</a>
				</div>';
		}
		?>

        
    </div>
    
</div>
