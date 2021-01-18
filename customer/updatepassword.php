<?php
require_once '../classes/dbcon.php';
require_once '../classes/user.php';
$user=new User();
$conn = new Dbcon();
$conpassworderr='';
$passworderr='';
$checkpasswordderr='';
$err='';
$succ='';

if(isset($_POST['update']) && $_POST['update']=='update')
{
	$checkpassword = isset($_POST['checkpassword']) ? ($_POST['checkpassword']) : "";
	$password = isset($_POST['password']) ? ($_POST['password']) : "";
	$conpassword = isset($_POST['conpassword']) ? ($_POST['conpassword']) : "";
	$res=$user->updatepassword($_SESSION['userid'],$checkpassword,$password,$conpassword,$conn->conn());
	if(count($res)!=0)
	{
		$err="Updation Failed";
		foreach ($res as $key => $value) 
		{
			if($key=='password')
				$checkpasswordderr=$value;
			if($key=='conpassword')
				$conpassworderr=$value;
		}
	}
	else 
	  $succ="Password Updated";
}


?>
<?php
require_once 'header.php';
?>

<div class="p-4 bg-secondary">
  <form  action="#" method="post" onsubmit="return validatepassword();">
    <div class="form-group">
      <label for="checkpassword">Enter Your Password First</label>
      <input type="password" name="checkpassword" class="form-control" id="checkpassword" placeholder="Current Password" required>
      <span id="checkpassworderr"><?php echo $checkpasswordderr;?></span>
    </div>

    <div class="form-group">
      <span>Enter New Password<label>*</label></span>
      <input type="password" class="form-control" id="password" name="password"required>
      <span id="passworderr"><?php echo $passworderr;?></span>
    </div>

    <div class="form-group">
      <span>Confirm Password<label>*</label></span>
      <input type="password" class="form-control" id="conpassword" name="conpassword" required>
      <span id="conpassworderr"><?php echo $conpassworderr;?></span>
    </div>

    <div class="form-group">
      <input class="btn btn-primary btn-lg" type="submit" value="update" name="update">
    </div>
  </form>
  <?php 
    if($err!='')
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
</div>
<?php
require_once 'footer.php';
?>

<script>

</script>