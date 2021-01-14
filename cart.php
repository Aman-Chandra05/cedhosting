<?php 
include "header.php";

if(isset($_GET['id']) && isset($_GET['action']))
{
	$id=$_GET['id'];
	if($_GET['action'])
	{
		foreach ($_SESSION['cart'] as $key=>$value) {
			if($value['prod_id']==$id)
            {
				unset($_SESSION['cart'][$key]); 
            ?>
            <script>
                location.reload();
            </script>        
            <?php       
            }
            
		}		
	}

}
// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";
?>
<div class="container">
	<?php
	if(isset($_SESSION['cart']) && count($_SESSION['cart'])!=0)
		{?>
<table  class="table">
  <thead>
    <tr>
    	<th>Product Id</th>
    	<th>Product Name</th>
    	<th>Product Category</th>
    	<th>sku</th>
    	<th>Billing Cycle</th>
    	<!--<th>Amount</th>
        <th>Tax rate</th>
        <th>Tax Amount</th> -->
        <th>Total Amount</th>
    	<th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($_SESSION['cart'] as $key) {
    ?>
    	<tr>
    		<td><?php echo $key['prod_id'];?></td>
    		<td><?php echo $key['prod_name'];?></td>    		
    		<td><?php echo $key['category'];?></td>
    		<td><?php echo $key['sku'];?></td>
    		<td><?php echo $key['billingcycle'];?></td>
    		<!-- <td><?php //echo $key['ammount'];?></td> -->
            <!-- <td><?php //echo $key['taxrate'];?></td> -->
            <!-- <td><?php //echo $key['taxammount'];?></td> -->
            <td><?php echo $key['totalprice'];?></td>
    		<td><a href="?id=<?php echo $key['prod_id'];?>&action=delete" class="btn btn-danger btn-sm">Remove</a></td>
    	</tr>

    	
    <?php
	}
    ?>
  </tbody>
</table>
<div>
    <div class="aa-payment-method">  
        <br><a href="checkout.php" class="btn btn-danger">Place Order</a>                             
    </div>
    <br>
</div>
  <?php
}
else
{?>
	<h2  style="margin-bottom:50px;" class="text-center mb-5">Your cart is Empty</h2>
<?php }?>
</div>
<?php include "footer.php";
?>
<script>
    console.log("ad");
</script>