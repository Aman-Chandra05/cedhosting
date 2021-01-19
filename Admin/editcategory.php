<?php
require_once '../classes/dbcon.php';
require_once '../classes/product.php';
$product=new Product();
$conn = new Dbcon();
if(isset($_POST['id']) && isset($_POST['name']))
{
    $res=$product->updatecategory($_POST['id'],$_POST['name'],$conn->conn());
    if($res==-1)
        echo "Nothing Updated";
    elseif($res==1)
        echo "Updation Successfull";
    else
        echo "Updation Failed.";
}
if(isset($_POST['id']) && isset($_POST['status']))
{
	$res=$product->changeavailability($_POST['id'],$_POST['status'],$conn->conn());
	if($res=1)
		echo "1";
	else echo '0';
}

?>