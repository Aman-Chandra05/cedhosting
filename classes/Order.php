<?php
class Order
{
	public function addorder($userid,$userbillindid,$status,$promocodeid,$disamm,$afterdis,$taxamm,$finalamm,$details,$conn)
	{
		$sql="INSERT INTO `tbl_orders`(`user_id`, `user_billing_id`, `order_date`, `status`, `promocode_applied_id`, `discount_amt`, `total_amt_after_dis`, `tax_amt`, `final_invoice_amt`,`details`) VALUES ('$userid','$userbillindid',NOW(),'$status','$promocodeid','$disamm','$afterdis','$taxamm','$finalamm','$details')";
        $res=$conn->query($sql);
        if($res===TRUE)
        {
        	$conn->close();
        	return 1;
        }			
		else
		{
			$conn->close();
			return 0;
		}	
	}
}


?>