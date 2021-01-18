<?php
require_once 'classes/dbcon.php';
require_once 'classes/product.php';
require_once 'classes/user.php';
require_once 'classes/userbillingaddress.php';
require_once 'classes/Order.php';
$product=new Product();
$conn = new Dbcon();
$user=new User();
$add=new UserBillingAddress();
$order=new Order();
$arr=array();
if(isset($_POST))
{
	$hno = isset($_POST['hno']) ? ($_POST['hno']) : "";
	$city = isset($_POST['city']) ? ($_POST['city']) : "";
	$state = isset($_POST['state']) ? ($_POST['state']) : "";
	$pincode = isset($_POST['pincode']) ? ($_POST['pincode']) : "";
	$country = isset($_POST['country']) ? ($_POST['country']) : "";
	$igst = isset($_POST['igst']) ? ($_POST['igst']) : "";
	$cgst = isset($_POST['cgst']) ? ($_POST['cgst']) : "";
	$sgst = isset($_POST['sgst']) ? ($_POST['sgst']) : "";
	$taxammount = isset($_POST['taxammount']) ? ($_POST['taxammount']) : "";
	$taxarray=array();
	if($igst!=0)
		$taxarray['igst']=$igst;
	if($sgst!=0)
		$taxarray['igst']=$sgst;
	if($cgst!=0)
		$taxarray['igst']=$cgst;
	$taxarray['tax']=$taxammount;
	$tax = json_encode($taxarray);
	$addressarray=array("hno"=>$hno,"city"=>$city,"state"=>$state,"pincode"=>$pincode,"country"=>$country);
	$address=json_encode($addressarray);

	if(isset($_POST['orderstatus']))
	{
		if($_POST['orderstatus']=="COMPLETED")
		{
			$status=1;
		}
		elseif ($_POST['orderstatus']=="PENDING") {
			$status=0;
		}
	}
	$res=$add->insertaddress($_SESSION['userid'],$_SESSION['username'],$hno,$city,$state,$country,$pincode,$conn->conn());
	echo '<br>ADDRESS'.$res;
		$res1=$order->addorder($_SESSION['userid'],$res,$status,'0','0','0',$tax,$_POST['payableprice'],$_SESSION['cartdetails'],$address,$conn->conn());
		if($res1)
		{
			unset($_SESSION['cart']);
			unset($_SESSION['cartdetails']);
			$arr=array("orderid"=>$res1, "res"=>"success");
			echo json_encode($arr);
			//echo $arr;
		}
		else
		{
			$arr=array("res"=>"fail");
			echo json_encode($arr);	
		}
	
}

?>