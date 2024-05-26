<?php
include ".\client_conn_server_protocols\config_protocols\start.php";
?>
<div class="page_title">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="page_title-content">
                    <p>Welcome Back,
                        <span> <?php echo $_SESSION['username']; ?></span>
                    </p>
                </div>
            </div>
            <div class="col-6">
                <ul class="text-right breadcrumbs list-unstyle">
                    <li><?php if($_SESSION['status'] == "not_verified"){ echo '<a href="" onclick="return nav_click(\'settings-personal\')" class="btn btn-danger mt-0 btm-sm text-white">Not Verified</a>'; }else{ if($_SESSION['status'] == 'pending'){ echo '<a href="verify-step-3.php" class="btn btn-warning mt-0 btm-sm text-white">Pending verification</a>'; }else{echo '<a href="verify-step-4.php" class="btn btn-success mt-0 btm-sm text-white">Verified</a>';}} ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>