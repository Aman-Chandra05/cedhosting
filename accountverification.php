<?php
require_once 'classes/dbcon.php';
require_once 'classes/user.php';
$user=new User();
$conn = new Dbcon();
$mail='';
$mailerr='';
$mobile='';
$mobileerr='';
if(isset($_POST['submit']))
{
    if(isset($_SESSION['mailotp']))
    {
        $res=0;
        if($_SESSION['mailotp']==$_POST['otp'])
            $res=$user->emailverify($conn->conn(),$_GET['email']);
        if($res==0)
            $mailerr="OTP does not match.";
        else
        {
            $mail="OTP matched";
            unset($_SESSION['mailotp']);
        } 
    }
    if(isset($_SESSION['mobileotp']))
    {
        $res=0;
        if($_SESSION['mobileotp']==$_POST['otp'])
            $res=$user->mobileverify($conn->conn(),$_GET['mobile']);
        if($res==0)
            $mobileerr="OTP does not match.";
        else
        {
            $mobile="OTP matched";
            unset($_SESSION['mobileotp']);
        }         
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ced Hosting</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Planet Hosting Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!---fonts-->
    <link href='//fonts.googleapis.com/css?family=Voltaire' rel='stylesheet' type='text/css'>
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <!---fonts-->
    <!--script-->
    <script src="js/modernizr.custom.97074.js"></script>
    <script src="js/jquery.chocolat.js"></script>
    <link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
    <!--lightboxfiles-->
    <script type="text/javascript" src="js/jquery.hoverdir.js"></script>
    <link rel="stylesheet" href="css/swipebox.css">
    <link rel="stylesheet" href="css/mycss.css">
    <script src="js/jquery.swipebox.min.js"></script>
    <script src="js/myjs.js"></script>
    <!--script-->
</head>

<body>
    <div class="container p-4 bg-secondary">
        <h1 class="text-center mb-5">Account Verification</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="otp">Enter OTP send to your email or phone no:</label>
                <input type="number" name="otp" class="form-control" id="otp" placeholder="Enter OTP">
                <?php 
                    if($mail!='')
                        echo "<p class='text-success font-weight-bold'>".$mail."</p>"; 
                    if($mailerr!='')
                        echo "<p class='text-danger font-weight-bold'>".$mailerr."</p>";
                ?>
            </div>
            <!--<div class="form-group">
                <label for="mobileotp">Enter OTP send to your Mobile no:</label>
                <input type="number" name="mobileotp" class="form-control" id="mobileotp" placeholder="Enter OTP">
                <?php 
                    /*if($mobile!='')
                        echo "<p class='text-success font-weight-bold'>".$mobile."</p>"; 
                    if($mobileerr!='')
                        echo "<p class='text-danger font-weight-bold'>".$mobileerr."</p>";*/
                ?>
            </div>-->
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
    <?php 
        if($mail!='' || $mobile!='')
        {?>
    <div class="success">
        <strong><?php echo "Verification Successfull";?></strong>
        <p><strong><a href="login.php">Click Here</a></strong> to login to your account.</p>
    </div>
    <?php
        }
        if($mailerr!='' && $mobileerr!='')
        {?>
    <p class="failure">
        <strong><?php echo "Verification Failed";?></strong>
    </p>
    <?php
        }?>
</body>

</html>