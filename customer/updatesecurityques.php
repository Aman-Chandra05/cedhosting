<?php
require_once '../classes/dbcon.php';
require_once '../classes/user.php';
$user=new User();
$conn = new Dbcon();
$checkpasswordderr='';
$err='';
$succ='';
$status='';
$res1=$user->fetchuser($_SESSION['userid'],$conn->conn());

if(isset($_POST['update']) && $_POST['update']=='update')
{
	$checkpassword = isset($_POST['checkpassword']) ? ($_POST['checkpassword']) : "";
	$ques = isset($_POST['question']) ? ($_POST['question']) : "";
	$ans = isset($_POST['answer']) ? ($_POST['answer']) : "";
	$res=$user->updatesecques($_SESSION['userid'],$checkpassword,$ques,$ans,$conn->conn());
	if(count($res)!=0)
	{
		$err="Updation Failed";
		foreach ($res as $key => $value) 
		{
		  if($key=='password')
        	$checkpasswordderr=$value;
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
  <form  action="#" method="post" onsubmit="return validateques();">
    <div class="form-group">
      <label for="checkpassword">Enter Your Password First</label>
      <input type="password" name="checkpassword" class="form-control" id="checkpassword" placeholder="Current Password" required>
      <span id="checkpassworderr"><?php echo $checkpasswordderr;?></span>
    </div>

	<div  class="form-group">
		<span>Enter Security Question<label>*</label></span>
		<select class="form-control" name="question" class="question" required>
			<option selected disabled>Choose Security Question</option>
			<option value="What was your childhood nickname?" <?php if($res1['security_question']=="What was your childhood nickname?"){echo 'selected';}?>>What was your childhood nickname?</option>
			<option value="What is the name of your favourite childhood friend?" <?php if($res1['security_question']=="What is the name of your favourite childhood friend?"){echo 'selected';}?>>What is the name of your favourite childhood friend?</option>
			<option value="What was your favourite place to visit as a child?" <?php if($res1['security_question']=="What was your favourite place to visit as a child?"){echo 'selected';}?>>What was your favourite place to visit as a child?</option>
			<option value="What was your dream job as a child?" <?php if($res1['security_question']=="What was your dream job as a child?"){echo 'selected';}?>>What was your dream job as a child?</option>
			<option value="What is your favourite teacher's nickname?" <?php if($res1['security_question']=="What is your favourite teacher's nickname?"){echo 'selected';}?>>What is your favourite teacher's nickname?</option>
		</select>
	</div>
	<div class="form-group">
		<span>Security Answer<label>*</label></span>
		<input type="text" class="form-control" id="answer" name="answer" required value="<?php echo htmlentities($res1['security_answer']);?>">
		<span id="answererror"></span>
	</div >



    <div  class="form-group">
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
