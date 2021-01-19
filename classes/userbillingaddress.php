<?php
class UserBillingAddress
{
	public function insertaddress($id,$billingname,$hno,$city,$state,$country,$pincode,$conn)
	{
		$arr=array();
		$sql="SELECT * FROM `tbl_user_billing_add` WHERE `user_id`='$id'";
		$res=$conn->query($sql);
		if($res->num_rows>0)
		{
			while($row=$res->fetch_assoc())
			{
				$arr[]=$row;
			}
			foreach ($arr as $key) {
				if($key['house_no']==$hno && $key['city']==$city && $key['state']=$country && $key['country']==$country && $key['pincode']==$pincode)
				{
					return 1;
				}
			}
        	$sql="INSERT INTO `tbl_user_billing_add`(`user_id`, `billing_name`, `house_no`, `city`, `state`, `country`, `pincode`) VALUES ('$id','$billingname','$hno','$city','$state','$country','$pincode')";
        
            $res=$conn->query($sql);
            if($res===TRUE)
            {
            	$latestid=$conn -> insert_id;
            	return 1;
            }			
    		else
    			return -1;
		}
		else
        {
        	// $sql="SELECT * FROM `tbl_user_billing_add` WHERE `user_id`='$id' AND `fixed`='1'";
        	// $res
        	$sql="INSERT INTO `tbl_user_billing_add`(`user_id`, `billing_name`, `house_no`, `city`, `state`, `country`, `pincode`) VALUES ('$id','$billingname','$hno','$city','$state','$country','$pincode')";
        
            $res=$conn->query($sql);
            if($res===TRUE)
            {
            	$latestid=$conn -> insert_id;
            	return $latestid;
            }			
    		else
    			return -1;
        }
	}

	/*public function updatebillingaddress($id,$billingname,$hno,$city,$state,$country,$pincode,$conn)
	{
		$sql="UPDATE `tbl_user_billing_add` SET `billing_name`='$billingname',`house_no`='$hno',`city`='$city',`state`='$state',`country`='$country',`pincode`='$pincode' WHERE `user_id`='$id' AND `fixed`='0'"; 
		$res=$conn->query($sql);
		if($res===TRUE)
			return 1;
		else return 0;
	}*/
	public function fetchbillingaddress($id,$conn,$orderid=-1)
	{
		$arr=array();
		if($orderid==-1)	
			$sql="SELECT * FROM `tbl_user_billing_add` WHERE `user_id`='$id'";
		else
			$sql="SELECT * FROM `tbl_user_billing_add` WHERE `user_id`='$id' AND `id`='$orderid'";
		$res=$conn->query($sql);
		if($res->num_rows>0)
		{
			while($row=$res->fetch_assoc())
			{
				$arr[]=$row;
			}
			return $arr;
		}
		else return 0;
	}
}


?>