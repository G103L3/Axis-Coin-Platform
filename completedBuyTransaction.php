<!DOCTYPE html>
<?php
include ".\client_conn_server_protocols\config_protocols\start.php";
if(!check_session($conn)){
    header('location:app.php');
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


    <link rel="stylesheet" href="./css/style.css">
    <script src="js/set_theme.js"></script>

</head>

<body>



<link rel="stylesheet" href="./vendor_icons/materials/css/material-design-iconic-font.css">

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
                                <form action="verify-step-4.php" class="identity-upload">
                                    <div class="identity-content">
                                        <span class="icon"><i class="fa fa-check"></i></span>
                                        <h4>Operation Successfully</h4>
                                    </div>

                                    <div class="upload-loading text-center mb-3">
                                        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
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



<script>
    window.setTimeout(function () {
        window.location.href = "app.php#!/dashboard";
    }, 2000);
</script>
</body>

</html>