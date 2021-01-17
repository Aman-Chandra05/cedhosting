<?php 
require_once '../classes/dbcon.php';
require_once '../classes/userbillingaddress.php';
require_once '../classes/State.php';
$state=new State();
$add=new UserBillingAddress();
$conn = new Dbcon();
?>
<?php
require_once 'header.php';

?>

<div class="p-4 bg-secondary">
<form>
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
                <select class="form-control" name="state" id="state">
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
            <input class="btn btn-primary btn-lg" type="submit" value="update" name="update">
        </div>

</form>

</div>






<?php
require_once 'footer.php';
?>