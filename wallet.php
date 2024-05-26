<?php
include ".\client_conn_server_protocols\config_protocols\start.php";
if(!check_session($conn)){
    header('location:index.php');
    exit;
}
?>
<head>

</head>
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-xxl-12">
                <div class="card balance-widget transparent">
                    <div class="card-body">
                        <div class="row" style="margin-left: 17px;">
                            <div class="col-xl-7 col-lg-9 col-xxl-8 col-8 col-md-8" style="background-color: transparent; margin-top: 40px; height: auto;">
                                <div  id="wallet-manage-title" class="loading">
                                    <div id="wallet_manage_title_content" style="margin-top: -40px;">
                                        <div style="float: left; text-align: left; width: 145px; height: 45px; margin-bottom: 15px;" class="animated-background"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-xxl-2 col-4 col-md-4" style="margin-top: -8px;">
                                <div id="wallet-manage-chart" class="loading step-1" style="height: 65px; overflow: hidden;">
                                    <div id="wallet_manage_chart_content" style="width: 62px; margin-top: 4px; height: 62px; border-radius: 50%; margin: auto;" class="animated-background"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-12 col-xxl-10">
                            <div class="balance-widget loading" id="wallet-manage-list">
                                <div id="wallet_manage_list_content" style="margin-top:30px;">';
                                    <div style="width: 100%; height: 120px; margin-bottom: 18px;" class="animated-background"></div>
                                    <div style="width: 100%; height: 120px; margin-bottom: 18px;" class="animated-background"></div>
                                    <div style="width: 100%; height: 120px; margin-bottom: 18px;" class="animated-background"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>