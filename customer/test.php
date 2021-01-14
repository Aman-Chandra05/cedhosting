<?php
require_once '../classes/dbcon.php';
require_once '../classes/product.php';
$product=new Product();
$conn = new Dbcon();
$conn = $conn->conn();
$failure='';
$success='';
?>
<?php
$arr=array();
if(isset($_POST['update']))
{
  $val=$_POST['editor1'];
  $sql="UPDATE `tbl_product` SET `html`='$val'";
  $res=$conn->query($sql);
}
if(isset($_POST['show']))
{
  $sql="SELECT `html` FROM `tbl_product` WHERE `id`='2'";
  $res=$conn->query($sql);
  $arr=$res->fetch_assoc();
}
echo count($arr);
?>


<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
</head>
<body>
  <form action="" method="post">
                <textarea name="editor1"><?php if(count($arr)!=0)echo $arr['html'];?></textarea>
                <script>
                        CKEDITOR.replace( 'editor1' );
                </script>

    <input type="submit" value="update" name="update">
  </form>
  <form action="" method="post">
    <input type="submit" value="show" name="show">
  </form>

</body>
</html>