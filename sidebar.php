<?php
include ".\client_conn_server_protocols\config_protocols\start.php";
if(!check_session($conn)){
    header('location:../index.php');
    exit;
}
?>
<div class="sidebar" style="z-index: 10000;">
    <a class="brand-logo" href="" onclick="return nav_click('dashboard')">
        <img src="images/logo.png" alt="">
        <span>Drip Coin </span></a>
    <div class="menu" id="menu">
        <ul>
            <li>
                <a href="" onclick="return nav_click('dashboard')">
                    <span><i class="zmdi zmdi-view-dashboard"></i></span>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li><a href="" onclick="return nav_click('buy-sell')">
                    <span><i class="zmdi zmdi-repeat"></i></span>
                    <span class="nav-text">Exchange</span>
                </a>
            </li>
            <li><a href="" onclick="return nav_click('wallet')">
                    <span><i class="zmdi zmdi-balance-wallet"></i></span>
                    <span class="nav-text">Wallet</span>
                </a>
            </li>
            <li><a href="" onclick="return nav_click('settings')">
                    <span><i class="zmdi zmdi-settings"></i></span>
                    <span class="nav-text">Setting</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer">
        <div class="social">
            <a href="#"><i class="fa fa-youtube-play"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
        </div>
        <div class="copy_right">
            ©2018-
            <?php
                echo date("Y");
            ?> Drip Coin
        </div>
    </div>

</div>
