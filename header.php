<?php
include ".\client_conn_server_protocols\config_protocols\start.php";
if(!check_session($conn)){
    header('location:../index.php');
    exit;
}
?>

<head>
    <script src="js/generate_avatar.js"></script>
</head>
<div class="header" style="height: 64px;">
    <div class="container" style="height: 64px;">
        <div class="row" style="height: 64px;">
            <div class="col-xl-12" style="height: 64px;">
                <nav class="navbar" style="height: 64px;">
                    <div class="col-xl-10 col-lg-11 col-xxl-10 col-10 col-md-11">

                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-xxl-3 col-5 col-md-5" style="background-color: transparent; margin-top: -20px; height: 64px; overflow: hidden">
                                            <div id="header-wallet-chart" class="loading step-1" style="height: 20%">
                                                <div id="wallet_header_chart_content" style="width: 62px; margin-top: 4px; height: 62px; border-radius: 50%; margin: auto;" class="animated-background"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-9 col-lg-9 col-xxl-9 col-7 col-md-7"  style="margin-top: -15px; height: 64px; overflow: hidden">
                                            <div  id="wallet-header" class="align-items-baseline loading" style="text-align: left; justify-content: left; align-items: start;">
                                                <div id="wallet_header_content" style="width: 200px; height: 30px; margin-top: 15px;" class="animated-background"></div>
                                            </div>
                                        </div>
                                    </div>

                    </div>

                    <div class="col-xl-2 col-lg-1 col-xxl-2 col-2 col-md-1">
                        <div class="dashboard_log" style="margin-top: -15px;">
                            <div class="d-flex align-items-end">
                                <div class="profile_log dropdown" id="menu_trigger">
                                    <div class="user" data-toggle="dropdown" style="margin-right: 10px;">
                                        <p id="user_acronym" style="display: none;"><?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?></p>
                                        <span class="thumb" style="background-color: rgba(255, 255, 255, 0);"><img id="profile_image" class="rounded-circle" style="width: 120%; margin-top: -12%"></span>
                                        <span class="name"><?php echo $_SESSION['username']; ?></span>
                                        <span class="arrow"><i class="la la-angle-down"></i></span>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-right" id="menu_user">
                                        <a href="history.html" class="dropdown-item">
                                            <i class="la la-book"></i> History
                                        </a>
                                        <a href="" onclick="return nav_click('settings')" class="nav-link">
                                            <i class="la la-cog"></i> Settings
                                        </a>
                                        <a href="lock.html" class="dropdown-item">
                                            <i class="la la-lock"></i> Lock
                                        </a>
                                        <a href="client_conn_server_protocols/config_protocols/close_session.php" class="dropdown-item logout">
                                            <i class="la la-sign-out"></i> Logout
                                        </a>
                                    </div>
                                    <script>
                                        <?php
                                        $users_id = $_SESSION['id'];
                                        $profile_photo_result = pg_query($conn, "SELECT url_photo FROM users WHERE id = $users_id");
                                        if($profile_photo_result){
                                            while($profile_photo_row = pg_fetch_array($profile_photo_result)){
                                                $url = $profile_photo_row['url_photo'];
                                                if($url != 'generated'){
                                                    echo "document.getElementById(\"profile_image\").src = \"" . $url . "\";";
                                                }else{
                                                    echo "document.getElementById(\"profile_image\").src = generateAvatar($(\"#user_acronym\").text(), \"#FFFFFF\", \"#048edb\");";
                                                }
                                            }
                                        }
                                        ?>
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>



