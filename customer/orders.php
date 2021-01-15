<?php
require_once '../classes/dbcon.php';
require_once '../classes/product.php';
require_once '../classes/Order.php';
$product=new Product();
$conn = new Dbcon();
$order = new Order();


// if(isset($_GET['operation']) && isset($_GET['id']))
// {
//     //$res=$order->changestatus($_GET['operation'],$_GET['id'],$conn);
//     echo $_GET['operation'];
// }
?>


<?php
require_once 'header.php';
?>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card  p-3">
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush" id="subcategory_table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Order Id</th>
                                <th scope="col">User Billing Id</th>
                                <th scope="col">Dtae </th>
                                <th scope="col">Payment status</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Tax</th>
                                <th scope="col">Final Price</th>
                                <th scope="col" style="text-align: center;">Order</th>
                                <?php 
                                if(isset($_GET['status']) && $_GET['status']=='pending')
                                    ?>
                                <th scope="col">Action</th>
                                
                            </tr>
                        </thead>
                        <?php
                        if(isset($_GET['status']))
                        {
                            $res=$order->getorderbystatus($_GET['status'],$conn->conn());
                            if($res!=0)
                            {?>
                            <tbody>
                            <?php
                            foreach($res as $key)
                            {
                            ?>
                            <tr>
                            <td><?php echo $key['id'];?></td>
                            <td><?php echo $key['user_billing_id'];?></td>
                            <td><?php echo $key['order_date'];?></td>
                            <td><?php if($key['status']==1) echo 'Completed'; elseif($key['status']==0) echo 'Pending';?></td>
                            <td>&#36; <?php echo $key['discount_amt'];?></td>
                            <td>&#36; <?php echo $key['tax_amt'];?></td>
                            <td>&#36; <?php echo $key['final_invoice_amt'];?></td>
                            <td>
                                <?php
                                    $details=json_decode($key['details'], true);
                                    foreach ($details as $key1) {
                                        ?>
                                        <ul>
                                            <li><?php echo $key1;?></li>
                                        </ul>
                                    <?php
                                }
                                ?>
                            </td>
                            </td>
                            <?php 
                                if(isset($_GET['status']) && $_GET['status']=='pending')
                                {
                               echo "<td><a class='btn btn-primary  btn-sm' href='?action=none&operation=cancel&id=".$key['id']."'>Cancel</a>";   
                                }
                            ?>
                            </tr>
                            <?php
                            }?>
                            </tbody>
                            <?php
                            }
                    }
                    //else echo '5555';?>
                    </table>
                </div>              
            </div>
        </div>
    </div>
<?php
require_once 'footer.php';
?>