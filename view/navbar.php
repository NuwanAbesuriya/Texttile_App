<?php
include_once("../common/cartSession.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/icon" href="../image/logo/logo1.png">

    <title>BOSARA TEXTILE</title>

    <link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/DataTables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="../resources/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="../resources/animate.css/animate.min.css">
    <link rel="stylesheet" href="../css/custom.css">

    <script src="../resources/jquery/jquery-3.6.0.min.js"></script>
    <script src="../resources/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../resources/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../resources/fancybox/jquery.fancybox.js"></script>
    <script src="../resources/sweetAlerts2/dist/sweetalert2.all.min.js"></script>

    <style>
        .sec-nav {
            min-height: 80px;
            height: auto;
            background-color: rgba(255, 255, 255, 0.8);
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>

<body>
    <div style="background-color: #db9200; height:8px;"></div>

    <nav class="navbar navbar-expand-md navbar-light bg-light justify-content-md-around">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-none d-md-block">
        
            <a href="https://www.facebook.com" class="text-decoration-none" target="_blank" style="color:#808080"><i class="fab fa-facebook-f"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="https://www.twitter.com" class="text-decoration-none" target="_blank" style="color:#808080"><i class="fab fa-twitter"></i></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="https://www.youtube.com" class="text-decoration-none" target="_blank" style="color:#808080"><i class="fab fa-youtube"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>

        <div class="collapse navbar-collapse order-1 order-md-0" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item mr-2">
                    <a href="home.php" class="text-decoration-none" style="color:#808080">Home</a>
                </li>
                <li class="nav-item mr-2">
                    <a href="dashboard.php" class="text-decoration-none" style="color:#808080">My Profile</a>
                </li>
                <li class="nav-item mr-2">
                    <a href="contactus.php" class="text-decoration-none" style="color:#808080">Contact Us</a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="text-dark text-decoration-none" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Involve with us <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="collapse pl-3" id="collapseExample">
                        <div>
                            <a href="tel:+94763669100" class="font-weight-lighter " style="color:#808080"><i class="fas fa-phone-rotary"></i> +94 763669100</a>
                        </div>
                        <div>
                            <a href="https://www.facebook.com" class="mr-2" target="_blank" style="color:#808080"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.twitter.com" class="mr-2" target="_blank" style="color:#808080"><i class="fab fa-twitter"></i></i></a>
                            <a href="https://www.youtube.com" class="mr-2" target="_blank" style="color:#808080"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div>
            <span class="pl-2" style="color:#808080;">
                <span style="font-size: larger"><i class="fas fa-user-circle"></i></span>

                <?php if (isset($_SESSION["customer"])) { ?>

                    <span>Hi...! <?php echo $_SESSION["customer"]["userFname"]; ?></span> &nbsp;
                    <a id="logoutBtn" href="../controller/login_controller.php?type=logout" class="button btn border-0 text-white text-uppercase text-decoration-none" style="color:#808080;">
                        <i class="fas fa-sign-out"></i> Logout </a>

                <?php } else { ?>

                    <span>Hi...! User</span> &nbsp;
                    <a id="loginBtn" href="login.php" class="button btn border-0 text-white text-uppercase text-decoration-none" style="color:#808080;">
                        <i class="fas fa-sign-in"></i> Login </a>

                <?php } ?>
            </span>&nbsp;&nbsp;
        </div>

    </nav>

    <!-- /////////////////////////////////// 2nd Navbar ///////////////////////////////////// -->
    <nav id="sec-nav" class="navbar sec-nav sticky-top navbar-expand-sm justify-content-center">

        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <div class="mid-logo mr-auto">
            <div class="navbar-brand">
                <img src="../image/logo/logo1.png" width="200px" height="100px" class="align-top" alt="logo">
            </div>
        </div>

        <ul class="navbar-nav text-uppercase font-weight-bolder">
            <li class="nav-item">
                <a class="nav-link navmenu" href="home.php#newIn">new in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navmenu" href="home.php#collection">collections</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navmenu" href="aboutUs.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navmenu" href="cart.php" style="font-size: large">
                    <i class="fas fa-shopping-cart"></i>
                    <?php $count = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : "0"; ?>
                    <span class="badge badge-notify text-white">
                        <?php echo $count; ?>
                    </span>
                </a>
            </li>
        </ul>
    </nav>