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
if(isset($_POST['checkout']))
{
	$hno = isset($_POST['hno']) ? ($_POST['hno']) : "";
	$city = isset($_POST['city']) ? ($_POST['city']) : "";
	$state = isset($_POST['state']) ? ($_POST['state']) : "";
	$pincode = isset($_POST['pincode']) ? ($_POST['pincode']) : "";
	$country = isset($_POST['country']) ? ($_POST['country']) : "";
	$res=$add->insertaddress($_SESSION['userid'],$_SESSION['username'],$hno,$city,$state,$country,$pincode,$conn->conn());
 }
 $totalprice=0;
 $taxammount=0;
 foreach ($_SESSION['cart'] as $key)  {
 	//$taxammount=$taxammount+$key['taxammount'];
 	$totalprice=$totalprice+$key['totalprice'];
 }
?>
<?php
require_once 'header.php';
?>

<div class=container>
	<div class=row>
		<div class="col-sm-8">
			<form method="post" action="">
				<div class="form-group">
			    	<?php
			    	$res=$comstate->getstate($conn->conn());
			    	 ?>
			    <input type="hidden" class="form-control" disabled id="comstate" name="comstate" value="<?php echo $res;?>">
			  </div>
				<h1>Billing Address</h1><br>
			  <div class="form-group">
			    <label for="hno">House Number:</label>
			    <input type="text" class="form-control" id="hno" name="hno" placeholder="">
			    <p id="hnomsg"></p>
			  </div>
			  <div class="form-group">
			    <label for="city">City:</label>
			    <input type="text" class="form-control" id="city" name="city" placeholder="">
			    <p id="citymsg"></p>
			  </div>
			  <div class="form-group">
			    <label for="state">State:</label>
			    <!-- <input type="text" class="form-control" id="state" name="state" placeholder=""> -->
					<select class="form-control col-lg-4" name="state" id="state">
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
			    <input type="number" class="form-control" id="pincode" name="pincode" placeholder="">
			    <p id="pincodemsg"></p>
			  </div>
			  <div class="form-group">
			    <label for="country">Country:</label>
			    <input type="text" class="form-control" id="country" name="country" placeholder="">
			    <p id="countrymsg"></p>
			  </div>
			  <div class="form-group">
			    <h1>Payment mode:</h1><br>
			    <!-- <label for="cod">COD</label> <input type="radio" id="cod" name="paymenttype" value="cod">
			    &nbsp;<label for="paypal">PayPal</label> <input type="radio" id="paypal" name="paymenttype" value="paypal">        
			    <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" alt="PayPal Acceptance Mark">  -->
			    <input type="button" class="btn btn-danger" id="cod" value="COD">
			  </div>
			  <p id="orderid"></p>
			  <!-- <div class="form-group">
				<input type="submit" name="checkout" class="btn btn-danger" value="Submit">
			  </div> -->

			  <!--<div class="form-group">
			    <label for="exampleFormControlSelect1">City</label>
			    <select class="form-control" id="exampleFormControlSelect1">
			      <option>1</option>
			      <option>2</option>
			      <option>3</option>
			      <option>4</option>
			      <option>5</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlSelect2">Example multiple select</label>
			    <select multiple class="form-control" id="exampleFormControlSelect2">
			      <option>1</option>
			      <option>2</option>
			      <option>3</option>
			      <option>4</option>
			      <option>5</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlTextarea1">Example textarea</label>
			    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
			  </div>-->
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
						//echo '<br><h5>Tax Price: &#36;<span id="taxammount">'.$taxammount.'</span></h5>';
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