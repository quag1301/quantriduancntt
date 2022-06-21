<div class="admin-header">
    <div class="nav-logo">
        <a href="index.php">
            <img src="../image/ebuybdlogo.png">
        </a>
    </div>

    <div class="nav-right">
        <div class="nav-name">
            <?php 
                echo '<a style="text-decoration: underline;color: #fff;" href="login.php">'.$uname_db.'</a>';
                ?>
        </div>

        <div class="nav-logout btn btn-danger btn-lg">
            <?php 
                echo '<a style="text-decoration: none;color: #fff;" href="logout.php">Đăng xuất</a>';
                ?>
        </div>
    </div>
    
</div>
