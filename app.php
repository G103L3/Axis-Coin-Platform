<!DOCTYPE html>
<?php
include ".\client_conn_server_protocols\config_protocols\start.php";
if(!check_session($conn)){
    header('location:index.php');
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Drip Coin </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet And Custom Icons-->
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/set_theme.js"></script>
    <link rel="stylesheet" href="vendor_icons/materials/css/material-design-iconic-font.css">
    <link rel="stylesheet" href="vendor_icons/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor_icons/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor_icons/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="vendor_icons/cryptocoins/css/cryptocoins.css">
    <link rel="stylesheet" href="vendor_icons/material-design-iconic-font/css/materialdesignicons.min.css">
    <script src="https://kit.fontawesome.com/d34a4a2ce4.js" crossorigin="anonymous"></script>
    <!-- Jquery and BootStrap -->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="./js/plugins/jquery-ui-init.js"></script>
    <!--  flot-chart js -->
    <script src="./vendor/apexchart/apexcharts.min.js"></script>
    <!-- Updater scripts -->
    <script src="js/updater.js"></script>
    <script src="js/wallets-init.js"></script>
    <script src="js/transactions-init.js"></script>
    <script src="js/offers-init.js"></script>
    <script src="js/quotes-init.js"></script>
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="./vendor/toastr/toastr.min.css">
    <!--Progess - Load Script -->
    <script src="js/data_include.js"></script>
    <script src="vendor/nprogress/nprogress.js"></script>
    <link href="vendor/nprogress/nprogress.css" rel="stylesheet" />
    <!-- Validator -->
    <script src="./vendor/validator/jquery.validate.js"></script>
    <script src="./vendor/validator/validator-init.js"></script>

</head>

<body>

<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>

<div id="main-wrapper">

    <div data-include="header"></div>
    <div data-include="sidebar"></div>
    <div data-include="welcome"></div>


    <div class="content-body">
        <div class="container">
            <div id="master_page_container">
            </div>
        </div>
    </div>
</div>

</div>




<!--<script src="./vendor/toastr/toastr.min.js"></script>
<script src="./vendor/toastr/toastr-init.js"></script>-->

<script src="./vendor/circle-progress/circle-progress.min.js"></script>
<script src="./vendor/circle-progress/circle-progress-init.js"></script>



</body>

</html>