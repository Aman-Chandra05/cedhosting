<?php
require_once 'header.php';
$totalprice=0;

if(!isset($_SESSION['cart'])|| !isset($_GET['status']))
{
?>
<script>location.replace("index.php");</script>
<?php
}
if (count($_SESSION['cart'])==0)
{
?>
<script>location.replace("index.php");</script>
<?php
}

 foreach ($_SESSION['cart'] as $key)  {
 	//$taxammount=$taxammount+$key['taxammount'];
 	$totalprice=$totalprice+$key['totalprice'];
 }
?>
<div class="container">
	<?php
	if(isset($_GET['status']))
	{?>

			<h2>Customer Name: <?php echo $_SESSION['username'];   ?></h2>
			<h3><br>Items Purchased</h3>
			<div>
				<?php
		    	foreach ($_SESSION['cart'] as $key) 
		    	{
		    	?>
			    	<p><strong>Product Name:</strong> <?php echo $key['prod_name'];?></p>
			    	<p><strong>Plan:</strong> <?php echo $key['billingcycle'];?></p>
			    	<p><strong>Amount:</strong> &#36;<?php echo $key['ammount'];?></p><br>
		    	<?php
			    }
				?>
			</div>
				<p><strong>Total ammount: </strong>&#36; <?php echo $totalprice;?></p>
				<p><strong>Tax ammount: </strong>&#36; <?php echo $_GET['tax'];?></p>
				<p><strong>Final ammount: </strong>&#36; <?php echo $_GET['finalpay'];?></p>		
		<?php
		if ($_GET['status']=='PENDING') 
		{
			?>
			<div class="failure">
				<strong><?php echo "Payment Status: Pending";?></strong>
			</div>
		<?php
		}
		elseif ($_GET['status']=='COMPLETED') {?>
			<div class="success">
				<strong><?php echo "Payment Status: Success";?></strong>
			</div>
		<?php
		}
		unset($_SESSION['cart']);
	}





	?>

</div>






<?php
require_once 'footer.php';
?>

