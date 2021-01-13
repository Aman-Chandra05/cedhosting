<?php
class UserBillingAddress
{
	public function insertaddress($id,$billingname,$hno,$city,$state,$country,$pincode,$conn)
	{
		//$arr=$pincode;
        $sql="INSERT INTO `tbl_user_billing_add`(`user_id`, `billing_name`, `house_no`, `city`, `state`, `country`, `pincode`) VALUES ('$id','$billingname','$hno','$city','$state','$country','$pincode')";

        $res=$conn->query($sql);
        if($res===TRUE)
        {
        	$latestid=$conn -> insert_id;
        	return $latestid;
        }
		
	else
		return $conn->error;
	}
}


?>