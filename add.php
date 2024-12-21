<?php
require ('connect.php');
if(isset($_POST['add']))
{
    $name = $_POST['name'];
    $price = intval($_POST['price']);
    $type = $_POST['type'];
    $pname = $_FILES["img"]["name"];
    $upload_dir = 'images/';
    $upload_file= $upload_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
{
    $message = "Chỉ nhận tệp có định dạng JPG, JPEG, PNG";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
  else { 
    move_uploaded_file($_FILES["img"]["tmp_name"], $upload_file); 
    $sql = "INSERT INTO `sanpham` (`name`, `price`, `type`, `img`)
            VALUES ('$name', '$price', '$type', '$upload_file')";
    if($conn->query($sql) === TRUE )
             {
                 $message = "Thêm sản phẩm thành công";
                 echo "<script type='text/javascript'>alert('$message');</script>";
             }
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
                    <label for="">Thể loại:</label>
                    <select id="type" name="type">
                    <option value="0">PS5</option>
                    <option value="1">PS4</option>
                    <option value="2">Nintendo Switch</option>
                    <option value="3">XBOX ONE</option>
                    </select>
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
