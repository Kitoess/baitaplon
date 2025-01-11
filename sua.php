<?php
    require 'connect.php';

    // Kiểm tra xem người dùng đã gửi form chưa
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy giá trị từ form
        $id = (int)$_POST['id']; // Lấy id từ input ẩn
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $number = $_POST['number'];

        // Câu lệnh SQL để cập nhật
        $sql = "UPDATE khachhang 
                SET fullname = '$fullname', 
                    address = '$address', 
                    email = '$email', 
                    number = '$number' 
                WHERE id = $id";

        // Thực thi truy vấn
        if ($conn->query($sql) === TRUE) {
            // Chuyển hướng về trang danh sách
            header("Location: khachhang.php");
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        // Lấy thông tin khách hàng từ database để hiển thị lên form
        $id = (int)$_GET['id'];
        $sql = "SELECT * FROM khachhang WHERE id = $id";
        $result = $conn->query($sql);

        // Kiểm tra xem khách hàng có tồn tại không
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Không tìm thấy khách hàng";
            exit;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sửa khách hàng</title>
        <link rel="stylesheet" href="css/sua.css">
    </head>
    <body>
        <div>
            <form method="post">
                <!-- Input ẩn để lưu ID -->
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                
                <div>
                    <label for="fullname">Họ và tên: </label>
                    <input type="text" name="fullname" id="fullname" value="<?= $row['fullname'] ?>" required>
                </div>
                <div>
                    <label for="address">Địa chỉ: </label>
                    <input type="text" name="address" id="address" value="<?= $row['address'] ?>" required>
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" value="<?= $row['email'] ?>" required>
                </div>
                <div>
                    <label for="number">Số điện thoại: </label>
                    <input type="number" name="number" id="number" value="<?= $row['number'] ?>" required>
                </div>
                <input type="submit" value="Lưu">
            </form>
        </div>
    </body>
</html>
