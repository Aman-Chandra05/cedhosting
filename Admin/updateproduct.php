<?php
require_once '../classes/dbcon.php';
require_once '../classes/product.php';
$product=new Product();
$conn = new Dbcon();
$failure='';
$success='';
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $res1=$product->fetchproduct($id,$conn->conn());
}
if(isset($_POST['create']) && $_POST['create']=='UPDATE')
{
    $productcat = $_POST['productcat'];
    $productname = $_POST['productname'];
    $pageurl = $_POST['pageurl'];
    $mp = $_POST['mp'];
    $ap = $_POST['ap'];
    $sku = $_POST['sku'];
    $ws = $_POST['ws'];
    $bandwidth = $_POST['bandwidth'];
    $freed = $_POST['freed'];
    $lang = $_POST['lang'];
    $mailbox = $_POST['mailbox'];
    $descarray=array(
        "webspace"=>$ws,"bandwidth"=>$bandwidth,"free_domain"=>$freed,"language"=>$lang,"mailbox"=>$mailbox
    );
    $desc = json_encode($descarray);
    $res=$product->updateproduct($id,$productcat,$productname,$pageurl,$mp,$ap,$sku,$desc,$conn->conn());
    if($res==-1)
        $failure="Product already exists";
    elseif($res==1)
    {
        $success="Product updated successfully";
    }
    elseif($res==0)
        $failure="Some error occured";
}
$res=$product->fetchproduct($id,$conn->conn())
?>
<?php
require_once 'header.php';
?>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <h1 class="text-white mt-2">Update Product</h1>
            <?php
            if($success!='')
            {?>
            <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Success!</strong> <?php echo $success;?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            }
            if($failure!='')
            {?>
            <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Failure!</strong> <?php echo $failure;?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            }?>
            <form class="pt-5" method="post">
                <h2>Enter Product Details</h2>
                <hr>
                <div class="form-group">
                    <label for="productcat">Select Product Category <span class="require">*</span></label>
                    <select class="form-control col-lg-4" name="productcat" id="productcat" onblur="validateproductcat()" required>
                    <option value="" selected disabled>Please Select</option>
                    <?php
                    $res=$product->getallcategories($conn->conn());
                    if($res!=0)
                    {                      
                    foreach($res as $key)
                    {
                    ?>
                    <option value="<?php echo $key['id'];?>" <?php if($key['id']==$res1[0]['prod_parent_id'])echo "selected";?>><?php echo $key['prod_name'];?></option>
                    <?php
                    }?>
                    <?php
                    }?>
                    </select>
                    <small class="require" id="productcatmsg"></small>
                </div>
                <div class="form-group">
                    <label for="productname">Enter Product Name <span class="require">*</span></label>
                    <input type="text" value="<?php echo $res1[0]['prod_name']; ?>" class="form-control col-lg-4" id="productname" name="productname" onblur="validateproductname()" required>
                    <small class="require" id="productnamemsg"></small>
                </div>
                <div class="form-group">
                    <label for="pageurl">Enter Page URL</label>
                    <input type="text" class="form-control col-lg-4" id="pageurl" name="pageurl" value="<?php echo $res1[0]['html'];?>">
                    <small class="require" id="pageurlmsg"></small>
                </div>
                <hr>
                <h2>Enter Product Description Below</h2>
                <hr>
                <div class="form-group">
                    <label for="mp">Enter Monthly Price <span class="require">*</span></label>
                    <input type="number" class="form-control col-lg-4" id="mp" name="mp" placeholder="ex: 23" step="any" onblur="validateprice(this,mpmsg)" required value="<?php echo $res1[0]['mon_price'];?>">
                    <span style="font-size:12px;">This would be Monthly Plan</span><br>
                    <small class="require" id="mpmsg"></small>
                </div>
                <div class="form-group">
                    <label for="ap">Enter Annual Price <span class="require">*</span></label>
                    <input type="number" class="form-control col-lg-4" id="ap" name="ap" placeholder="ex: 23" step="any" onblur="validateprice(this,apmsg)" required value="<?php echo $res1[0]['annual_price'];?>">
                    <span style="font-size:12px;">This would be Annual Price</span><br>
                    <small class="require" id="apmsg"></small>
                </div>
                <div class="form-group">
                    <label for="sku">SKU <span class="require">*</span></label>
                    <input type="text" class="form-control col-lg-4" id="sku" name="sku" onblur="validatesku()" required value="<?php echo $res1[0]['sku'];?>">
                    <small class="require" id="skumsg"></small>
                </div>
                <hr>
                <h2>Features</h2>
                <hr>
                <?php $desc=json_decode($res1[0]['description'], true); ?>
                <div class="form-group">
                    <label for="ws">Web Space(in GB) <span class="require">*</span></label>
                    <input type="number" class="form-control col-lg-4" id="ws" name="ws" onblur="validategb(this,wsmsg)" step="0.1" required value="<?php echo($desc['webspace']);?>">
                    <span style="font-size:12px;">Enter 0.5 for 512 MB</span><br>
                    <small class="require" id="wsmsg"></small>
                </div>
                <div class="form-group">
                    <label for="bandwidth">Bandwidth (in GB) <span class="require">*</span></label>
                    <input type="number" class="form-control col-lg-4" id="bandwidth" name="bandwidth" onblur="validategb(this,bandwidthmsg)" step="0.1" required value="<?php echo $desc['bandwidth'];?>">
                    <span style="font-size:12px;">Enter 0.5 for 512 MB</span><br>
                    <small class="require" id="bandwidthmsg"></small>
                </div>
                <div class="form-group">
                    <label for="freed">Free Domain <span class="require">*</span></label>
                    <input type="text" class="form-control col-lg-4" id="freed" name="freed" onblur="validatedomain(this,freedmsg)" required value="<?php echo $desc['free_domain'];?>">
                    <span style="font-size:12px;">Enter 0 if no domain available in this service</span><br>
                    <small class="require" id="freedmsg"></small>
                </div>
                <div class="form-group">
                    <label for="lang">Language / Technology Support <span class="require">*</span></label>
                    <input type="text" class="form-control col-lg-4" id="lang" name="lang" onblur="validatelang()" required value="<?php echo $desc['language'];?>">
                    <span style="font-size:12px;">Separate by (,) Ex: PHP, MySQL, MongoDB</span><br>
                    <small class="require" id="langmsg"></small>
                </div>
                <div class="form-group">
                    <label for="mailbox">Mailbox <span class="require">*</span></label>
                    <input type="text" class="form-control col-lg-4" id="mailbox" name="mailbox" onblur="validatedomain(this,mailboxmsg)" required value="<?php echo $desc['mailbox'];?>">
                    <span style="font-size:12px;">Enter Number of mailbox will be provided, enter 0 if none</span><br>
                    <small class="require" id="mailboxmsg"></small>
                </div>
                <hr>
                <div class="form-group text-center">
                    <input type="submit" class="text-center btn btn-primary btn-lg" id="create" name="create" value="UPDATE">
                </div>
            </form>
        </div>
    </div>
<?php
require_once 'footer.php';
?>