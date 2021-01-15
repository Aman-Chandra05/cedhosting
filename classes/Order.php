<?php
//session_start();
class Order
{
	public function addorder($userid,$userbillindid,$status,$promocodeid,$disamm,$afterdis,$taxamm,$finalamm,$details,$conn)
	{
		$sql="INSERT INTO `tbl_orders`(`user_id`, `user_billing_id`, `order_date`, `status`, `promocode_applied_id`, `discount_amt`, `total_amt_after_dis`, `tax_amt`, `final_invoice_amt`,`details`) VALUES ('$userid','$userbillindid',NOW(),'$status','$promocodeid','$disamm','$afterdis','$taxamm','$finalamm','$details')";
        $res=$conn->query($sql);
        if($res===TRUE)
        {
        	$lastid=$conn -> insert_id;
        	$conn->close();
        	return $lastid;
        }			
		else
		{
			$conn->close();
			return 0;
		}	
	}

	public function getorderbystatus($status,$conn)
	{
		$arr=array();
		if($status=='pending')
			$sql="SELECT * FROM `tbl_orders` WHERE `status`='0'";
		elseif($status=='complete')
			$sql="SELECT * FROM `tbl_orders` WHERE `status`='1'";
		elseif($status=='cancelled')
			$sql="SELECT * FROM `tbl_orders` WHERE `status`='-1'";
		$res=$conn->query($sql);
		if($res->num_rows>0)
		{
			while($row=$res->fetch_assoc())
			{
				$arr[]=$row;
			}
			return $arr;
		}
		else
		return 0;
	}

	public function fetchorder($id,$conn)
	{
		$sql="SELECT * FROM `tbl_orders` WHERE `id`='$id'";
		$res=$conn->query($sql);
		if($res->num_rows>0)
		{
			$arr=$res->fetch_assoc();
			return $arr;
		}
	}

	public function changestatus($action,$id,$conn)
	{
		if($action=='cancel')
		{
			return '-1';
		}
	}
}


?>