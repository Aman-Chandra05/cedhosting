<?php
require_once '../classes/dbcon.php';
require_once '../classes/product.php';
require_once '../classes/Order.php';
$product=new Product();
$conn = new Dbcon();
$order = new Order();


if(isset($_GET['operation']) && isset($_GET['id']))
{
    $res=$order->changestatus($_GET['operation'],$_GET['id'],$conn->conn());
    //echo $_GET['operation'];
}
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
                                <th scope="col">Dtae </th>
                                <th scope="col">Payment status</th>
                                <th scope="col">Discount</th>
                                <th scope="col" style="text-align: center;">Tax</th>
                                <th scope="col">Final Price</th>
                                <th scope="col" style="text-align: center;">Order</th>
                                <th scope='col'>Action</th>
                                
                            </tr>
                        </thead>
                        <?php                        
                            $res=$order->getallorders($_SESSION['userid'],$conn->conn());
                            if($res!=0)
                            {?>
                            <tbody>
                            <?php
                            foreach($res as $key)
                            {
                            ?>
                            <tr>
                            <td><?php echo $key['id'];?></td>
                            <td><?php echo $key['order_date'];?></td>
                            <td><?php if($key['status']==1) echo 'Completed'; elseif($key['status']==0) echo 'Pending';  elseif($key['status']==-1) echo "Cancelled";?></td>
                            <td>&#36; <?php echo $key['discount_amt'];?></td>
                            <td><ul><?php 
                                $tax=json_decode($key['tax_amt'],TRUE);
                                if(count($tax)==2)
                                {
                                    echo '<li>Igst: &#36;'.$tax['igst'].'</li>';
                                    echo '<li>Total Tax: &#36;'.$tax['tax'].'</li>';
                                }
                                elseif (count($tax)==3) {
                                    echo '<li>Cgst: &#36;'.$tax['cgst'].'</li>';
                                    echo '<li>Sgst: &#36;'.$tax['sgst'].'</li>';
                                    echo '<li>Total Tax: &#36;'.$tax['tax'].'</li>';
                                }
                                ?></ul></td>
                            <td>&#36; <?php echo $key['final_invoice_amt'];?></td>
                            <td>
                                <?php
                                    $details=json_decode($key['details'], true);
                                    echo "<ul>";
                                    for ($i=0; $i <count($details) ; $i++) { 
                                        if(is_array($details[$i]))
                                        {
                                            echo "<li>".$details[$i]['productname']."</li>";
                                        }
                                    }
                                    echo "</ul>";
                                    ?>
                        
                            </td>
                            </td>
                            <?php 
                                if($key['status']==0)
                                {
                               echo "<td><a class='btn btn-primary  btn-sm' href='?status=pending&action=none&operation=cancel&id=".$key['id']."'>Cancel</a>";   
                                }
                                else
                                {
                                    echo "<td><a class='btn btn-light btn-sm' href='javascript:void(0)'>None</a>";
                                }
                            ?>
                            </tr>
                            <?php
                            }?>
                            </tbody>
                            <?php
                            }
                    
                    ?>
                    </table>
                </div>              
            </div>
        </div>
    </div>
<?php
require_once 'footer.php';
?>
