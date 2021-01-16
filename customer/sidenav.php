<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard

* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
require_once '../classes/dbcon.php';
if(isset($_SESSION['username']) && isset($_SESSION['userid']) && isset($_SESSION['admin']))
{
	if($_SESSION['admin']==1)
		header('location:../index.php');
}
else
header('location:../index.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>CedHosting</title>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
    <link rel="stylesheet" href="assets/css/mycss.css" type="text/css">
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    <h1><span id="ced">SHOP</span> <span id="hosting">NOW</span></h1>
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Orders</span>
                    </h6>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php?status=pending">
                                <i class="ni ni-planet text-orange"></i>
                                <span class="nav-link-text">Pending Orders </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php?status=Cancelled">
                                <i class="ni ni-pin-3 text-primary"></i>
                                <span class="nav-link-text">Cancelled Orders</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php?status=complete">
                                <i class="ni ni-single-02 text-yellow"></i>
                                <span class="nav-link-text">Completed Orders</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allorders.php">
                                <i class="ni ni-single-02 text-yellow"></i>
                                <span class="nav-link-text">All Orders</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Services</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html"
                                target="_blank">
                                <i class="ni ni-spaceship"></i>
                                <span class="nav-link-text">Active Services</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html"
                                target="_blank">
                                <i class="ni ni-palette"></i>
                                <span class="nav-link-text">Expired Services</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Offers/Promocode</span>
                    </h6>
                    <!-- Navigation -->
<!--                     <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html"
                                target="_blank">
                                <i class="ni ni-spaceship"></i>
                                <span class="nav-link-text">All User List</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html"
                                target="_blank">
                                <i class="ni ni-palette"></i>
                                <span class="nav-link-text">Create New User</span>
                            </a>
                        </li>
                    </ul>
                     Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Blog </span>
                    </h6>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="examples/icons.html">
                                <i class="ni ni-planet text-orange"></i>
                                <span class="nav-link-text">Write New Blog </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="examples/map.html">
                                <i class="ni ni-pin-3 text-primary"></i>
                                <span class="nav-link-text">View Blogs</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Accounts </span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link"
                                href="updateinfo.php";
                                target="_blank">
                                <i class="ni ni-spaceship"></i>
                                <span class="nav-link-text">Update Personal Info</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html"
                                target="_blank">
                                <i class="ni ni-palette"></i>
                                <span class="nav-link-text">Billing Address</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html"
                                target="_blank">
                                <i class="ni ni-ui-04"></i>
                                <span class="nav-link-text">Change Password</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html"
                                target="_blank">
                                <i class="ni ni-palette"></i>
                                <span class="nav-link-text">Change Security Question</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>