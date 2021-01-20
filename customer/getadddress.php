<?php
require_once '../classes/dbcon.php';
require_once '../classes/product.php';
require_once '../classes/user.php';
require_once '../classes/userbillingaddress.php';
require_once '../classes/Order.php';
$product=new Product();
$conn = new Dbcon();
$user=new User();
$add=new UserBillingAddress();
$order=new Order();
$arr=array();
if(isset($_POST))
{
	if(isset($_POST['address']) && $_POST['address']=='fetchaddress')
	{
		$res=$add->fetchbillingaddress($_SESSION['userid'],$conn->conn(),$_POST['id']);
		echo json_encode($res);
	}
	
}

?>