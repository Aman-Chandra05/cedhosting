<?php
require_once '../classes/dbcon.php';
require_once '../classes/product.php';
$product=new Product();
$conn = new Dbcon();
if(isset($_GET['action']) && isset($_GET['id']))
{
    if($_GET['action']=='delete')
    {
        $product->deleteproduct($_GET['id'],$conn->conn());
    }
}
?>
<?php
require_once 'header.php';
?>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h1 class="mb-0">Saved Products</h1>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Launch Date</th>
                                <th scope="col">Monthly Price</th>
                                <th scope="col">Annual Price</th>
                                <th scope="col">Sku</th>
                                <th scope="col">Web Space</th>
                                <th scope="col">Bandwidth</th>
                                <th scope="col">Free Domain</th>
                                <th scope="col">Mailbox</th>
                                <th scope="col">Language / Technology Support</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $res=$product->getallproducts($conn->conn());
                        if($res!=0)
                        {?>
                        <tbody>
                        <?php
                        foreach($res as $key)
                        {
                            $desc=json_decode($key['description'], true);
                        ?>
                        <tr>
                            <td><?php echo $key['prod_id'];?></td>
                            <td><?php echo $key['prod_name'];?></td>
                            <td><?php echo $key['prod_launch_date'];?></td>
                            <td><?php echo $key['mon_price'];?></td>
                            <td><?php echo $key['annual_price'];?></td>
                            <td><?php echo $key['sku'];?></td>
                            <td><?php echo $desc['webspace'];?></td>
                            <td><?php echo $desc['bandwidth'];?></td>
                            <td><?php echo $desc['free_domain'];?></td>
                            <td><?php echo $desc['mailbox'];?></td>
                            <td><?php echo $desc['language'];?></td>
                            <td><a href="updateproduct.php?id=<?php echo $key['prod_id'];?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="?action=delete&id=<?php echo $key['prod_id'];?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php    
                        }
                         echo "</tbody>";
                        }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
require_once 'footer.php';
?>