<!DOCTYPE html>
<?php
include "./client_conn_server_protocols/config_protocols/start.php";
if(check_session($conn)){
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
    <link rel="stylesheet" href="vendor_icons/materials/css/material-design-iconic-font.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->


    <link rel="stylesheet" href="./css/style.css">
    <script src="js/set_theme.js"></script>

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

        <div class="authincation section-padding">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-5 col-md-6">
                        <div class="mini-logo text-center my-5">
                            <a href="index.php"><img src="./images/logo.png" alt=""></a>
                        </div>
                        <div class="auth-form card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title">Sign up your account</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" name="signup_form" class="signup_validate">
                                    <?php
                                    if(isset($_GET['referral'])) {
                                        $referral = pg_escape_string($conn, $_GET['referral']);
                                        if ($referral != NULL && $referral != null) {
                                            $referral_query = "SELECT id, username FROM users WHERE referral_id='$referral'";
                                            $referral_result = pg_query($conn, $referral_query);
                                            if (pg_num_rows($referral_result) > 0) {
                                                $referral_row = pg_fetch_array($referral_result);
                                                echo '<h5 style="display: none" id="referral_user">';
                                                echo $referral_row['id'];
                                                echo '</h5>';
                                                echo '
                    <p class="mt-3">Referral: ';
                                                echo $referral;
                                                echo '</p>
                    <p class="mt-3">Ref. Username: ';
                                                echo $referral_row['username'];
                                                echo '</p>';
                                            }else{
                                                echo '<p class="mt-3">Invalid referral</p>';
                                            }
                                        }
                                    }?>
                                    <div class="mb-3">
                                        <label>Username</label>
                                        <input type="text" id="username" class="form-control" placeholder="Username" name="username">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" id="email" class="form-control" placeholder="hello@example.com"
                                            name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input id="password" type="password" class="form-control" placeholder="Password"
                                            name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label>Re-Password</label>
                                        <input id="re_password" type="password" class="form-control" placeholder="Re-Password"
                                               name="re_password">
                                    </div>
                                    <p class="mb-0 text-danger" id="error-signup"></p>
                                    <div class="text-center mt-4">
                                        <button type="submit" id="submit-signup" class="btn btn-success w-100">Sign up</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Already have an account? <a class="text-primary" href="signin.php">Sign in</a>
                                    </p>
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


    <script src="./vendor/validator/jquery.validate.js"></script>
    <script src="./vendor/validator/validator-init.js"></script>
    <script src="js/scripts.js"></script>



</body>

</html>