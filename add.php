<?php
require ('connect.php');
if(isset($_POST['add']))
{
    $name = $_POST['name'];
    $price = $_POST['price'];
    $pname = $_FILES["img"]["name"];
    $upload_dir = 'images/';
    $upload_file= $upload_dir . basename($_FILES["img"]["name"]);
    move_uploaded_file($_FILES["img"]["tmp_name"],$upload_file); 
    $sql = "INSERT INTO `sanpham` (`name`,`price`,`img`)
            VALUES ('$name','$price','$upload_file')";
    if($conn->query($sql)=== TRUE)
    {
        $message = "Thêm sản phẩm thành công";
       echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
$sql1 = "SELECT * FROM sanpham";
$result = $conn->query($sql1);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nhập thông tin</title>
    </head>
    <body>
        <div>
            <form enctype="multipart/form-data" method="post">
                <div>
                <label for="name">Tên sản phẩm:</label>
                <input type="text" name="name" id="name">
                </div>
                <div>
                    <label for="price">Giá: </label>
                    <input type="number" name="price" id="price">
</div>
            <div>
                <label for="img">Hình ảnh</label>
                <input type="File" name="img" id="img">
            </div>  
                <input type="submit" name="add" value="Lưu">
            </form>
        </div>
        <div>
        </div>
</body>
</html>
