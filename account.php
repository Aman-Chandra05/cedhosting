<?php
require_once 'classes/dbcon.php';
require_once 'classes/user.php';
$user=new User();
$conn = new Dbcon();
$emailerr='';
$mobileerr='';
$conpassworderr='';
$canverify=0;
$err='';
if(isset($_POST['register']) && $_POST['register']=='submit')
{
	$name = isset($_POST['name']) ? ($_POST['name']) : "";
	$email = isset($_POST['email']) ? ($_POST['email']) : "";
	$mobile = isset($_POST['mobile']) ? ($_POST['mobile']) : "";
	$password = isset($_POST['password']) ? ($_POST['password']) : "";
	$conpassword = isset($_POST['conpassword']) ? ($_POST['conpassword']) : "";
	$question = isset($_POST['question']) ? ($_POST['question']) : "";
	$answer = isset($_POST['answer']) ? ($_POST['answer']) : "";
	$res=$user->register($name,$email,$password,$conpassword,$mobile,$question,$answer,$conn->conn());
	if(count($res)!=0)
	{
		$err="Registration Failed";
		foreach ($res as $key => $value) 
		{
			if($key=='email')
				$emailerr=$value;
			if($key=='mobile')
				$mobileerr=$value;
			if($key=='password')
				$conpassworderr=$value;
		}
	}
	else
	{
		$mailotp=rand(100000,999999);
		$_SESSION['mailotp']=$mailotp;
		require 'phpmailer/PHPMailerAutoload.php';   
		$mail = new PHPMailer(true);
		try { 
			//$mail->SMTPDebug = 2;                                        
			$mail->isSMTP();                                             
			$mail->Host       = 'smtp.gmail.com;';                     
			$mail->SMTPAuth   = true;                              
			$mail->Username   = 'amanchandra081@gmail.com';                  
			$mail->Password   = 'amantheboss';                         
			$mail->SMTPSecure = 'tls';                               
			$mail->Port       = 587;   
		  
			$mail->setFrom('amanchandra081@gmail.com', 'Aman');            
			$mail->addAddress($email); 
			   
			$mail->isHTML(true);                                   
			$mail->Subject = 'Email Verification'; 
			$mail->Body    = 'Your OTP for verification is <b>'.$mailotp.'</b>'; 
			$mail->AltBody = 'Your OTP for verification is '.$mailotp; 
			$mail->send(); 
			$canverify=1; 
		} catch (Exception $e) { 
			echo "Verification mail could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
		}
		if($canverify==1)
		{
			header('location:accountverification.php?mobile='.$mobile.'&email='.$email);
		}	
		else {
			$err="Sorry your account could not be verified";
		} 
	}	
}
?>
<?php
require_once 'header.php';
?>
<!---login--->
<div class="content">
	<!-- registration -->
	<div class="main-1">
		<div class="container">
			<div class="register">
				<form action="#" method="post" onsubmit="return validatereg();">
					<div class="register-top-grid" style="overflow:hidden;">
						<h3>personal information</h3>
						<div>
							<span>Name<label>*</label></span>
							<input type="text" id="name" name="name" required value="<?php if(isset($_POST['name'])){echo htmlentities($_POST['name']);}?>">
							<span id="nameerror"></span>
						</div>

						<div>
							<span>Email Address<label>*</label></span>
							<input type="text" id="email" name="email"required value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email']);}?>">
							<span id="emailerror"><?php echo $emailerr;?></span>
						</div>
						<div class="cl">
							<span>Password<label>*</label></span>
							<input type="password" id="password" name="password" required value="<?php if(isset($_POST['password'])){echo htmlentities($_POST['password']);}?>">
							<span id="passworderror"></span>
						</div>
						<div>
							<span>Confirm Password<label>*</label></span>
							<input type="password" id="conpassword" name="conpassword" required value="<?php if(isset($_POST['conpassword'])){echo htmlentities($_POST['conpassword']);}?>">
							<span id="conpassworderror"><?php echo $conpassworderr;?></span>
						</div>
						<div class="cl">
							<span>Mobile NUmber<label>*</label></span>
							<input type="number" id="mobile" name="mobile" required value="<?php if(isset($_POST['mobile'])){echo htmlentities($_POST['mobile']);}?>">
							<span id="mobileerror"><?php echo $mobileerr;?></span>
						</div>
						<div>
							<span>Enter Security Question<label>*</label></span>
							<select name="question" class="question" required>
								<option selected disabled>Choose Security Question</option>
								<option value="What was your childhood nickname?" <?php if(isset($_POST['question']) && $_POST['question']=="What was your childhood nickname?"){echo 'selected';}?>>What was your childhood nickname?</option>
								<option value="What is the name of your favourite childhood friend?" <?php if(isset($_POST['question']) && $_POST['question']=="What is the name of your favourite childhood friend?"){echo 'selected';}?>>What is the name of your favourite childhood friend?</option>
								<option value="What was your favourite place to visit as a child?" <?php if(isset($_POST['question']) && $_POST['question']=="What was your favourite place to visit as a child?"){echo 'selected';}?>>What was your favourite place to visit as a child?</option>
								<option value="What was your dream job as a child?" <?php if(isset($_POST['question']) && $_POST['question']=="What was your dream job as a child?"){echo 'selected';}?>>What was your dream job as a child?</option>
								<option value="What is your favourite teacher's nickname?" <?php if(isset($_POST['question']) && $_POST['question']=="What is your favourite teacher's nickname?"){echo 'selected';}?>>What is your favourite teacher's nickname?</option>
							</select>
						</div>
						<div class="cl">
							<span>Security Answer<label>*</label></span>
							<input type="text" id="answer" name="answer" required value="<?php if(isset($_POST['answer'])){echo htmlentities($_POST['answer']);}?>">
							<span id="answererror"></span>
						</div>
						<div class="register-but" style="clear:both;">
							<input type="submit" value="submit" name="register">
						</div>
					</div>
				</form>
				<?php 
				if($err!='')
				{?>
				<p class="failure">
					<strong><?php echo $err;?></strong>
				</p>
				<?php
				}?>
			</div>
		</div>
	</div>
	<!-- registration -->
</div>
<!-- login -->
<?php
require_once 'footer.php';
?>