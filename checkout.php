<?php
require_once 'classes/dbcon.php';
require_once 'classes/product.php';
require_once 'classes/user.php';
require_once 'classes/userbillingaddress.php';
require_once 'classes/State.php';
require_once 'classes/companyinfo.php';
if(!isset($_SESSION['username']) && !isset($_SESSION['userid']) && !isset($_SESSION['admin']))
{
	header('location:login.php');
}
if(isset($_SESSION['cart']) && count($_SESSION['cart'])!=0)
{
}
else 
{
	header('location:index.php');
}
$product=new Product();
$conn = new Dbcon();
$user=new User();
$add=new UserBillingAddress();
$state=new State();
$comstate=new CompanyInfo();
$totalprice=0;
$taxammount=0;
$details=array();
foreach ($_SESSION['cart'] as $key){
	 $totalprice=$totalprice+$key['totalprice'];
	 $detailsarray[]=array("productname"=>$key['prod_name'],"plan"=>$key['billingcycle'],"price"=>$key['ammount']);
}
$detailsarray[]=$totalprice;
$fetchaddress=$add->fetchbillingaddress($_SESSION['userid'],$conn->conn());
$details = json_encode($detailsarray);
$_SESSION['cartdetails']=$details;
?>
<?php
require_once 'header.php';
?>

<div class=container>
	<div class=row>
		<div class="col-sm-8">
			  <div class="form-group">
			    <h2>Choose Address</h2><br>
			    <?php
			    	for($i=0;$i<count($fetchaddress);$i++)
			    	{?>
			    		<input class="form-check-input address" name="address" type="radio" id="<?php echo $fetchaddress[$i]['id'];?>" name="address" value="<?php echo $fetchaddress[$i]['id'];?>">
  						<label class="form-check-label" for="<?php echo $fetchaddress[$i]['id'];?>"> Address <?php echo $i+1;?></label>&nbsp;
			    	<?php
			    }
			    ?>			   
			  </div>
			<form method="post" action="">
				<div class="form-group">
			    	<?php
			    	$res=$comstate->getstate($conn->conn());
			    	 ?>
			    <input type="hidden" class="form-control bill" disabled id="comstate" name="comstate" value="<?php echo $res;?>">
			  </div>
				<h1>Billing Address</h1><br>
			  <div class="form-group">
			    <label for="hno">House Number:</label>
			    <input type="text" class="form-control bill" id="hno" name="hno" placeholder="">
			    <p id="hnomsg"></p>
			  </div>
			  <div class="form-group">
			    <label for="city">City:</label>
			    <input type="text" class="form-control bill" id="city" name="city" placeholder="">
			    <p id="citymsg"></p>
			  </div>
			  <div class="form-group">
			    <label for="state">State:</label>
					<select class="form-control col-lg-4 bill" name="state" id="state">
	                    <option value="" selected disabled>Please Select State</option>
	                    
	                    <?php
	                    $res=$state->getallstate($conn->conn());
	                    if($res!=0)
	                    {                      
	                    foreach($res as $key)
	                    {
	                    ?>
	                    <option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
	                    <?php
	                    }?>
	                    <?php
	                    }?>
                    </select>
                    <p id="statemsg"></p>
			  </div>
			  <div class="form-group">
			    <label for="pincode">Pin code:</label>
			    <input type="number" class="form-control bill" id="pincode" name="pincode" placeholder="">
			    <p id="pincodemsg"></p>
			  </div>
			  <div class="form-group">
			    <label for="country">Country:</label>
			    <input type="text" class="form-control bill" id="country" name="country" placeholder="">
			    <p id="countrymsg"></p>
			  </div>




			  <div class="form-group">
			    <h1>Payment mode:</h1><br>
			    <input type="button" class="btn btn-danger" id="cod" value="COD">
			  </div>
			  <p id="orderid"></p>

			</form>
			<div class="form-group" id="paypal-button-container">
			  </div>
		</div>
		<div class="col-sm-4">
			<h2>Order Summary</h2>
</svg>
			    <?php 
				    if(isset($_SESSION['cart']))
				    	$count=count($_SESSION['cart']);
						echo '<br><h4 data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">'.$count.' Items in cart

<span style="align:right;position:relative;left:5rem"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/></span>
						</h4>';
						echo '<br><h5><strong>Total Price:</strong> &#36;<span id="totalprice">'.$totalprice.'</span></h5>';
				?>
				<div class="collapse" id="collapseExample">
				  <div class="card card-body">
				    <?php 
				    if(isset($_SESSION['cart']))
				    {
				    	foreach ($_SESSION['cart'] as $key) 
				    	{
				    	?>
					    	<br><p><strong>Product Name:</strong> <?php echo $key['prod_name'];?></p>
					    	<p><strong>Plan:</strong> <?php echo $key['billingcycle'];?></p>
					    	<p><strong>Amount:</strong> &#36;<?php echo $key['ammount'];?></p>
				    	<?php
					    }
					}
				    ?>
				  </div>
				</div>
		</div>
	</div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=AYbU9xq2ZlHz4splq62ZqLGxkgdi2Qoy7QMC_SSwR_964v-rVtlp5N--nh3LTbDdwh4OEkdhAbawGKnv"> 
  </script>

<script src="https://www.paypal.com/sdk/js?client-id=AYbU9xq2ZlHz4splq62ZqLGxkgdi2Qoy7QMC_SSwR_964v-rVtlp5N--nh3LTbDdwh4OEkdhAbawGKnv"></script>
<script src="index.js"></script>
<?php
require_once 'footer.php';
?>