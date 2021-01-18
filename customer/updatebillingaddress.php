<?php 
require_once '../classes/dbcon.php';
require_once '../classes/userbillingaddress.php';
require_once '../classes/State.php';
$state=new State();
$add=new UserBillingAddress();
$conn = new Dbcon();
$res1=$add->fetchbillingaddress($_SESSION['userid'],$conn->conn());
if(isset($_POST['update']) && $_POST['update']=='update')
{
    echo "inside";
    $hno = isset($_POST['hno']) ? ($_POST['hno']) : "";
    $city = isset($_POST['city']) ? ($_POST['city']) : "";
    $state = isset($_POST['state']) ? ($_POST['state']) : "";
    $pincode = isset($_POST['pincode']) ? ($_POST['pincode']) : "";
    $country = isset($_POST['country']) ? ($_POST['country']) : "";
    $res=$add->updatebillingaddress($_SESSION['userid'],$_SESSION['username'],$hno,$city,$state,$country,$pincode,$conn->conn());
    echo $res;
}
?>
<?php
require_once 'header.php';

?>

<div class="p-4 bg-secondary">
<?php 
if($res1!=0)
{?>
    <form action="" method="post">
    <h1>Billing Address</h1><br>
        <div class="form-group">
            <label for="hno">House Number:</label>
            <input type="text" class="form-control" id="hno" name="hno" value="<?php echo $res1['house_no'];?>">
            <p id="hnomsg"></p>
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo $res1['city'];?>">
            <p id="citymsg"></p>
        </div>
        <div class="form-group">
            <label for="state">State:</label>
                <select class="form-control" name="state" id="state">
                    <option value="" selected disabled>Please Select State</option>
                    
                    <?php
                    $st=$state->getallstate($conn->conn());
                    if($st!=0)
                    {                      
                    foreach($st as $key)
                    {
                    ?>
                    <option value="<?php echo $key['id'];?>" <?php if ($res1['state']==$key['id']) {
                        echo 'selected';
                    } ?> ><?php echo $key['name'];?></option>
                    <?php
                    }?>
                    <?php
                    }?>
                </select>
                <p id="statemsg"></p>
        </div>
        <div class="form-group">
            <label for="pincode">Pin code:</label>
            <input type="number" class="form-control" id="pincode" name="pincode" value="<?php echo $res1['pincode'];?>">
            <p id="pincodemsg"></p>
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" id="country" name="country" value="<?php echo $res1['country'];?>">
            <p id="countrymsg"></p>
        </div>
        <div class="form-group">
            <input class="btn btn-primary btn-lg" type="submit" value="update" name="update">
        </div>

</form>
<?php
}
else
echo "<h1>Your address is not Saved";
?>
</div>






<?php
require_once 'footer.php';
?>