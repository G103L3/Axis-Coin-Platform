<!DOCTYPE html>
<?php
include ".\client_conn_server_protocols\config_protocols\start.php";
if(!check_session($conn)){
    header('location:index.php');
    exit;
}
?>
<head>
    <script src="js/data_include.js"></script>
</head>
<div class="row">
    <div class="col-xl-3 col-md-4">
        <div data-include="settings_sidebar"></div>
    </div>
    <div class="col-xl-9 col-md-8">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User Profile</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" name="personal_form" class="profile_photo-upload">
                            <div class="row">
                                <div class="mb-3 col-xl-12">
                                    <div class="media align-items-center mb-3">
                                        <img class="me-3 rounded-circle me-0 me-sm-3"
                                             src="images/profile/2.png" width="55" height="55" alt="">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-0"><?php if(isset($_SESSION['name'])){echo $_SESSION['name'] . $_SESSION['surname'];} ?></h4>
                                            <p class="mb-0">Max file size is 7mb
                                            </p>
                                        </div>
                                    </div>
                                    <div class="file-upload-wrapper" style="z-index: 0" data-text="Change Photo">
                                        <input name="file_upload_field1" type="file" class="file-upload-field form-control"
                                               value="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User Profile</h4>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="mb-3 col-xl-12">
                                    <label class="me-sm-2">New Email</label>
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="mb-3 col-xl-12">
                                    <label class="me-sm-2">New Password</label>
                                    <input type="password" class="form-control"
                                           placeholder="**********">
                                    <p class="mt-2 mb-0">Enable two factor authencation on the security
                                        page
                                    </p>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="./vendor/validator/jquery.validate.js"></script>
<script src="./vendor/validator/validator-init.js"></script>
