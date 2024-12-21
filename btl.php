<?php
// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user'])) {
    $username = htmlspecialchars($_SESSION['user']);
} else {
    $username = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <link rel="stylesheet" href="Css/app.css"> <!-- Đường dẫn tới file CSS -->
    <title>Trang chủ - Cửa hàng game giá rẻ</title>
</head>
<body>
<div id="header">
    <nav class="container-menu">
        <div class="head">
            <a href="index.php" id="logomenu">
                <img src="img/logomenu.png" alt="logomenu">
            </a>
            <!-- Thanh tìm kiếm -->
            <div class="form-search">
                <form method="POST" action="search.php">
                    <input class="search" name="nd" type="text" placeholder="Nhập thông tin để tìm kiếm">
                    <button class="search-btn" type="submit" name="btn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>
        <ul id="main-menu">
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="#">Đĩa</a>
                <ul class="sub-menu">
                    <li><a href="#">Game Ps4</a></li>
                    <li><a href="#">Game Ps5</a></li>
                    <li><a href="#">Game Nintendo Switch</a></li>
                    <li><a href="#">Game Xbox One</a></li>
                </ul>
            </li>
            <li><a href="#">Danh sách khách hàng</a></li>
            <li><a href="#">Doanh thu</a></li>
        </ul>
        
        <!-- Kiểm tra nếu người dùng đã đăng nhập -->
        <div class="form-login">
            <?php if (!empty($username)): ?>
                <span class="user-info">Chào, <?php echo $username; ?>!</span>
                <a href="logout.php" class="logout-btn">Đăng xuất</a>
            <?php else: ?>
                <button type="button" class="login-btn" onclick="window.location.href='login.php';">Đăng nhập</button>
            <?php endif; ?>
        </div>
    </nav>
</div>
</body>
</html>
