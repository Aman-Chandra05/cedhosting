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
if(isset($_GET['addressid']) && isset($_GET['userid']))
{
    $add->deleteaddress($_GET['addressid'],$_GET['userid'],$conn->conn());
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
                                        <a class="nav-link mb-sm-3 mb-md-0 
                                        <?php
                                        if(!isset($_GET['addressid']) && !isset($_GET['userid']) && !isset($_GET['action']))
                                            echo 'active';
                                        else echo '';
                                         ?>" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Update</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0
                                        <?php
                                        if(isset($_GET['addressid']) && isset($_GET['userid']) && isset($_GET['action']))
                                            echo 'active';
                                        else echo '';
                                         ?>
                                        " id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>View Addresses</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade
                                <?php
                                    if(!isset($_GET['addressid']) && !isset($_GET['userid']) && !isset($_GET['action']))
                                        echo 'show active';
                                    else echo '';
                                ?>" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                                <?php 
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
                                <?php 
                                if($fetchaddress!=0)
                                {?>
                                    <div class="form-group">
                                    <h2>Choose Address</h2>
                                    <?php
                                        for($i=0;$i<count($fetchaddress);$i++)
                                        {?>
                                            <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" id="<?php echo $fetchaddress[$i]['id'];?>" name="address" class="custom-control-input address" value="<?php echo $fetchaddress[$i]['id'];?>">
                                              <label class="custom-control-label" for="<?php echo $fetchaddress[$i]['id'];?>">Address <?php echo $i+1;?></label>
                                            </div>
                                        <?php
                                        }                   
                                    echo '</div>';
                                        ?>
                                    <form method="post" action="updatebillingaddress.php">
                                        <h2>Billing Address</h2>
                                            <input type="hidden" class="form-control bill" id="addid" name="addid" readonly>
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
                                ?>

                            </div>
                            <div class="tab-pane fade
                            <?php
                            if(isset($_GET['addressid']) && isset($_GET['userid']) && isset($_GET['action']))
                                echo 'show active';
                            else echo '';
                             ?>" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div class="table-responsive">
                                <div>
                                    <table class="table align-items-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">ID</th>
                                                <th scope="col" class="sort" data-sort="name">User ID</th>
                                                <th scope="col" class="sort" data-sort="name">H.No.</th>
                                                <th scope="col" class="sort" data-sort="budget">City</th>
                                                <th scope="col" class="sort" data-sort="status">State</th>
                                                <th scope="col">Country</th>
                                                <th scope="col" class="sort" data-sort="completion">Pincode</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        if($fetchaddress!=0)
                                        {?>
                                        <tbody class="list">

                                            <?php
                                            foreach ($fetchaddress as $key) {
                                                echo "<tr><td>".$key['id']."</td>";
                                                echo "<td>".$key['user_id']."</td>";
                                                echo "<td>".$key['house_no']."</td>";
                                                echo "<td>".$key['city']."</td>";
                                                echo "<td>".$key['state']."</td>";
                                                echo "<td>".$key['country']."</td>";
                                                echo "<td>".$key['pincode']."</td>";
                                                echo "<td><a href='updatebillingaddress.php?action=delete&addressid=".$key['id']."&userid=".$key['user_id']."' class='btn btn-danger btn-sm'>Delete</button></td></tr>";
                                            }
                                        }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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

