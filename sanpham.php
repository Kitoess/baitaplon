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
    $sql = "SELECT * FROM sanpham WHERE name LIKE '%$search%' OR type LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM sanpham";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <link rel="stylesheet" href="css/sanpham.css">
</head>
<body>
    <div class="container">
        <h1>Danh Sách Sản Phẩm</h1>
        
        <!-- Thanh tìm kiếm -->
        <form method="get" class="search-form">
            <input type="text" name="search" placeholder="Tìm kiếm sản phẩm theo tên hoặc loại" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn">Tìm Kiếm</button>
        </form>
        
        <!-- Nút thêm sản phẩm -->
        <a href="insert.php" class="btn">Thêm Sản Phẩm</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Loại</th>
                    <th>Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>" . number_format($row['price'], 0, ',', '.') . " VND</td>
                                <td>{$row['type']}</td>
                                <td><img src='{$row['img']}' alt='{$row['name']}' width='100'></td>
                                <td>
                                    <a href='update.php?id={$row['id']}' class='btn-edit'>Sửa</a>
                                    <a href='sell.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Bạn có chắc chắn muốn xóa sản phẩm này không?\");'>Xóa</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Không có sản phẩm nào</td></tr>";
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
