<?php
require('connect.php');
$id = (int) $_GET['id'];
$sql = "SELECT * FROM `sanpham` WHERE `id` = {$id}";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($_SERVER['REQUEST_METHOD']==='POST')
{  
    $name = $_POST['name'];
    $price = intval($_POST['price']);
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $pname = $_FILES["img"]["name"];
    $upload_dir = 'images/';
    $upload_file= $upload_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
{
    $message = "Chỉ nhận tệp có định dạng JPG, JPEG, PNG";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
  else { 
    move_uploaded_file($_FILES["img"]["tmp_name"], $upload_file); 
    $update = "UPDATE sanpham SET name = '$name', price = '$price', type = '$type', quantity = '$quantity', img = '$upload_file' WHERE id = {$id}";
if($conn ->query($update)===TRUE)
{
    header('Location:hienthi.php');
}
}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sửa Sản Phẩm</title>
        <link rel="stylesheet" href="css/update.css">
    </head>
    <body>
    <div>
            <form enctype="multipart/form-data" method="post">
                <div>
                <label for="name">Tên sản phẩm:</label>
                <input type="text" name="name" id="name" value="<?=$row['name']?>">
                </div>
                <div>
                    <label for="price">Giá: </label>
                    <input type="number" name="price" id="price" value="<?=$row['price']?>">
                </div>
                <div>
                    <label for="">Thể loại:</label>
                    <select id="type" name="type">
                    <option value="0" <?= $row['type']==0 ? 'selected':''?>>PS5</option>
                    <option value="1" <?= $row['type']==1 ? 'selected':''?>>PS4</option>
                    <option value="2" <?= $row['type']==2 ? 'selected':''?>>Nintendo Switch</option>
                    <option value="3" <?= $row['type']==3 ? 'selected':''?>>XBOX ONE</option>
                    </select>
                </div>
                <div>
                    <label for="quantity">Số lượng: </label>
                    <input type="number" name="quantity" id="quantity" value="<?=$row['quantity']?>">
                </div>
            <div>
                <label for="img">Hình ảnh</label>
                <input type="File" name="img" id="img" value="<?=$row['img']?>">
            </div>  
            <div>
                <label for="img">Thông tin sản phẩm: </label>
                <textarea name="info" id="info" value="<?=$row['info']?>"></textarea>
            </div>
                <input type="submit" value="Lưu">
            </form>
        </div>
        <div>
        </div>
    </body>
</html>