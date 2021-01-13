<?php
class CompanyInfo
{
	public function getstate($conn)
	{
		$sql="SELECT * FROM `tbl_company_info`";
		$res=$conn->query($sql);
		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
			$state=$row['comp_state'];
			$conn->close();
			return $state;
		}
		else
		{
			$conn->close();
			return -1;
		}
	}
}





?>