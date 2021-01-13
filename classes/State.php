<?php
class State
{
	public function getallstate($conn)
	{
        $arr=array();
        $sql="SELECT * FROM `tbl_state`";
        $res=$conn->query($sql);
        if($res->num_rows>0)
        {
            while($row=$res->fetch_assoc())
            {
                $arr[]=$row;
            }
            $conn->close();
            return $arr;
        }
        else 
        {
        	return $conn->error;
            $conn->close(); 
            
        }
    }		
}

?>