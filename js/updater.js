(function ($) {
    $.ajax({
        url: "../scripts/getId.php",
        async: false,
        success: function (data){
            data = JSON.parse(data);
            update(data['id']);
            fast_update(data['id']);
            setInterval(function() {update(data['id'])}, 5000);
            setInterval(function() {fast_update(data['id'])}, 1000);
        },

    });

})(jQuery);
balance_status = false
personal_transactions_status = false
offers = null
transactions_chart = null
revox_value = 0
async function update(target_id) {
    $.ajax({
        url: "../real_time/" + target_id + "_balance",
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function (data){
            balance_status = true;
        },
        error: function()
        {
            balance_status = false;
        },
    });
    $.ajax({
        url: "../real_time/" + target_id + "_personal_transactions",
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function (data){
            personal_transactions_status = true;
        },
        error: function()
        {
            personal_transactions_status = false;
        },
    });
    $.ajax({
        url: "../real_time/offers",
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function (data){
            offers = JSON.parse(data);
            for(let i = 0; i < offers.length; i++){
                if(offers[i]['seller_id'].toString() == target_id.toString()){
                    offers[i]['type'] = 'own';
                }
            }
        },
        error: function()
        {
            offers = false;
        },
    });
    $.ajax({
        url: "../real_time/transactions_chart",
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function (data){
            transactions_chart = JSON.parse(data);
        },
        error: function()
        {
            transactions_chart = false;
        },
    });
}
async function fast_update(target_id) {
    $.ajax({
        url: "../real_time/revox_value.txt",
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function (data){
            revox_value = data;
        },
        error: function()
        {
            revox_value = false;
        },
    });
}

function getBalanceStatus(){
    return balance_status;
}
function getPersonalTransactionsStatus(){
    return personal_transactions_status;
}
function getOffers(){
    return offers;
}
function getTransactionsChart(){
    return transactions_chart;
}
function getRevoxValue(){
    return revox_value;
}