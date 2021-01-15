<?php
require_once 'classes/dbcon.php';
require_once 'classes/product.php';
require_once 'classes/user.php';
require_once 'classes/userbillingaddress.php';
require_once 'classes/Order.php';
require_once 'classes/companyinfo.php';
$conn = new Dbcon();
$order=new Order();

$res=$order->fetchorder('4',$conn->conn());
echo "<pre>";
print_r($res);
echo "</pre>";
$des=json_decode($res['details'],TRUE);
// echo "<pre>";
// print_r($des);
// echo "</pre>";

// foreach($des as $key=>$value)
// {
//     if(is_array($value))
//     {
//         //echo "DGD";
//         // echo "<pre>";
//         // print_r($value);
//         // echo "</pre>";
//         echo "name: ".$value['productname'].'<br>';
//         echo "plan: ".$value['plan'].'<br>';
//         echo "price: ".$value['price'].'<br>';
//     }
//     else
//     echo $value.'<br>';
// }
for ($i=0; $i <count($des) ; $i++) { 
    if(is_array($des[$i]))
    {
        echo "name: ".$des[$i]['productname'].'<br>';
        echo "plan: ".$des[$i]['plan'].'<br>';
        echo "price: ".$des[$i]['price'].'<br>';
    }
    else
    echo 'total price: '.$des[$i].'<br>';
}

?>