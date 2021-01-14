<?php
require_once 'classes/dbcon.php';
require_once 'classes/user.php';
$user=new User();
$conn = new Dbcon();
$msg='';
$err='';
if(isset($_POST['login']) && $_POST['login']=='Login')
{

	$email = isset($_POST['email']) ? ($_POST['email']) : "";
	$password = isset($_POST['password']) ? ($_POST['password']) : "";
	$res=$user->login($email,$password,$conn->conn());
	if($res==0)
		$err="Enter correct login details";
	else {
		if($res['active']==0)
		{
			$err="** Your account is not activated";
		}
		else 
		{
			if($res['is_admin']==0)
			{
				$_SESSION['userid']=$res['id'];
				$_SESSION['username']=$res['name'];
				$_SESSION['admin']=$res['is_admin'];
				header('location:index.php');

			}
			else
			{
				$_SESSION['userid']=$res['id'];
				$_SESSION['username']=$res['name'];
				$_SESSION['admin']=$res['is_admin'];
				header('location:Admin/');
			}
		}
	}
}
?>
<?php
require_once 'header.php';
?>
<!---login--->
<div class="content">
	<div class="main-1">
		<div class="container">
			<div class="login-page">
				<div class="account_grid">
					<div class="col-md-6 login-left">
						<h3>new customers</h3>
						<p>By creating an account with our store, you will be able to move through the checkout process
							faster, store multiple shipping addresses, view and track your orders in your account and
							more.</p>
						<a class="acount-btn" href="account.php">Create an Account</a>
					</div>
					<div class="col-md-6 login-right">
						<h3>registered</h3>
						<p>If you have an account with us, please log in.</p>
						<form action="" method="post">
							<div>
								<span>Email Address/Mobile Number<label>*</label></span>
								<input type="text" name="email" required placeholder="Enter mobile number or email">
							</div>
							<div>
								<span>Password<label>*</label></span>
								<input type="password" name="password" required>
							</div>
							<a class="forgot" href="#">Forgot Your Password?</a>
							<input type="submit" value="Login" name="login">
						</form>
						<?php 
							if($msg!='')
							{?>
						<div class="success">
							<strong><?php echo $msg;?></strong>
						</div>
						<?php
							}
							if($err!='')
							{?>
						<div class="failure">
							<strong><?php echo $err;?></strong>
						</div>
						<?php
						}?>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- login -->
<?php
require_once 'footer.php';
?>