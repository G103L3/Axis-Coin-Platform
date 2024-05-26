(function ($) {
    getRevoxData();
    setInterval(function() {getRevoxData()}, 1000);
    setInterval(function() {printQuotes()}, 500);
})(jQuery);
quotes_data = "";
async function printQuotes() {
    printChangeRateWidget(quotes_data);
}
async function getRevoxData() {
    quotes_data = getRevoxValue();
}
async function printChangeRateWidget(data){
    $('.change-rate').each(function () {
        let element = $(this);
        let change_rate_quantity = $(this).find('#change_rate_quantity').text();
        let change_rate_style = $(this).find('#change_rate_style').text();
        let change_rate_class = $(this).find('#change_rate_class').text();
        let change_rate_extra = $(this).find('#change_rate_extra').text();

        if (change_rate_quantity != null && change_rate_quantity != undefined) {
            if($(this).find('#change_rate_content').length > 0){
                $(this).find('#change_rate_content').remove();
            }
            $(this).append('<div id="change_rate_content"><h6 id="change_rate_text" class="mb-0 ' + change_rate_class + '" style="' + change_rate_style + '">➜ ' + (Math.round((parseFloat(change_rate_quantity * getRevoxValue() )) * 10000) / 10000).toString().replace(/\.+/g, ",") + ' USD ' + change_rate_extra + '</h6></div>')
        }

    });
}
async function printRevoxValueWidget(data){
    $('#revox-value-widget').each(function () {

        let element = $(this);
        let change_rate_quantity = $(this).find('#change_rate_quantity').text();

        var re = /([0-9|.]+)/g;
        var m;
        m = re.exec(change_rate_quantity.toString());
        if(m != null) {
            change_rate_quantity = m[1].toString();
        }

        let change_rate_text = $(this).find('#change_rate_text');

        if (change_rate_quantity != null && change_rate_quantity != undefined && change_rate_text.length > 0) {
            change_rate_text.text('➜ ' + (Math.round((parseFloat(change_rate_quantity * getRevoxValue() )) * 100) / 100).toString().replace(/\\.+/g, ",") + ' USD');
        }

    });
}
