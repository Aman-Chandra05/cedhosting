<?php
require_once 'header.php';
if(isset($_GET['id']))
{
$res=$product->fetchcategory($_GET['id'],$conn->conn());
if($res!=0)
{
?>
<!---singleblog--->
<div class="content">
    <div class="linux-section">
        <div class="container">
            <div class="linux-grids">
                <div class="col-md-8 linux-grid">
                    <h2><?php echo $res['prod_name'];?></h2>
                    <?php echo $res['html'];?><br>
                    <a href="#home">view plans</a>
                </div>
                <div class="col-md-4 linux-grid1">
                    <img src="images/linux.png" class="img-responsive" alt="" />
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <?php 
    $res2=$product->fetchallproducts($_GET['id'],$conn->conn());
    if($res2!=0)
    {?>
    <div class="tab-prices">
        <div class="container">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs left-tab" role="tablist">
                    <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab"
                            aria-controls="home" aria-expanded="true">IN Hosting</a></li>
                    <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab"
                            aria-controls="profile">US Hosting</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                        <div class="linux-prices">
                            <?php 
                            foreach($res2 as $key)
                            {
                                $desc=json_decode($key['description'], true);
                            ?>
                            <div class="col-md-3 linux-price">
                                <div class="linux-top">
                                    <h4><?php echo $key['prod_name'];?></h4>
                                </div>
                                <div class="linux-bottom">
                                    <h5>&#36;<?php echo $key['mon_price'];?> <span class="month">per month</span></h5>
                                    <h5>&#36;<?php echo $key['annual_price'];?> <span class="month">per annum</span></h5>
                                    <h6><?php echo $desc['free_domain']?> Domain</h6>
                                    <ul>
                                        <li><strong><?php echo $desc['webspace'].' GB';?></strong>  Web Space</li>
                                        <li><strong><?php echo $desc['bandwidth'].' GB';?></strong> Bandwidth</li>
                                        <li><strong><?php echo $desc['language'];?> </strong> Language and Technology Support</li>
                                        <li><strong><?php echo $desc['mailbox'];?></strong> Mailbox</li>
                                        <li><strong>location</strong> : <img src="images/india.png"></li>
                                    </ul>
                                    <?php echo $_GET['id'];?>
                                </div>
                                <a href="" class="addcart" data-id="<?php echo $_GET['id'];?>" data-prodid="<?php echo $key['prod_id'];?>" data-toggle="modal" data-target="#exampleModal">Add to Cart</a>
                            </div>
                            <?php
                            }?>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <?php 
    }?>
</div>
<!-- Modal -->
<!-- Modal -->
<!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Plan</label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option value="mon">Monthly</option>
              <option value="annual">Annual</option>
            </select>
        </div>
      <div class="cartmsg">
        ...
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Cart </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <!-- <label data-error="wrong" data-success="right" for="defaultForm-email">ID</label> -->
                <input type="hidden" id="idp" class="form-control validate">
                <div class="md-form mb-0">
                    <!--<label data-error="wrong" data-success="right" for="defaultForm-email">prod id</label>-->
                    <input type="hidden" id="prodid" required class="form-control validate">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Plan</label>
                    <select class="form-control" id="plan">
                      <option value="Monthly">Monthly</option>
                      <option value="Annual">Annual</option>
                    </select>
                </div>
                      <div class="cartmsg">
                      </div>
            </div>
            <div class="modal-footer d-flex justify-content-center pt-0">
                <input type="submit" class="btn btn-primary" value="Add to cart" id="addtocart" name="addtocart">
            </div>
            <div class="modal-footer d-flex justify-content-center pt-0" id="updatecatmsg"></div>
        </div>
    </div>
</div>
<?php
}
}
require_once 'footer.php';
?>