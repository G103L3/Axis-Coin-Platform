<!DOCTYPE html>
<?php
include ".\client_conn_server_protocols\config_protocols\start.php";
if(!check_session($conn) || $_SESSION['status'] != "not_verified" || !isset($_SESSION['name'])){
    header('location:app.php#!/settings-personal');
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
    <!-- Custom Stylesheet -->

    <link rel="stylesheet" href="./vendor_icons/materials/css/material-design-iconic-font.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/set_theme.js"></script>

</head>

<body>

    <a href="" onclick="window.history.go(-1); return false;" class="zmdi zmdi-arrow-back zmdi-hc-4x" style="top: 2%; left: 3%; position: absolute;"></a>

    <div id="main-wrapper" class="show">


        <div>
            <div class="verification section-padding">
                <div class="container h-100">
                    <div class="row justify-content-center h-100 align-items-center">
                        <div class="col-xl-5 col-md-6">
                            <div class="auth-form card">
                                <!-- <div class="card-header">
                                <h4 class="card-title">Link a Debit card</h4>
                            </div> -->
                                <div class="card-body">
                                    <form action="verify-step-2.php" class="identity-upload">
                                        <div class="identity-content">
                                            <span class="icon"><i class="fa fa-shield"></i></span>
                                            <h4>Please verify your identity</h4>
                                            <p>Uploading your ID helps as ensure the safety and security of your founds
                                            </p>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success ps-5 pe-5">Upload ID</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>

</html>