<?php
require_once 'classes/dbcon.php';
require_once 'classes/product.php';
require_once 'classes/user.php';
require_once 'classes/userbillingaddress.php';
$product=new Product();
$conn = new Dbcon();
$user=new User();
$add=new UserBillingAddress();
if(isset($_POST))
{
	$hno = isset($_POST['hno']) ? ($_POST['hno']) : "";
	$city = isset($_POST['city']) ? ($_POST['city']) : "";
	$state = isset($_POST['state']) ? ($_POST['state']) : "";
	$pincode = isset($_POST['pincode']) ? ($_POST['pincode']) : "";
	$country = isset($_POST['country']) ? ($_POST['country']) : "";
	$res=$add->insertaddress($_SESSION['userid'],$_SESSION['username'],$hno,$city,$state,$country,$pincode,$conn->conn());
	echo $res;
	
}

?>