<!DOCTYPE html>
<html lang="en">
<?php
include '../connection/connect.php';
error_reporting(0);
session_start();
if (empty($_SESSION['adm_id'])) {
    header('location:index.php');
} else {
     ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Panel</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .navbar {
            background-color: #343a40;
            height: 60px;
        }
        .navbar .navbar-nav .nav-link {
            color: #fff;
            margin-right: 20px;
        }
        .navbar .profile-pic {
            height: 40px;
        }
        .left-sidebar {
            position: fixed;
            top: 60px;
            height: 100%;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .sidebar-nav ul {
            padding: 0;
        }
        .sidebar-nav li {
            list-style: none;
            padding: 10px 20px;
        }
        .sidebar-nav li a {
            color: #333;
            text-decoration: none;
        }
        .card {
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card h2 {
            color: #333;
        }
    </style>
</head>
<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0"></ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic img-fluid" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                            <ul class="dropdown-user">
                                <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout ↪</a></li>
                            </ul>
                        </div>
                    </li>
                </div>
            </nav>
        </div>
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home 🏠</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Details</li>
                        <li> <a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Customer Details</span></a></li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-utensils" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_menu.php">All Menus</a></li>
                                <li><a href="add_menu.php">Add Menu</a></li>
                            </ul>
                        </li>
                        <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Dashboard</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card p-30" style="border:1px solid grey; background-color:#ccccec">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <!-- <span><i class="fa fa-utensils f-s-40" aria-hidden="true"></i></span> -->
                                            <h2><?php
                                            $sql = 'select * from dishes';
                                            $result = mysqli_query($db, $sql);
                                            $rws = mysqli_num_rows($result);
                                            echo $rws;
                                            ?></h2>
                                        </div>
                                        <div class="media-body media-text-right">
                                       
                                            <h3 class="m-b-0">Product</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card p-30" style="border:1px solid grey; background-color:#ccccec">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                        <!-- <span><i class="fa fa-users-cog f-s-40"></i></span> -->
                                        <h2><?php
                                            $sql = 'select * from users';
                                            $result = mysqli_query($db, $sql);
                                            $rws = mysqli_num_rows($result);
                                            echo $rws;
                                            ?></h2>
                                        </div>
                                        <div class="media-body media-text-right">
                                            
                                            <h3 class="m-b-0">Customers</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-30" style="border:1px solid grey; background-color:#ccccec">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                        <!-- <span><i class="fa fa-refresh f-s-40" aria-hidden="true"></i></span> -->


                                        <h2><?php
                                            $sql = "select * from users_orders WHERE status = 'in process' ";
                                            $result = mysqli_query($db, $sql);
                                            $rws = mysqli_num_rows($result);
                                            echo $rws;
                                            ?></h2>

                                        </div>
                                        <div class="media-body media-text-right">
                                       
                                            <h3 class="m-b-0">Orders! On the way.</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-30" style="border:1px solid grey; background-color:#ccccec">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                        <!-- <span><i class="fa fa-check f-s-40 text-success" aria-hidden="true"></i></span> -->
                                        <h2><?php
                                            $sql = "select * from users_orders WHERE status = 'closed' ";
                                            $result = mysqli_query($db, $sql);
                                            $rws = mysqli_num_rows($result);
                                            echo $rws;
                                            ?></h2>
                                        </div>
                                        <div class="media-body media-text-right">
                                            
                                            <h3 class="m-b-0">Successfully Delivered Orders</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-30" style="border:1px solid grey; background-color:#ccccec">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <!-- <span><i class="fas fa-times-circle f-s-40" aria-hidden="true"></i></span> -->
                                            <h2><?php
                                            $sql = "select * from users_orders WHERE status = 'rejected' ";
                                            $result = mysqli_query($db, $sql);
                                            $rws = mysqli_num_rows($result);
                                            echo $rws;
                                            ?></h2>
                                        </div>
                                        <div class="media-body media-text-right">
                                         
                                            <h3 class="m-b-0">Cancelled Orders</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-30" style="border:1px solid grey; background-color:#ccccec">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <!-- <span><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span> -->
                                            <h2><?php
                                            $result = mysqli_query($db, 'SELECT SUM(price) AS value_sum FROM users_orders WHERE status = "closed"');
                                            $row = mysqli_fetch_assoc($result);
                                            $sum = $row['value_sum'];
                                            echo $sum;
                                            ?></h2>
                                        </div>
                                        <div class="media-body media-text-right">
                                    
                                            <h3 class="m-b-0">Total Earnings</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'include/footer.php'; ?>
            <script src="js/lib/jquery/jquery.min.js"></script>
            <script src="js/lib/bootstrap/js/popper.min.js"></script>
            <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
            <script src="js/jquery.slimscroll.js"></script>
            <script src="js/sidebarmenu.js"></script>
            <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
            <script src="js/custom.min.js"></script>
</body>
</html>
<?php
}
?>

"