<?php 
if(isset($_POST['update']))
{
	 
}

?>
<?php
require_once 'header.php';
?>
<!-- <div class="p-4 bg-secondary">
	 <label for="authen">Enter Password</label> -->
    <!--<input type="password" id="authen" name="authen" class="form-control form-control-alternative" placeholder="Enter Password">
</div>
 -->
<div class="p-4 bg-secondary updateform">
<form>
  <div class="form-group">
    <label for="name">User Name</label>
    <input type="text" class="form-control" id="name" placeholder="Enter user name">
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="mobile">Phone Number</label>
    <input type="text" class="form-control" id="mobile" placeholder="Enter number">
  </div>
  <div class="form-group">
	<input type="submit" class="text-center btn btn-primary btn-lg" id="create" name="update" value="submit">  
</div> 
</form>
</div>



<script src="index.js"></script>
<?php

require_once 'footer.php';
?>