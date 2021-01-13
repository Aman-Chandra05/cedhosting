<?php
require_once '../classes/dbcon.php';
require_once '../classes/product.php';
$product=new Product();
$conn = new Dbcon();
$successmsg='';
$errmsg='';
if(isset($_POST['create']) && $_POST['create']=="CREATE CATEGORY")
{
    $category = isset($_POST['category']) ? ($_POST['category']) : "";
    $res=$product->create_category($category,$conn->conn());
    if($res==1)
        $successmsg="New Category added !!!";
    elseif($res==-1)
        $errmsg="Category already exists.";
    else
        $errmsg="Can not create new category";
}
if(isset($_GET['action']) && isset($_GET['id']))
{
    if($_GET['action']=='delete')
    {
        $product->deletecategory($_GET['id'],$conn->conn());
    }
}
?>
<?php
require_once 'header.php';
?>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <h1 class="text-white mt-2">Add New Category</h1>
            <form class="pt-5" method="post" action="" onsubmit="return validatecategory()">
                <div class="form-group">
                    <label for="category">Product Category</label>
                    <input type="text" class="form-control" id="category" name="category" required placeholder="Enter Category Name">
                    <small class="require" id="categorymsg"></small>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg" id="create" name="create" value="CREATE CATEGORY">
                </div>
            </form>
            <?php
            if($successmsg!='')
            {?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Success!</strong> <?php echo $successmsg;?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            }
            if($errmsg!='')
            {?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Failure!</strong> <?php echo $errmsg;?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            }?>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card  p-3">
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush" id="subcategory_table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Category Id</th>
                                <th scope="col">Parent Id</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Availability</th>
                                <th scope="col">Date Launched</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $res=$product->getallcategories($conn->conn());
                        if($res!=0)
                        {?>
                        <tbody>
                        <?php
                        foreach($res as $key)
                        {
                        ?>
                        <tr>
                        <td><?php echo $key['id'];?></td>
                        <td><?php echo $key['prod_parent_id'];?></td>
                        <td><?php echo $key['prod_name'];?></td>
                        <td><?php if($key['prod_available']==1) echo 'Yes'; else echo 'No';?></td>
                        <td><?php echo $key['prod_launch_date'];?></td>
                        <td><a href="#" data-id="<?php echo $key['id'];?>" data-value="<?php echo $key['prod_name'];?>" data-toggle="modal" data-target="#updateform" class="btn btn-primary btn-sm editcategory">Edit</a>
                            <a href="?action=delete&id=<?php echo $key['id'];?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                        </tr>
                        <?php
                        }?>
                        </tbody>
                        <?php
                        }?>
                    </table>
                </div>              
                <div class="modal fade" id="updateform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Update Category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <input type="hidden" id="categoryid" class="form-control validate">
                                <div class="md-form mb-0">
                                    <i class="fas fa-edit prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="defaultForm-email">New Name</label>
                                    <input type="text" id="categoryname" required class="form-control validate">
                                </div>

                                <!--<div class="md-form mb-4">
                                    <i class="fas fa-lock prefix grey-text"></i>
                                    <input type="password" id="defaultForm-pass" class="form-control validate">
                                    <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
                                </div>-->
                            </div>
                            <div class="modal-footer d-flex justify-content-center pt-0">
                                <input type="submit" class="btn btn-default" value="Update" id="updatecat" name="updatecat">
                            </div>
                            <div class="modal-footer d-flex justify-content-center pt-0" id="updatecatmsg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'footer.php';
?>