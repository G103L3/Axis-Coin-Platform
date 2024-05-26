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
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 col-xxl-6">
                                <div id="wallet-chart" class="loading step-1">
                                    <div id="wallet_chart_content" style="width: 230px; height: 230px; border-radius: 50%; margin-bottom: 45px; margin-right: auto; margin-left: auto;" class="animated-background"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-xxl-6">
                                <div class="balance-widget loading" id="wallet-widget">
                                    <div id="wallet_widget_content">
                                        <div style="width: 260px; height: 35px; margin-bottom: 15px; margin-left: auto; margin-right: auto;" class="animated-background"></div>';
                                        <div style="width: 100%; height: 35px; margin-bottom: 15px;" class="animated-background"></div>
                                        <div style="width: 100%; height: 35px; margin-bottom: 15px;" class="animated-background"></div>
                                        <div style="width: 100%; height: 35px; margin-bottom: 15px;" class="animated-background"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-xxl-12">
                <div class="transaction-table loading" id="transaction-card">
                    <div id="transaction_card_content">
                        <div style="width: 200px; height: 35px; margin-bottom: 20px;" class="animated-background"></div>';
                        <div style="width: 100%; height: 60px; margin-bottom: 15px;" class="animated-background"></div>
                        <div style="width: 100%; height: 60px; margin-bottom: 15px;" class="animated-background"></div>
                        <div style="width: 100%; height: 60px; margin-bottom: 15px;" class="animated-background"></div>
                        <div style="width: 100%; height: 60px; margin-bottom: 15px;" class="animated-background"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




