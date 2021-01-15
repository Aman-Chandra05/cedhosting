<?php
require_once 'classes/dbcon.php';
require_once 'classes/product.php';
$conn=new Dbcon();
$product=new Product();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Ced Hosting</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Planet Hosting Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<!---fonts-->
<link href='//fonts.googleapis.com/css?family=Voltaire' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!---fonts-->
<!--script-->
<script src="js/modernizr.custom.97074.js"></script>
<script src="js/jquery.chocolat.js"></script>
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<!--lightboxfiles-->
<script type="text/javascript">
	$(function() {
	$('.team a').Chocolat();
	});
</script>	
<script type="text/javascript" src="js/jquery.hoverdir.js"></script>	
<script type="text/javascript">
	$(function() {
	
		$(' #da-thumbs > li ').each( function() { $(this).hoverdir(); } );

	});
</script>	
<link rel="stylesheet" href="css/swipebox.css">
			<script src="js/jquery.swipebox.min.js"></script> 
			    <script type="text/javascript">
					jQuery(function($) {
						$(".swipebox").swipebox();
					});
				</script>
<!--script-->					
<!--script-->
<link href="css/mycss.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/myjs.js"></script>

</head>
<body>
	<!---header--->
		<div class="header">
			<div class="container">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<i class="sr-only">Toggle navigation</i>
								<i class="icon-bar"></i>
								<i class="icon-bar"></i>
								<i class="icon-bar"></i>
							</button>				  
							<div class="navbar-brand">
								<h1><a href="index.php"><span class="ced">Ced</span> <span class="hosting">Hosting</span></a></h1>
							</div>
						</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="active"><a href="index.php">Home <i class="sr-only">(current)</i></a></li>
								<li><a href="about.php">About</a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hosting<i class="caret"></i></a>
									<ul class="dropdown-menu">
										<?php
										$res=$product->getallcategories($conn->conn());
										if($res!=0)
										{
											foreach($res as $key)
											{
										?>
										<li><a href="catpage.php?id=<?php echo $key['id'];?>"><?php echo $key['prod_name']; ?></a></li>
										<?php 
										}
										}?>
									</ul>			
								</li>
								<li><a href="pricing.php">Pricing</a></li>
								<li><a href="blog.php">Blog</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li id="shoppingcart"><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><span id="badge" class="badge badge-secondary"><?php 
									echo '0';
								?></span>
							</a></li>
								<?php if(isset($_SESSION['userid'])&&isset($_SESSION['username']))
								  {?>
								  <li><a href="logout.php">Log out</a></li>
								  <?php
								  }
								  else
								  {?>
								  <li><a href="login.php">Login</a></li>
								  <?php
								  }?>
							</ul>
									  
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div>
		</div>
	<!---header--->
<?php
require_once 'classes/Order.php';
require_once 'classes/dbcon.php';
$conn = new Dbcon();
$order=new Order();
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
				<p><strong>Total amount: </strong>&#36; <?php echo $totalprice;?></p>
				
				<p><?php if($_GET['trans']==0)    
					{
						echo "<p><strong>IGST: </strong>&#36; ".$_GET['igst'];
					}
					elseif($_GET['trans']==1)
					{
						echo "<p><strong>CGST:</strong>&#36; ".$_GET['cgst'];
						echo "<p><strong>SGST:</strong>&#36; ".$_GET['sgst'];
					}

				?>
				<p><strong>Total Tax amount: </strong>&#36; <?php echo $_GET['tax'];?></p>
				<p><strong>Final amount: </strong>&#36; <?php echo $_GET['finalpay'];?></p>		
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
		unset($_SESSION['cartdetails']);
	}
	/*if(isset($_GET['status']))
	{
		$res=$order->fetchorder($_GET['id'],$conn->conn());
		$details=json_decode($res['details'], true);
		echo "<pre>";
		print_r($details);
		echo "</pre>";

	}	?>		
			<h2>Customer Name: <?php echo $_SESSION['username'];   ?></h2>
			<h3><br>Items Purchased</h3>
			<div>
				<?php
		    	foreach ($res as $key) 
		    	{
		    	?>
			    	<p><strong>Product Name:</strong> <?php echo $key['prod_name'];?></p>
			    	<!-- <p><strong>Plan:</strong> <?php //echo $key['billingcycle'];?></p> -->
			    	<p><strong>Amount:</strong> &#36;<?php echo $key['ammount'];?></p><br>
		    	<?php
			    }
				?>
			</div>

	*/?>

</div>






<?php
require_once 'footer.php';
?>

