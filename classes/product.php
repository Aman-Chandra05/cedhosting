<?php 
class Product
{
    public function create_category($name,$conn)
    {
        $sql="SELECT `prod_name` FROM `tbl_product` WHERE `prod_parent_id`='1'";
        $res=$conn->query($sql);
        if($res->num_rows>0)
        {
            while($row=$res->fetch_assoc())
            {
                $arr[]=$row;
            }
            foreach ($arr as $key) 
            {
                if(strtolower($key['prod_name'])==strtolower($name))
                {
                    $conn->close();
                    return -1;
                }
            }
           
        }
        $sql="INSERT INTO `tbl_product`(`prod_parent_id`, `prod_name`, `html`, `prod_available`, `prod_launch_date`) VALUES ('1','$name','','1',NOW())";
        $res=$conn->query($sql);
        if($res)
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
    public function getallcategories($conn)
    {
        $arr=array();
        $sql="SELECT * FROM `tbl_product` WHERE `prod_parent_id`='1'";
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
            $conn->close(); 
            return 0;
        }
    }
    public function deletecategory($id,$conn)
    {
        $sql="DELETE FROM `tbl_product` WHERE `id`='$id'";
        $res=$conn->query($sql);
        $conn->close();
    }
    public function updatecategory($id,$name,$conn)
    {
        if($name=='')
            return -1;
        $sql="SELECT * FROM `tbl_product` WHERE `id`='$id'";
        $res=$conn->query($sql);
        $res=$res->fetch_assoc();
        if($res['prod_name']==$name)
        {
            $conn->close();
            return -1;
        }         
        else
        {
            $sql="UPDATE `tbl_product` SET `prod_name`='$name' WHERE `id`='$id'";
            $res=$conn->query($sql);
            if($res)
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
    public function addproduct($category,$name,$pageurl,$mp,$ap,$sku,$desc,$conn)
    {
        $sql="SELECT * FROM `tbl_product` WHERE `prod_parent_id`='$category' AND `prod_name`='$name'";
        $res=$conn->query($sql);
        if($res->num_rows>0)
        {
            $conn->close();
            return -1;
        }
        $sql="INSERT INTO `tbl_product`(`prod_parent_id`, `prod_name`, `html`, `prod_available`, `prod_launch_date`) VALUES ('$category','$name','$pageurl','1',NOW())";
        $res=$conn->query($sql);
        if($res)
        {
            $pid=$conn -> insert_id;
            $sql="INSERT INTO `tbl_product_description`(`prod_id`, `description`, `mon_price`, `annual_price`, `sku`) VALUES ('$pid','$desc','$mp','$ap','$sku')";
            $res=$conn->query($sql);
            if($res)
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
        else 
        {
            $conn->close();
            return 0;
        }
    }
    public function getallproducts($conn)
    {
        $sql="SELECT * FROM `tbl_product` INNER JOIN `tbl_product_description` ON tbl_product.id=tbl_product_description.prod_id";
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
            $conn->close(); 
            return 0;
        }    
    }
    public function deleteproduct($id,$conn)
    {
        $sql="DELETE FROM `tbl_product` WHERE `id`='$id'";
        $res=$conn->query($sql);
        $sql="DELETE FROM `tbl_product_description` WHERE `prod_id`='$id'";
        $res=$conn->query($sql);
        $conn->close();
    }
    public function fetchcategory($id,$conn)
    {
        $sql="SELECT * FROM `tbl_product` WHERE `id`='$id' AND `prod_available`='1'";
        $res=$conn->query($sql);
        if($res->num_rows>0)
        {
            $arr=$res->fetch_assoc();
            $conn->close();
            return $arr;
        }
        else
        {
            $conn->close(); 
            return 0;          
        }
    }
    public function fetchproduct($id,$conn)
    {
        $sql="SELECT a.*,b.* FROM `tbl_product`AS a INNER JOIN `tbl_product_description` AS b ON a.id=b.prod_id WHERE a.id='$id' AND a.prod_available=1";
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
            $conn->close(); 
            return 0;
        }  
    }
    public function fetchallproducts($id,$conn)
    {
        $sql="SELECT a.*,b.* FROM `tbl_product`AS a INNER JOIN `tbl_product_description` AS b ON a.id=b.prod_id WHERE a.prod_parent_id='$id' AND a.prod_available=1";
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
            $conn->close(); 
            return 0;
        }  
    }
    public function updateproduct($id,$category,$name,$pageurl,$mp,$ap,$sku,$desc,$conn)
    {
        $sql="UPDATE `tbl_product` SET `prod_name`='$name',`prod_parent_id`='$category' WHERE `id`='$id'";
        $res=$conn->query($sql);
        if($res)
        {
            $sql="UPDATE `tbl_product_description` SET `description`='$desc',`mon_price`='$mp',`annual_price`='$ap',`sku`='$sku' WHERE `prod_id`='$id'";
            $res=$conn->query($sql);
            if($res)
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
}





?>