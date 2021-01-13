<?php
require_once 'classes/dbcon.php';
require_once 'classes/product.php';
$product=new Product();
$conn = new Dbcon();
$status=-1;
if(isset($_POST['prodid']) && isset($_POST['id']) && isset($_POST['plan']))
{
    $res=$product->fetchproduct($_POST['prodid'],$conn->conn());
    if($_POST['plan']=="Monthly")
    {
        $price=$res[0]['mon_price'];
    }
    elseif ($_POST['plan']=="Annual") 
    {
        $price=$res[0]['annual_price'];            
    }
    $cat=$product->fetchcategory($res[0]['prod_parent_id'],$conn->conn());  
    if(isset($_SESSION['cart']))
    {
        $arrid=array_column($_SESSION['cart'], 'prod_id');
        if(count($_SESSION['cart'])==0)
        {
           $taxammount=2*$price/100;
           $totalprice=$taxammount+$price;
            $item=array(
                'prod_id'=>$res[0]['prod_id'],
                'prod_name'=>$res[0]['prod_name'],
                'category'=>$cat['prod_name'],
                'sku'=>$res[0]['sku'],
                'billingcycle'=>$_POST['plan'],
                'ammount'=>$price,
                'taxrate'=>2,
                'taxammount'=>$taxammount,
                'totalprice'=>$totalprice
            );
            $_SESSION['cart'][]=$item;     
            $status=1;       
        }
        else
        {
            if(!in_array($_POST['prodid'], $arrid))
            {
           $taxammount=2*$price/100;
           $totalprice=$taxammount+$price;
            $item=array(
                'prod_id'=>$res[0]['prod_id'],
                'prod_name'=>$res[0]['prod_name'],
                'category'=>$cat['prod_name'],
                'sku'=>$res[0]['sku'],
                'billingcycle'=>$_POST['plan'],
                'ammount'=>$price,
                'taxrate'=>2,
                'taxammount'=>$taxammount,
                'totalprice'=>$totalprice
            );
                $_SESSION['cart'][]=$item;   
                $status=1;      
            }
            else
            {
                $status=0;
            }
        }
    }
    else
    {
           $taxammount=2*$price/100;
           $totalprice=$taxammount+$price;
            $item=array(
                'prod_id'=>$res[0]['prod_id'],
                'prod_name'=>$res[0]['prod_name'],
                'category'=>$cat['prod_name'],
                'sku'=>$res[0]['sku'],
                'billingcycle'=>$_POST['plan'],
                'ammount'=>$price,
                'taxrate'=>2,
                'taxammount'=>$taxammount,
                'totalprice'=>$totalprice
            );
        $_SESSION['cart'][0]=$item;   
        $status=1;
    }
}
if($status==1)
{
    echo "Product added!!!";
}
elseif ($status==0) {
    echo "Product present in cart";
}
else
{
    echo "Some error occured";
}

?>