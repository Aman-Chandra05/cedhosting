<?php 
require_once '../classes/dbcon.php';
require_once '../classes/user.php';
$user=new User();
$conn = new Dbcon();
$err='';
$succ='';
$status='';
$emailerr='';
$mobileerr='';
$passworderr='';
$res1=$user->fetchuser($_SESSION['userid'],$conn->conn());
if(isset($_POST['update']) && $_POST['update']=='update')
{
	$name = isset($_POST['name']) ? ($_POST['name']) : "";
	$email = isset($_POST['email']) ? ($_POST['email']) : "";
	$mobile = isset($_POST['mobile']) ? ($_POST['mobile']) : "";
	$password = isset($_POST['checkpassword']) ? ($_POST['checkpassword']) : "";
	$res=$user->updatepersonalinfo($_SESSION['userid'],$name,$mobile,$email,$password,$conn->conn());
	if(count($res)!=0)
	{
		$err="Updation Failed";
		foreach ($res as $key => $value) 
		{
			if($key=='email')
				$emailerr=$value;
			if($key=='mobile')
				$mobileerr=$value;
			if($key=='password')
        $passworderr=$value;
      if($key=='status')
        $status=$value;
		}
  }
  else 
  $succ="Info Updated";
}


require_once 'header.php';
?>
<div class="p-4 bg-secondary">
  <form  action="#" method="post" onsubmit="return validatereg();">
    <div class="form-group">
      <label for="checkpassword">Enter Your Password First</label>
      <input type="password" name="checkpassword" class="form-control" id="checkpassword" placeholder="Current Password" required>
      <span id="passworderror"><?php echo $passworderr;?></span>
    </div>

    <div class="form-group">
      <span>Email Address<label>*</label></span>
      <input type="text" class="form-control" id="email" name="email"required value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email']);} else echo htmlentities($res1['email']);?>">
      <span id="emailerror"><?php echo $emailerr;?></span>
    </div>

    <div class="form-group">
      <span>Name<label>*</label></span>
      <input type="text" class="form-control" id="name" name="name" required value="<?php if(isset($_POST['name'])){echo htmlentities($_POST['name']);} else echo htmlentities($res1['name']);?>">
      <span id="nameerror"></span>
    </div>

    <div class="form-group">
      <span>Mobile Number<label>*</label></span>
      <input class="form-control" type="number" id="mobile" name="mobile" required value="<?php if(isset($_POST['mobile'])){echo htmlentities($_POST['mobile']);} else echo htmlentities($res1['mobile']);?>">
      <span id="mobileerror"><?php echo $mobileerr;?></span>
    </div>

    <div class="form-group">
      <input class="btn btn-primary btn-lg" type="submit" value="update" name="update">
    </div>
  </form>
  <?php 
    if($err!='' && $status=='')
    {?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Failure!</strong> <?php echo $err;?></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    }
  ?>
  <?php 
  if($succ!='')
  {?>
  <div class="alert alert-success  alert-dismissible fade show" role="alert">
      <span class="alert-icon"><i class="ni ni-like-2"></i></span>
      <span class="alert-text"><strong>Success!</strong> <?php echo $succ;?></span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <?php
  }
?>
  <?php 
  if($status!='')
  {?>
  <div class="alert alert-success  alert-dismissible fade show" role="alert">
      <span class="alert-icon"><i class="ni ni-like-2"></i></span>
      <span class="alert-text"><strong>Success!</strong> <?php echo $status;?></span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <?php
  }
?>
</div>





<?php
require_once 'footer.php';
?>
