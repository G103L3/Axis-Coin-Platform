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
    <div class="col-xl-6 col-lg-12 col-xxl-6 col-md-12">
        <div class="card profile_chart transparent">
            <div class="card-body">
                <div id="offers-chart" class="loading step-1">
                    <div id="offers_chart_content" style="width: 98%; height: 287px; margin-bottom: 15px; margin-right: auto; margin-left: auto;" class="animated-background"></div>
                    <div id="offers_details_content" style="width: 100%">
                        <div class="row">
                            <div class="col-xl-4 col-sm-6 col-6">
                                <div class="animated-background" style="width: 98%; height: 157px; margin-right: 1%; margin-left: 1%; margin-bottom: 2%; margin-top: 2%;">
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-6">
                                <div class="animated-background" style="width: 98%; height: 157px; margin-right: 1%; margin-left: 1%; margin-bottom: 2%; margin-top: 2%;">
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-6">
                                <div class="animated-background" style="width: 98%; height: 157px; margin-right: 1%; margin-left: 1%; margin-bottom: 2%; margin-top: 2%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-12 col-xxl-6 col-md-12 col-12">
        <div class="" id="buy-sell_card">
            <div class="card-body">
                <div class="buy-sell-widget">
                    <ul class="nav nav-tabs">
                        <li class="nav-item display-none" id="buy_button"><a class="nav-link active" data-toggle="tab"
                                                href="#buy">Buy</a>
                        </li>
                        <li class="nav-item display-none" id="sell_button"><a class="nav-link" onclick="sell_configure()" data-toggle="tab" href="#sell">Sell</a>
                        </li>
                    </ul>
                    <div class="tab-content tab-content-default">
                        <div class="tab-pane fade show active" id="buy" role="tabpanel">
                            <label class="me-sm-2 display-none" id="buy_extra_text">Choose an offer</label>
                            <div class="transaction-table loading" id="transaction-buy-card">
                                <div id="transaction-buy-card_content" style="margin-top: -30px">
                                    <div style="width: 43%; height: 60px; margin-bottom: 25px; margin-right: 4%; display: inline-block;" class="animated-background"></div>
                                    <div style="width: 43%; height: 60px; margin-bottom: 25px; margin-left: 4%; display: inline-block;" class="animated-background"></div>
                                    <div style="width: 130px; height: 20px; margin-bottom: 7px;" class="animated-background"></div>
                                    <div style="width: 100%; height: 35px; margin-bottom: 13px;" class="animated-background"></div>
                                    <div style="width: 100%; height: 35px; margin-bottom: 13px;" class="animated-background"></div>
                                    <div style="width: 100%; height: 35px; margin-bottom: 13px;" class="animated-background"></div>
                                    <div style="width: 100%; height: 35px; margin-bottom: 13px;" class="animated-background"></div>
                                    <div style="width: 100%; height: 35px; margin-bottom: 13px;" class="animated-background"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="buy-2" role="tabpanel">
                            <h1 style="display: none" id="t_id"></h1>
                            <h1 style="display: none" id="seller_id"></h1>
                            <h1 style="display: none" id="buyer_id"><?php echo $_SESSION['id']; ?></h1>
                            <form method="post" name="myform" class="buy_validate">
                                <div class="mb-3">
                                    <label class="me-sm-2">Payment Method</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text"><i
                                                        class="zmdi zmdi-balance-wallet"></i></label>
                                        </div>
                                        <select class="form-control" id="method" name="method">
                                            <option value="">Select</option>
                                            <option value="cash_wallets">Cash Wallet: <?php     $id = $_SESSION['id']; $cash_wallets_result = pg_query($conn, "SELECT id, balance FROM cash_wallets WHERE user_id=" . hash_crypt($id) . "");
                                                if(pg_num_rows($cash_wallets_result) > 0){$cash_row = pg_fetch_array($cash_wallets_result); echo $cash_row['balance'];}?> USD</option>
                                            <option value="network_wallets">Network Wallet: <?php     $id = $_SESSION['id']; $network_wallets_result = pg_query($conn, "SELECT id, balance FROM network_wallets WHERE user_id=" . hash_crypt($id) . "");
                                                if(pg_num_rows($network_wallets_result) > 0){$network_row = pg_fetch_array($network_wallets_result); echo $network_row['balance'];}?> USD</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="me-sm-2">Enter your quantity</label>
                                    <div class="input-group">
                                        <input type="text" name="quantity" class="form-control"
                                               value="" id="quantity">
                                        <span class="units" id="quantity_max"></span>
                                        <div style="background-color: transparent; z-index: 100; width: 50%; height: 100%; position: absolute; left: 50%"></div>
                                        <input type="text" name="usd_amount" class="form-control"
                                               value="" id="usd_amount">
                                        <div class="units" style="left: 52%; margin-top: 2px; width: 47%; z-index: 3;"><div id="change-rate_super"></div></div>
                                    </div>
                                    <div style="width: 100%; height: auto;">
                                        <div class="col-xl-12 col-xxl-12 col lg-12 col-md-12 col-12">
                                            <div class="row">
                                                <div class="col-xl-12 col-xxl-12 col lg-12 col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-xxl-12 col-md-7 col-lg-7 col-12"><p class="mb-0" style="font-size: 15px">Current amount of RVX per pack: </p></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-5 col-lg-5 col-12"><div id="actual-RVX-in-packet"></div></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-12 col-lg-12 col-12"><small class="text-success mb-0" style="font-size: 13px"></small></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-xxl-12 col lg-12 col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-xxl-12 col-md-7 col-lg-7 col-12"><p class="mb-0" style="font-size: 15px">Amount of RVX per pack after purchase: </p></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-5 col-lg-5 col-12"><div id="future-RVX-in-packet"></div></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-12 col-lg-12 col-12"><small class="text-success mb-0" style="font-size: 13px">(The content of the pack doubles with each purchase)</small></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-xxl-12 col lg-12 col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-xxl-12 col-md-7 col-lg-7 col-12"><p class="mb-0" style="font-size: 15px">Gain of RVX per pack after resell: </p></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-5 col-lg-5 col-12"><div id="profit-RVX-in-packet-buy"></div></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-12 col-lg-12 col-12"><small class="text-success mb-0" style="font-size: 13px">(The GROSS return is always 200% of the initial investment)</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-danger" id="error-buy"></p>
                                </div>
                                <button type="submit" name="submit"
                                        id="submit-buy" class="btn btn-success w-100">Exchange Now</button>
                                <p class="p-1" style="font-size: 12px">Disclaimer: The profit generated by any resale of the package is to be considered reduced by 50% for fees. However, this guarantees a gain equal to 150% of the investment!</p>

                                <p class="p-1" style="font-size: 10px">By clicking Exchange Now you agree to assume the risk, in case of non-sale of your "packets": to the partial or total loss of your withdrawable "cash wallet" balance. The system GUARANTEES the possibility of making a Rebuy on your packets, and also reminds you that the transactions DO NOT have a TIME LIMIT, thus increasing the probability of sale.</p>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="sell" role="tabpanel">
                            <form method="post" name="myform" class="sell_validate">
                                <div class="mb-3">
                                    <label class="me-sm-2">Packet to sell</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text"><i
                                                        class="las la-cubes me-3"></i></label>
                                        </div>
                                        <select class="form-control" id="packets_list" name="packet">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="me-sm-2">Enter your quantity</label>
                                    <div class="input-group">
                                        <input type="text" name="quantity" class="form-control"
                                               value="" id="quantity_sell">
                                        <span class="units" id="quantity_max_sell" style="right: 2%;"></span>
                                    </div>
                                    <div style="width: 100%; height: auto;">
                                        <div class="col-xl-12 col-xxl-12 col lg-12 col-md-12 col-12">
                                            <div class="row">
                                                <div class="col-xl-12 col-xxl-12 col lg-12 col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-xxl-12 col-md-7 col-lg-7 col-12"><p class="mb-0" style="font-size: 15px">Current amount of RVX per pack: </p></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-5 col-lg-5 col-12"><div id="actual-RVX-in-packet-sell"></div></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-12 col-lg-12 col-12"><small class="text-success mb-0" style="font-size: 13px"></small></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-xxl-12 col lg-12 col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-xxl-12 col-md-7 col-lg-7 col-12"><p class="mb-0" style="font-size: 15px">Amount of RVX per pack pre-purchase: </p></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-5 col-lg-5 col-12"><div id="past-RVX-in-packet"></div></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-12 col-lg-12 col-12"><small class="text-success mb-0" style="font-size: 13px"></small></div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-xxl-12 col lg-12 col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-xxl-12 col-md-7 col-lg-7 col-12"><p class="mb-0" style="font-size: 15px">Gain of RVX per pack after sell: </p></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-5 col-lg-5 col-12"><div id="profit-RVX-in-packet"></div></div>
                                                        <div class="col-xl-12 col-xxl-12 col-md-12 col-lg-12 col-12"><small class="text-success mb-0" style="font-size: 13px">(The GROSS return is always 200% of the initial investment)</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-danger" id="error-sell"></p>
                                </div>
                                <button type="submit" name="submit"
                                        id="submit-sell" class="btn btn-success w-100">Exchange Now</button>
                                <p class="p-1" style="font-size: 13px">By clicking Exchange Now you consent to the sale of the "packets" in your possession, thus making them purchasable, and the profit is WITHDRAWABLE. Your IDENTITY will remain 100% ANONYMOUS.</p>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="js/buy-sell.js"></script>

<!-- Validator -->
<script src="./vendor/validator/jquery.validate.js"></script>
<script src="./vendor/validator/validator-init.js"></script>