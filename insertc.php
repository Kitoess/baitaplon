<?php
    require ('connect.php');
    if(isset($_POST['insert']))
    {
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $sql = "INSERT INTO `khachhang`(`fullname`,`address`,`email`,`number`)
        VALUES ('$fullname','$address','$email','$number')";
        if($conn->query($sql) === TRUE) {
            $message = "Thêm khách hàng thành công";
            echo "<script type='text/javascript'>alert('$message');</script>";
            // Chuyển hướng lại trang danh sách khách hàng
            echo "<script type='text/javascript'>window.location.href = 'khachhang.php';</script>";
        } else {
            $message = "Lỗi: " . $conn->error;
            echo "<script type='text/javascript'>alert('$message');</script>";
        }        
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Hàng</title>
    <link rel="stylesheet" href="css/insertc.css">
    </head>
    <body>
        <div>
            <form method="post">
                <div>
                    <label for="fullname">Họ và tên: </label>
                    <input type="text" name="fullname" id="fullname">
                </div>
                <div>
                    <label for="address">Địa chỉ: </label>
                    <input type="text" name="address" id="address">
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email">
                </div>
                <div>
                    <label for="number">Số điện thoại: </label>
                    <input type="number" name="number" id="number">
                </div>
                <input type="submit" name="insert" value="Lưu">
            </form>
        </div>
    </body>
</html>