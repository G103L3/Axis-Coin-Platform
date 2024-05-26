(function ($) {
    getTransactions();
    setInterval(function() {getTransactions()}, 3000);
    setInterval(function() {printTransactions()}, 1000);

})(jQuery);
transactions_counter = 0;
transactions_data = "";
async function printTransactions() {
    printPersonalTransactionsWidget(transactions_data);
}
async function getTransactions() {
    let next = false;
    if(getPersonalTransactionsStatus() || transactions_counter == 0){
        await $.ajax({
            url: "../scripts/getTransactions.php",
            type: "post",
            data: {mode: 'personal_history'},
            async: false,
            success: function (data) {
                transactions_data = JSON.parse(data);
            }
        });
        await $.ajax({
            url: "../scripts/deleteIdPersonalTransactions.php",
            async: false,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data){
            }
        });
        if(transactions_counter == 0){
            next = true;
        }
    }
    if(next){
        await transactions_counter++;
    }
}
async function printPersonalTransactionsWidget(data){
    if($('#transaction_card_content').length > 0){
        $('#transaction_card_content').remove();
    }
    $('#transaction-card').each(function () {
        let element = $(this);
        if(!element.hasClass('loading')) {
            element.append('<div id="transaction_card_content"><div class="card">' +
                '                         <div class="card-header">' +
                '                                      <h4 class="card-title">Transactions</h4>' +
                '              </div>' +
                '               <div class="card-body" id="card_body">');
            if (data.length == 0) {
                $('#card_body').append('<div class="row table-div" style="padding-bottom: 20px;" id="table_element-t">');
                $('#table_element-t').append('<div class="col-xl-12 col-xxl-12 col-md-12 col-12" style="line-height: 50px; text-align: center; ">There are no transactions yet </div><a href="" onclick="return nav_click(\'buy-sell\')" class="btn btn-success mt-0 btm-sm text-white">Place your first position in the market</a>');
                $('#card_body').append('</div>');
            }
            for (let i = 0; i < data.length; i++) {
                $('#card_body').append('<div class="row table-div" id="table_element-t' + i + '" style="padding:10px;">');
                if (data[i]['status'] == "pending") {
                    $('#table_element-t' + i).append('<div class="col-xl-1 col-xxl-1 col-md-12" style="line-height: 50px; font-size: 100%;">\n' +
                        '                                                            <span class="badge bg-warning text-white" style="width: 100%; height: auto;">On sale</span>\n' +
                        '                                                        </div>');
                } else{
                    if (data[i]['type'] == "sell") {
                        $('#table_element-t' + i).append('<div class="col-xl-1 col-xxl-1 col-md-12" style="line-height: 50px; font-size: 100%;">\n' +
                            '                                                            <span class="badge bg-danger text-white" style="width: 100%; height: auto;">Sold</span>\n' +
                            '                                                        </div>');
                    } else {
                        if (data[i]['type'] == "buy") {
                            $('#table_element-t' + i).append('<div class="col-xl-1 col-xxl-1 col-md-12" style="line-height: 50px; font-size: 100%;">\n' +
                                '                                                            <span class="badge bg-success text-white" style="width: 100%; height: auto;">Buy</span>\n' +
                                '                                                        </div>');
                        } else {
                            if (data[i]['type'] == "rebuy") {
                                $('#table_element-t' + i).append('<div class="col-xl-1 col-xxl-1 col-md-12" style="line-height: 50px; font-size: 100%;">\n' +
                                    '                                                            <span class="badge bg-primary text-white" style="width: 100%; height: auto;">Rebuy</span>\n' +
                                    '                                                        </div>');
                            }
                        }
                    }
                }

                $('#table_element-t' + i).append('<div class="col-xl-5 col-xxl-5 col-md-12 col-12" style="line-height: 50px; font-size: 85%;">\n' +
                    '                                                                <small> ' + data[i]['datetime'] + '</small>\n' +
                    '                                                        </div>');
                $('#table_element-t' + i).append('<div class="col-xl-2 col-xxl-2 col-md-4 col-4" style="line-height: 50px; text-align: left; font-size: 85%;">\n' +
                    '<i class="las la-cubes la-2x"></i> : ' +
                    '' + (Math.round(data[i]['packets_quantity'] * 100) / 100).toString().replace(/\.+/g, ",") + ' Packets\n' +
                    '                                                        </div>\n' +
                    '                                                        <div class="col-xl-2 col-xxl-2 col-md-4 col-4" style="line-height: 50px; text-align: left;  font-size: 85%;">\n' +
                    '<div class="row"><i class="cc BTC" style="width: 20px; height: 20px; font-size: 20px; margin-top: -3.2px; margin-right: 2px;"></i> :  ' + (Math.round(data[i]['revox_coins_quantity'] * 100) / 100).toString().replace(/\.+/g, ",") + ' RVX <p style="line-height: 30px; text-align: left; font-size: 85%;" class="text-primary">➜ ' + (Math.round(data[i]['revox_value'] * 100) / 100).toString() + ' per Pack</p></div>' +
                    '                                                        </div>\n');

                if (data[i]['status'] == "pending") {
                    $('#table_element-t' + i).append('<div class="col-xl-2 col-xxl-2 col-md-4 col-12 text-warning" style="line-height: 50px; text-align:center; font-size: 85%;">\n' +
                        '                                                            <a href="#buy-2" onclick="buy_click_per(\'' + data[i]['id'] + '\', \'' + data[i]['quantity'] + '\', \'' + data[i]['seller_id'] + '\')" data-toggle="tab" class="btn btn-warning mt-0 btm-sm text-white" style="height: 25px; padding: 0px;">Rebuy</a>' +
                        ' </div>');
                } else{
                    if (data[i]['type'] == "sell") {
                        $('#table_element-t' + i).append('<div class="col-xl-2 col-xxl-2 col-md-4 col-4 text-danger" style="line-height: 50px; text-align:left; font-size: 85%;">\n' +
                            '<i class="fa fa-file-invoice-dollar fa-2x"></i> : ' +
                            '' + (Math.round((data[i]['revox_coins_quantity'] * data[i]['packets_quantity'] * data[i]['revox_value']) * 100) / 100).toString().replace(/\.+/g, ",") + ' USD\n' +
                            ' </div>');
                    } else {
                        if (data[i]['type'] == "buy") {
                            $('#table_element-t' + i).append('<div class="col-xl-2 col-xxl-2 col-md-4 col-4 text-success" style="line-height: 50px; text-align:left; font-size: 85%;">\n' +
                                '<i class="fa fa-file-invoice-dollar fa-2x"></i> : ' +
                                '' + (Math.round((data[i]['revox_coins_quantity'] * data[i]['packets_quantity'] * data[i]['revox_value']) * 100) / 100).toString().replace(/\.+/g, ",") + ' USD\n' +
                                ' </div>');
                        } else {
                            if (data[i]['type'] == "rebuy") {
                                $('#table_element-t' + i).append('<div class="col-xl-2 col-xxl-2 col-md-4 col-4 text-primary" style="line-height: 50px; text-align:left; font-size: 85%;">\n' +
                                    '<i class="fa fa-file-invoice-dollar fa-2x"></i> : ' +
                                    '' + (Math.round((data[i]['revox_coins_quantity'] * data[i]['packets_quantity'] * data[i]['revox_value']) * 100) / 100).toString().replace(/\.+/g, ",") + ' USD\n' +
                                    ' </div>');
                            }
                        }
                    }
                }
                $('#card_body').append('</div>');
            }
            element.append('</div></div></div>');
        }else{
            setTimeout(() => {  element.removeClass('loading') }, 1500);
        }
    });
}