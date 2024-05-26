

function buy_click(id, quantity, seller_id) {
    $('#t_id').val(id);
    $('#quantity').val(parseFloat(quantity));
    $('#seller_id').val(seller_id);
    last_digit = parseFloat(quantity);
    $('#quantity_max').text("/" + parseFloat(quantity).toString().replace(/\.+/g, ","));
    $.ajax({
        url: "../scripts/getTransactions.php",
        type: "post",
        data: {mode: 'id_pending_search', t_id: id},
        async: false,
        success: function (data) {
            data = JSON.parse(data);
            if (data.length == 0) {
                location.reload();
            } else {
                max_quantity = data[0]['packets_quantity'];
                unit_price = data[0]['revox_coins_quantity'];
            }
        }

    });
    $('.buy-change-rate').remove();
    if($('#actual-RVX-in-packet').find('.change-rate').length > 0){
        $('#actual-RVX-in-packet').find('.change-rate').remove();
    }
    if($('#future-RVX-in-packet').find('.change-rate').length > 0){
        $('#future-RVX-in-packet').find('.change-rate').remove();
    }
    if($('#profit-RVX-in-packet-buy').find('.change-rate').length > 0){
        $('#profit-RVX-in-packet-buy').find('.change-rate').remove();
    }
    $('#change-rate_super').append('<div class="row change-rate buy-change-rate"><h6 class="mb-0" style="font-size: 16px">' + (Math.round(($('#quantity').val() * unit_price) * 100) / 100).toString().replace(/\.+/g, ",") + ' RVX </h6><p id="change_rate_quantity" class="display-none">' + (Math.round(($('#quantity').val() * unit_price) * 100) / 100).toString() + '</p><p id="change_rate_style" class="display-none">font-size: 16px</p><p id="change_rate_class" class="display-none">text-success</p><p id="change_rate_extra" class="display-none"></p></div>');
    $('#actual-RVX-in-packet').append('<div class="row change-rate"><h6 class="mb-0" style="font-size: 14px">' + (Math.round((unit_price * 100) / 100)).toString().replace(/\.+/g, ",") + ' RVX </h6><p id="change_rate_quantity" class="display-none">' + (Math.round((unit_price * 100) / 100)).toString() + '</p><p id="change_rate_style" class="display-none">font-size: 14px</p><p id="change_rate_class" class="display-none">text-primary</p><p id="change_rate_extra" class="display-none"> per Pack</p></div>');
    $('#future-RVX-in-packet').append('<div class="row change-rate"><h6 class="mb-0" style="font-size: 14px">' + (Math.round(((unit_price*2)* 100) / 100)).toString().replace(/\.+/g, ",") + ' RVX </h6><p id="change_rate_quantity" class="display-none">' + (Math.round((unit_price * 2 * 100) / 100)).toString() + '</p><p id="change_rate_style" class="display-none">font-size: 14px</p><p id="change_rate_class" class="display-none">text-primary</p><p id="change_rate_extra" class="display-none"> per Pack</p></div>');
    $('#profit-RVX-in-packet-buy').append('<div class="row change-rate"><h6 class="mb-0" style="font-size: 14px">' + (Math.round(((unit_price)* 100) / 100)).toString().replace(/\.+/g, ",") + ' RVX </h6><p id="change_rate_quantity" class="display-none">' + (Math.round(((unit_price) * 100) / 100)).toString() + '</p><p id="change_rate_style" class="display-none">font-size: 14px</p><p id="change_rate_class" class="display-none">text-primary</p><p id="change_rate_extra" class="display-none"> per Pack</p></div>');
    /*
    $('#change-rate_super').append('<div class="row change-rate"><h6 class="mb-0" style="font-size: 16px">' + (Math.round(($('#quantity').val() * unit_price) * 100) / 100).toString().replace(/\.+/g, ",") + ' RVX </h6><div id="change_rate_content"><p id="change_rate_quantity" class="display-none">' + (Math.round(($('#quantity').val() * unit_price) * 100) / 100).toString() + '</p><h6 id="change_rate_text" class="mb-0 text-success" style="font-size: 16px"></h6></div></div>');
    $('#actual-RVX-in-packet').append('<div class="row change-rate" style="width: 100%"><h6 class="mb-0" style="font-size: 14px">' + (Math.round((unit_price * 100) / 100)).toString().replace(/\.+/g, ",") + ' RVX </h6><div id="change_rate_content" class="row col-xxl-8 col-xl-6 col-md-12 col-lg-12 col-12"><p id="change_rate_quantity" class="display-none">' + (Math.round((unit_price * 100) / 100)).toString() + '</p><h6 id="change_rate_text" class="mb-0 text-primary col-xl-6 col-xxl-6 col-md-12 col-lg-5 col-4" style="font-size: 14px"></h6><h6 class="mb-0 text-primary col-xl-4 col-xxl-4 col-md-12 col-lg-5 col-5" style="font-size: 14px"> per Pack</h6></div></div>');
        $('#future-RVX-in-packet').append('<div class="row change-rate" style="width: 100%"><h6 class="mb-0" style="font-size: 14px">' + (Math.round(((unit_price*2)* 100) / 100)).toString().replace(/\.+/g, ",") + ' RVX </h6><div id="change_rate_content" class="row col-xxl-8 col-xl-6 col-md-12 col-lg-12 col-12" style="width: 50%"><p id="change_rate_quantity" class="display-none">' + (Math.round((unit_price * 2 * 100) / 100)).toString() + '</p><h6 id="change_rate_text" class="mb-0 text-primary col-xl-6 col-xxl-6 col-md-12 col-lg-5 col-4" style="font-size: 14px"></h6><h6 class="mb-0 text-primary col-xl-4 col-xxl-4 col-md-12 col-lg-5 col-5" style="font-size: 14px"> per Pack</h6></div></div>');

*/

};


$('#quantity').on('input', function () {
    if (parseFloat($('#quantity').val()) > parseFloat(max_quantity) || (parseFloat($('#quantity').val() * 2).toString() == "NaN" && $('#quantity').val() != "") || $('#quantity').val().toString().includes(".")) {
        $('#quantity').val(last_digit);
    } else {
        last_digit = $('#quantity').val();
        $('.buy-change-rate').remove();
        $('#change-rate_super').append('<div class="row change-rate buy-change-rate"><h6 class="mb-0" style="font-size: 16px">' + (Math.round(($('#quantity').val() * unit_price) * 100) / 100).toString().replace(/\.+/g, ",") + ' RVX </h6><p id="change_rate_quantity" class="display-none">' + (Math.round(($('#quantity').val() * unit_price) * 100) / 100).toString() + '</p><p id="change_rate_style" class="display-none">font-size: 16px</p><p id="change_rate_class" class="display-none">text-success</p><p id="change_rate_extra" class="display-none"></p></div>');
    }
});

function sell_configure(){
    $.ajax({
        url: "../scripts/getPackets.php",
        type: "post",
        data: {},
        async: false,
        success: function (data) {
            data = JSON.parse(data);
            if (data.length == 0) {
                $('#packets_list').append('<option id="packets_option_0" value="">You have no Packets</option>')
            } else {
                for (let i = 0; i < data.length; i++) {
                    if($('#packets_option_' + i).length > 0){
                        $('#packets_option_' + i).remove();
                    }
                    $('#packets_list').append('<option id="packets_option_' + i + '" value="' + data[i]['revox_coins_quantity'] + '">' + data[i]['packets_quantity'] + ' Packets X ' + (Math.round((data[i]['revox_coins_quantity']) * 100) / 100).toString() + ' RVX per Packet</option>')
                }
            }
        }

    });
}

$('#packets_list').on('input', function () {
    unit_price_sell = $("#packets_list option:selected").val();
    var quantity_string = $("#packets_list option:selected").text();
    var re = /([0-9|.]+)/g;
    var m;


    m = re.exec(quantity_string.toString());
    if(m != null){
        quantity_sell_max = m[1].toString();
        $('#quantity_max_sell').text("/" + quantity_sell_max);
        $('#quantity_sell').val(quantity_sell_max);
        last_digit_sell = $('#quantity_sell').val();
        if($('#actual-RVX-in-packet-sell').find('.change-rate').length > 0){
            $('#actual-RVX-in-packet-sell').find('.change-rate').remove();
        }
        if($('#past-RVX-in-packet').find('.change-rate').length > 0){
            $('#past-RVX-in-packet').find('.change-rate').remove();
        }
        if($('#profit-RVX-in-packet').find('.change-rate').length > 0){
            $('#profit-RVX-in-packet').find('.change-rate').remove();
        }
        $('#actual-RVX-in-packet-sell').append('<div class="row change-rate"><h6 class="mb-0" style="font-size: 14px">' + (Math.round((unit_price_sell * 100) / 100)).toString().replace(/\.+/g, ",") + ' RVX </h6><p id="change_rate_quantity" class="display-none">' + (Math.round((unit_price_sell * 100) / 100)).toString() + '</p><p id="change_rate_style" class="display-none">font-size: 14px</p><p id="change_rate_class" class="display-none">text-primary</p><p id="change_rate_extra" class="display-none"> per Pack</p></div>');
        $('#past-RVX-in-packet').append('<div class="row change-rate"><h6 class="mb-0" style="font-size: 14px">' + (Math.round(((unit_price_sell/2)* 100) / 100)).toString().replace(/\.+/g, ",") + ' RVX </h6><p id="change_rate_quantity" class="display-none">' + (Math.round((unit_price_sell / 2 * 100) / 100)).toString() + '</p><p id="change_rate_style" class="display-none">font-size: 14px</p><p id="change_rate_class" class="display-none">text-primary</p><p id="change_rate_extra" class="display-none"> per Pack</p></div>');
        $('#profit-RVX-in-packet').append('<div class="row change-rate"><h6 class="mb-0" style="font-size: 14px">' + (Math.round((((unit_price_sell/2))* 100) / 100)).toString().replace(/\.+/g, ",") + ' RVX </h6><p id="change_rate_quantity" class="display-none">' + (Math.round((((unit_price_sell/2)) * 100) / 100)).toString() + '</p><p id="change_rate_style" class="display-none">font-size: 14px</p><p id="change_rate_class" class="display-none">text-primary</p><p id="change_rate_extra" class="display-none"> per Pack</p></div>');
    }

});

$('#quantity_sell').on('input', function () {
    if (parseFloat($('#quantity_sell').val()) > parseFloat(quantity_sell_max) || (parseFloat($('#quantity_sell').val() * 2).toString() == "NaN" && $('#quantity_sell').val() != "") || $('#quantity_sell').val().toString().includes(".")) {
        $('#quantity_sell').val(last_digit_sell);
    } else {
        last_digit_sell = $('#quantity_sell').val();
    }
});