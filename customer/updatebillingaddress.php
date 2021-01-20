<?php 
require_once '../classes/dbcon.php';
require_once '../classes/product.php';
require_once '../classes/user.php';
require_once '../classes/userbillingaddress.php';
require_once '../classes/State.php';
require_once '../classes/companyinfo.php';

$add=new UserBillingAddress();
$conn = new Dbcon();
$res0=array();
if(isset($_POST['update']) && $_POST['update']=='update')
{

    if(isset($_POST['hno']) && isset($_POST['pincode']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['country']) && isset($_POST['addid']))
    {
        $hno = isset($_POST['hno']) ? ($_POST['hno']) : "";
        $city = isset($_POST['city']) ? ($_POST['city']) : "";
        $state = isset($_POST['state']) ? ($_POST['state']) : "";
        $pincode = isset($_POST['pincode']) ? ($_POST['pincode']) : "";
        $country = isset($_POST['country']) ? ($_POST['country']) : "";
        $addressid = isset($_POST['addid']) ? ($_POST['addid']) : "";
        $res0=$add->updatebillingaddress($_SESSION['userid'],$_SESSION['username'],$hno,$city,$state,$country,$pincode,$conn->conn(),$addressid);
    }
}
$fetchaddress=$add->fetchbillingaddress($_SESSION['userid'],$conn->conn());
?>
<?php
require_once 'header.php';

?>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Update</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>View Addresses</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <?php 
                                if($fetchaddress!=0)
                                {?>
                                    <div class="form-group">
                                    <h2>Choose Address</h2>
                                    <?php
                                        for($i=0;$i<count($fetchaddress);$i++)
                                        {?>
                                            <input class="form-check-input address" name="address" type="radio" id="<?php echo $fetchaddress[$i]['id'];?>" name="address" value="<?php echo $fetchaddress[$i]['id'];?>">
                                            <label class="form-check-label" for="<?php echo $fetchaddress[$i]['id'];?>"> Address <?php echo $i+1;?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php
                                        }                   
                                    echo '</div>';
                                        ?>
                                    <form method="post" action="">
                                        <h2>Billing Address</h2>
                                            <input type="text" class="form-control bill" id="addid" name="addid" readonly>
                                        <div class="form-group">
                                            <label for="hno">House Number:</label>
                                            <input type="text" class="form-control bill" id="hno" name="hno" placeholder="">
                                            <p id="hnomsg"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City:</label>
                                            <input type="text" class="form-control bill" id="city" name="city" placeholder="">
                                            <p id="citymsg"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="state">State:</label>
                                                <select class="form-control bill" name="state" id="state">
                                                    <option value="" selected disabled>Please Select State</option>
                                                    
                                                    <?php
                                                    $state=new State();
                                                    $res=$state->getallstate($conn->conn());
                                                    if($res!=0)
                                                    {  echo "<script>console.log('check');</script>";                    
                                                    foreach($res as $key)
                                                    {
                                                    ?>
                                                    <option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
                                                    <?php
                                                    }
                                                    }
                                                    else echo '<option value="1">1</option>' ?>
                                                </select>
                                                <p id="statemsg"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="pincode">Pin code:</label>
                                            <input type="number" class="form-control bill" id="pincode" name="pincode" placeholder="">
                                            <p id="pincodemsg"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="country">Country:</label>
                                            <input type="text" class="form-control bill" id="country" name="country" placeholder="">
                                            <p id="countrymsg"></p>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-primary btn-lg" type="submit" value="update" name="update">
                                        </div>
                                    </form>
                                    <?php
                                }
                                else echo "<h1>Your address is not Saved";
                                if($res0==1)
                                {?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Success!</strong> Updation success!!!
                                    </div>
                                <?php
                                }
                                elseif($res0==0)
                                {?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Danger!</strong> Updation Failed
                                    </div>
                                <?php
                                }
                                elseif($res0==-1)
                                {?>
                                    <div class="alert alert-warning" role="alert">
                                        <strong>Warning!</strong> Nothing Updated!!!
                                    </div>
                                <?php
                                }
                                ?>

                            </div>



                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                <p class="description">Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require_once 'footer.php';
?>

