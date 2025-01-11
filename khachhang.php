<?php
// Kết nối tới database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanly";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý tìm kiếm
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM khachhang WHERE fullname LIKE '%$search%' OR address LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM khachhang";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Khách Hàng</title>
    <link rel="stylesheet" href="css/khachhang.css">
</head>
<body>
    <div class="container">
        <h1>Danh Sách Khách Hàng</h1>
        
        <!-- Thanh tìm kiếm -->
        <form method="get" class="search-form">
            <input type="text" name="search" placeholder="Tìm kiếm khách hàng theo tên hoặc địa chỉ" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn">Tìm kiếm</button>
        </form>
        
        <!-- Nút thêm khách hàng -->
        <a href="insertc.php" class="btn">Thêm Khách Hàng</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ và Tên</th>
                    <th>Địa Chỉ</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['fullname']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['number']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['password']}</td>
                                <td>
                                    <a href='sua.php?id={$row['id']}' class='btn-edit'>Sửa</a>
                                    <a href='xoa.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Bạn có chắc chắn muốn xóa khách hàng này không?\");'>Xóa</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Không có khách hàng nào</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>
