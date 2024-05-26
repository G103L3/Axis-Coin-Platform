(function ($) {
            getWallet();
            setInterval(function() {getWallet()}, 3000);
            setInterval(function() {printWallet()}, 1000);

})(jQuery);
wallet_counter = 0;
g_data = "";
async function printWallet() {
        printWalletManageList(g_data);
        printWalletManageTitle(g_data);
        printWalletWidget(g_data);
        printWalletHeader(g_data);
        printChartWidget(g_data);
        printChartHeader(g_data);
        printWalletManageChart(g_data);
}
async function getWallet() {
    let next = false;
    if(getBalanceStatus() || wallet_counter == 0){
       await $.ajax({
            url: "../scripts/getWallets.php",
            type: "post",
            data: null,
            contentType: false,
            processData: false,
            async: false,
            success: function (data) {
                g_data = JSON.parse(data);
           }
        });
       await $.ajax({
            url: "../scripts/deleteIdBalance.php",
            async: false,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data){
            }
        });
        if(wallet_counter == 0){
            next = true;
        }
    }
    if(next){
        await wallet_counter++;
    }
}
async function printWalletWidget(data){
    if (data['packets_wallet'] == null) {
        data['packets_wallet'] = "0.000"
    }
    if($('#wallet_widget_content').length > 0){
        $('#wallet_widget_content').remove();
    }
    $('#wallet-widget').each(function () {
        let element = $( this );
        let html = "";
        if(!element.hasClass('loading')){
            html = '<div id="wallet_widget_content"><h4 style="font-size: 19px">Total Balance: <strong class="text-primary">' + (Math.round((parseFloat(data['cash_wallet']) + parseFloat(data['network_wallet']) + (parseFloat(data['packets_wallet']) * getRevoxValue())) * 100) / 100).toString().replace(/\.+/g, ",") + ' USD</strong></h4>\n' +
                '                                                    <ul style="margin-top: 40px" class="list-unstyled">\n' +
                '                                                        <li class="d-flex">\n' +
                '                                                            <i class="las la-money-bill-wave me-3"></i>\n' +
                '                                                            <div class="flex-grow-1">\n' +
                '                                                                <h5 class="m-0">Cash Wallet</h6>\n' +
                '                                                            </div>\n' +
                '                                                            <div class="text-right">\n' +
                '                                                                <h5>' + (Math.round(data['cash_wallet'] * 100) / 100).toString().replace(/\.+/g, ",") + ' USD</h5>\n' +
                '                                                            </div>\n' +
                '                                                        </li>\n' +
                '                                                        <li class="d-flex">\n' +
                '                                                            <i class="las la-users me-3"></i>\n' +
                '                                                            <div class="flex-grow-1">\n' +
                '                                                                <h5 class="m-0">Network Wallet</h6>\n' +
                '                                                            </div>\n' +
                '                                                            <div class="text-right">\n' +
                '                                                                <h5>' + (Math.round(data['network_wallet'] * 100) / 100).toString().replace(/\.+/g, ",") + ' USD</h5>\n' +
                '                                                            </div>\n' +
                '                                                        </li>\n' +
                '                                                        <li class="d-flex">\n' +
                '                                                            <i class="las la-cubes me-3"></i>\n' +
                '                                                            <div class="flex-grow-1">\n' +
                '                                                                <h5 class="m-0">Packets Wallet</h6>\n' +
                '                                                            </div>\n' +
                '                                                            <div class="text-right">\n' +
                '                                                                <h5>' + (Math.round(data['packets_wallet'] * 100) / 100).toString().replace(/\.+/g, ",") + ' RVX</h5>\n' +
                '                                                               <h5 class="text-success">➜ ' + (Math.round((data['packets_wallet'] * getRevoxValue()) * 100) / 100).toString().replace(/\.+/g, ",") + ' USD</h5>\n' +
                '                                                            </div>\n' +
                '                                                        </li>\n' +
                '                                                    </ul></div>';
        }else{
            setTimeout(() => {  element.removeClass('loading') }, 1500);
        }
        element.append(html);
    });
}
async function printChartWidget(data){
    if(data['packets_wallet'] == null){
        data['packets_wallet'] = "0.000"
    }
    if($('#wallet_chart_content').length > 0){
        $('#wallet_chart_content').remove();
    }
    $('#wallet-chart').each(function () {
        let element = $( this );
        let html;
        if(!element.hasClass('loading')){
            let series;
            let total = parseFloat(data['cash_wallet']) + parseFloat(data['network_wallet']) + (parseFloat(data['packets_wallet']) * getRevoxValue());
            if(total != 0){
                series = [(100*parseFloat(data['cash_wallet']))/total, (100*parseFloat(data['network_wallet']))/total, (100*(parseFloat(data['packets_wallet']) * getRevoxValue()))/total];
            }else{
                series = [0, 0, 0];
            }
            var options;
            if(element.hasClass('step-2')){
                options = {
                    series: series,
                    chart: {
                        height: 300,
                        type: 'radialBar',
                        animations: {
                            enabled: false
                        },
                        color: 'var(--chart-bg)',
                    },
                    tooltip: {
                        enabled: true,
                    },
                    plotOptions: {
                        radialBar: {
                            offsetY: 0,
                            startAngle: 0,
                            endAngle: 360,
                            hollow: {
                                margin: 5,
                                size: '20%',
                                background: 'transparent',
                                image: undefined,
                            },
                            track: {
                                background: 'var(--chart-bg)',
                            },
                            dataLabels: {
                                name: {
                                    show: false,
                                },
                                value: {
                                    show: false,
                                }
                            }
                        }
                    },
                    colors: [
                        'rgba(94, 55, 255,1)',
                        'rgba(94, 55, 255,0.7)',
                        'rgba(94, 55, 255,0.3)',
                    ],
                    labels: ['Cash Wallet', 'Network Wallet', 'Packets Wallet'],
                    legend: {
                        show: false,
                        floating: true,
                        fontSize: '16px',
                        position: 'left',
                        offsetX: 160,
                        offsetY: 15,
                        labels: {
                            useSeriesColors: true,
                        },
                        markers: {
                            size: 0
                        },
                        formatter: function (seriesName, opts) {
                            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                        },
                        itemMargin: {
                            vertical: 3
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            legend: {
                                show: false
                            }
                        }
                    }]
                };
            }else{
                options = {
                    series: series,
                    chart: {
                        height: 300,
                        type: 'radialBar',
                    },
                    tooltip: {
                        enabled: true,
                    },
                    plotOptions: {
                        radialBar: {
                            offsetY: 0,
                            startAngle: 0,
                            endAngle: 360,
                            hollow: {
                                margin: 5,
                                size: '20%',
                                background: 'transparent',
                                image: undefined,
                            },
                            track: {
                                background: 'var(--chart-bg)',
                            },
                            dataLabels: {
                                name: {
                                    show: false,
                                },
                                value: {
                                    show: false,
                                }
                            }
                        }
                    },
                    colors: [
                        'rgba(94, 55, 255,1)',
                        'rgba(94, 55, 255,0.7)',
                        'rgba(94, 55, 255,0.3)',
                    ],
                    labels: ['Cash Wallet', 'Network Wallet', 'Packets Wallet'],
                    legend: {
                        show: false,
                        floating: true,
                        fontSize: '16px',
                        position: 'left',
                        offsetX: 160,
                        offsetY: 15,
                        labels: {
                            useSeriesColors: true,
                        },
                        markers: {
                            size: 0
                        },
                        formatter: function (seriesName, opts) {
                            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                        },
                        itemMargin: {
                            vertical: 3
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            legend: {
                                show: false
                            }
                        }
                    }]
                };
                element.removeClass('step-1');
                element.addClass('step-2');
            }
            html = '<div id="wallet_chart_content"></div>';
            element.append(html);
            var chart = new ApexCharts(document.querySelector("#wallet_chart_content"), options);
            chart.render();
        }else{
            setTimeout(() => {  element.removeClass('loading') }, 1500);
        }
    });
}
async function printWalletHeader(data){
    if(data['packets_wallet'] == null){
        data['packets_wallet'] = "0.000"
    }
    if($('#wallet_header_content').length > 0){
        $('#wallet_header_content').remove();
    }
    $('#wallet-header').each(function () {
        let element = $( this );
        let html = "";
        if(!element.hasClass('loading')){
            html = '<div id="wallet_header_content"><h4 style="text-align: start; font-size: 18px"></br>Balance : <strong class="text-primary">' + (Math.round((parseFloat(data['cash_wallet']) + parseFloat(data['network_wallet']) + (parseFloat(data['packets_wallet']) * getRevoxValue())) * 100) / 100).toString().replace(/\.+/g, ",") + ' USD</strong></h4></div>';
        }else{
            setTimeout(() => {  element.removeClass('loading') }, 1500);
        }
        element.append(html);
    });
}
async function printChartHeader(data){
    if(data['packets_wallet'] == null){
        data['packets_wallet'] = "0.000"
    }
    if($('#wallet_header_chart_content').length > 0){
        $('#wallet_header_chart_content').remove();
    }
    $('#header-wallet-chart').each(function () {
        let element = $( this );
        let html;
        if(!element.hasClass('loading')){
            let series;
            let total = parseFloat(data['cash_wallet']) + parseFloat(data['network_wallet']) + (parseFloat(data['packets_wallet']) * getRevoxValue());
            if(total != 0){
                series = [(100*parseFloat(data['cash_wallet']))/total, (100*parseFloat(data['network_wallet']))/total, (100*(parseFloat(data['packets_wallet']) * getRevoxValue()))/total];
            }else{
                series = [0, 0, 0];
            }

            var options;
            if(element.hasClass('step-2')){
                options = {
                    series: series,
                    chart: {
                        height: 120,
                        type: 'radialBar',
                        animations: {
                            enabled: false
                        }
                    },
                    tooltip: {
                        enabled: true,
                    },
                    plotOptions: {
                        radialBar: {
                            offsetY: -5,
                            startAngle: 0,
                            endAngle: 360,
                            hollow: {
                                size: '1%',
                                background: 'transparent',
                                image: undefined,
                            },
                            track: {
                                show: true,
                                startAngle: undefined,
                                endAngle: undefined,
                                strokeWidth: '95%',
                                size: "97%",
                                opacity: 1,
                                margin: 2,
                                dropShadow: {
                                    enabled: false,
                                    top: 0,
                                    left: 0,
                                    blur: 3,
                                    opacity: 0.5
                                },
                                background: 'var(--chart-bg)',
                            },
                            dataLabels: {
                                name: {
                                    show: false,
                                },
                                value: {
                                    show: false,
                                }
                            }
                        }
                    },
                    colors: [
                        'rgba(94, 55, 255,1)',
                        'rgba(94, 55, 255,0.7)',
                        'rgba(94, 55, 255,0.3)',
                    ],
                    labels: ['Cash Wallet', 'Network Wallet', 'Packets Wallet'],
                    legend: {
                        show: false,
                        floating: true,
                        fontSize: '16px',
                        position: 'left',
                        offsetX: 0,
                        offsetY: 3,
                        labels: {
                            useSeriesColors: true,
                        },
                        markers: {
                            size: 0
                        },
                        formatter: function (seriesName, opts) {
                            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                        },
                        itemMargin: {
                            vertical: 5
                        }
                    },
                    responsive: [{
                        breakpoint: 48,
                        options: {
                            legend: {
                                show: false
                            }
                        }
                    }]
                };
            }else{
                options = {
                    series: series,
                    chart: {
                        height: 120,
                        type: 'radialBar',
                    },
                    tooltip: {
                        enabled: true,
                    },
                    plotOptions: {
                        radialBar: {
                            offsetY: -5,
                            startAngle: 0,
                            endAngle: 360,
                            hollow: {
                                size: '1%',
                                background: 'transparent',
                                image: undefined,
                            },
                            track: {
                                show: true,
                                startAngle: undefined,
                                endAngle: undefined,
                                strokeWidth: '95%',
                                size: "97%",
                                opacity: 1,
                                margin: 2,
                                dropShadow: {
                                    enabled: false,
                                    top: 0,
                                    left: 0,
                                    blur: 3,
                                    opacity: 0.5
                                },
                                background: 'var(--chart-bg)',
                            },
                            dataLabels: {
                                name: {
                                    show: false,
                                },
                                value: {
                                    show: false,
                                }
                            }
                        }
                    },
                    colors: [
                        'rgba(94, 55, 255,1)',
                        'rgba(94, 55, 255,0.7)',
                        'rgba(94, 55, 255,0.3)',
                    ],
                    labels: ['Cash Wallet', 'Network Wallet', 'Packets Wallet'],
                    legend: {
                        show: false,
                        floating: true,
                        fontSize: '16px',
                        position: 'left',
                        offsetX: 0,
                        offsetY: 3,
                        labels: {
                            useSeriesColors: true,
                        },
                        markers: {
                            size: 0
                        },
                        formatter: function (seriesName, opts) {
                            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                        },
                        itemMargin: {
                            vertical: 5
                        }
                    },
                    responsive: [{
                        breakpoint: 48,
                        options: {
                            legend: {
                                show: false
                            }
                        }
                    }]
                };
                element.removeClass('step-1');
                element.addClass('step-2');
            }
            html = '<div id="wallet_header_chart_content"></div>';
            element.append(html);
            var chart = new ApexCharts(document.querySelector("#wallet_header_chart_content"), options);
            chart.render();
        }else{
            setTimeout(() => {  element.removeClass('loading') }, 1500);
        }
    });
}
async function printWalletManageList(data){
    if (data['packets_wallet'] == null) {
        data['packets_wallet'] = "0.000"
    }
    if($('#wallet_manage_list_content').length > 0){
        $('#wallet_manage_list_content').remove();
    }
    $('#wallet-manage-list').each(function () {
        let element = $( this );
        let series;
        let total = parseFloat(data['cash_wallet']) + parseFloat(data['network_wallet']) + parseFloat(data['packets_wallet']);
        if(total != 0){
            series = [(100*parseFloat(data['cash_wallet']))/total, (100*parseFloat(data['network_wallet']))/total, (100*parseFloat(data['packets_wallet']))/total];
        }else{
            series = [0, 0, 0];
        }
        let html = "";
        if(!element.hasClass('loading')){
            html = '<div id="wallet_manage_list_content">\n' +
                '                                                    <ul style="margin-top:30px;" class="list-unstyled">\n' +
                '                                                        <div class="widget-card" style="margin-bottom: 18px">\n' +
                '                                                           <div class="widget-title">\n' +
                '                                                               <h5><i class="las la-money-bill-wave me-3 la-2x"></i>Cash Wallet</h5>\n' +
                '                                                               <p class="text-primary">' + (Math.round(series[0] * 100) / 100).toString().replace(/\.+/g, ",") + '%/Total</p>\n' +
                '                                                           </div>\n' +
                '                                                           <div class="widget-info" >\n' +
                '                                                               <h3>' + (Math.round(data['cash_wallet'] * 100) / 100).toString().replace(/\.+/g, ",") + '</h3>\n' +
                '                                                               <p>USD</p>\n' +
                '                                                           </div>\n' +
                '                                                        </div>' +
                '                                                        <div class="widget-card"style="margin-bottom: 18px">\n' +
                '                                                           <div class="widget-title">\n' +
                '                                                               <h5><i class="las la-users me-3 la-2x"></i>Network Wallet</h5>\n' +
                '                                                               <p class="text-primary">' + (Math.round(series[1] * 100) / 100).toString().replace(/\.+/g, ",") + '%/Total</p>\n' +
                '                                                           </div>\n' +
                '                                                           <div class="widget-info">\n' +
                '                                                               <h3>' + (Math.round(data['network_wallet'] * 100) / 100).toString().replace(/\.+/g, ",") + '</h3>\n' +
                '                                                               <p>USD</p>\n' +
                '                                                           </div>\n' +
                '                                                        </div>' +
                '                                                        <div class="widget-card" style="margin-bottom: 18px">\n' +
                '                                                           <div class="widget-title">\n' +
                '                                                               <h5><i class="las la-cubes me-3 la-2x"></i>Packets Wallet</h5>\n' +
                '                                                               <p class="text-primary">' + (Math.round(series[2] * 100) / 100).toString().replace(/\.+/g, ",") + '%/Total</p>\n' +
                '                                                           </div>\n' +
                '                                                           <div class="text-left">\n' +
                '                                                               <h3>' + (Math.round(data['packets_wallet'] * 100) / 100).toString().replace(/\.+/g, ",") + ' RVX</h3>\n' +
                '                                                               <h5 class="text-success">➜ ' + (Math.round((data['packets_wallet'] * getRevoxValue()) * 100) / 100).toString().replace(/\.+/g, ",") + ' USD</h5>\n' +
                '                                                           </div>\n' +
                '                                                        </div>' +
                '                                                    </ul></div>';
        }else{
            setTimeout(() => {  element.removeClass('loading') }, 1500);
        }
        element.append(html);
    });
}
async function printWalletManageTitle(data){
    if (data['packets_wallet'] == null) {
        data['packets_wallet'] = "0.000"
    }
    if($('#wallet_manage_title_content').length > 0){
        $('#wallet_manage_title_content').remove();
    }
    $('#wallet-manage-title').each(function () {
        let element = $( this );
        let html = "";
        if(!element.hasClass('loading')){
            html = '<div id="wallet_manage_title_content" style="margin-top: 0px;"><h4 style="float: left; text-align: left; font-size: 21px; ">Total Balance: <br><strong class="text-primary">' + (Math.round((parseFloat(data['cash_wallet']) + parseFloat(data['network_wallet']) + parseFloat(data['packets_wallet'])) * 100) / 100).toString().replace(/\.+/g, ",") + ' USD</strong></h4></div>';
        }else{
            setTimeout(() => {  element.removeClass('loading') }, 1500);
        }
        element.append(html);
    });
}
async function printWalletManageChart(data){
    if(data['packets_wallet'] == null){
        data['packets_wallet'] = "0.000"
    }
    if($('#wallet_manage_chart_content').length > 0){
        $('#wallet_manage_chart_content').remove();
    }
    $('#wallet-manage-chart').each(function () {
        let element = $( this );
        let html;
        if(!element.hasClass('loading')){
            let series;
            let total = parseFloat(data['cash_wallet']) + parseFloat(data['network_wallet']) + (parseFloat(data['packets_wallet']) * getRevoxValue());
            if(total != 0){
                series = [(100*parseFloat(data['cash_wallet']))/total, (100*parseFloat(data['network_wallet']))/total, (100*(parseFloat(data['packets_wallet']) * getRevoxValue()))/total];
            }else{
                series = [0, 0, 0];
            }

            var options;
            if(element.hasClass('step-2')){
                options = {
                    series: series,
                    chart: {
                        height: 120,
                        type: 'radialBar',
                        animations: {
                            enabled: false
                        }
                    },
                    tooltip: {
                        enabled: true,
                    },
                    plotOptions: {
                        radialBar: {
                            offsetY: -5,
                            startAngle: 0,
                            endAngle: 360,
                            hollow: {
                                size: '1%',
                                background: 'transparent',
                                image: undefined,
                            },
                            track: {
                                show: true,
                                startAngle: undefined,
                                endAngle: undefined,
                                strokeWidth: '95%',
                                size: "97%",
                                opacity: 1,
                                margin: 2,
                                dropShadow: {
                                    enabled: false,
                                    top: 0,
                                    left: 0,
                                    blur: 3,
                                    opacity: 0.5
                                },
                                background: 'var(--chart-bg)',
                            },
                            dataLabels: {
                                name: {
                                    show: false,
                                },
                                value: {
                                    show: false,
                                }
                            }
                        }
                    },
                    colors: [
                        'rgba(94, 55, 255,1)',
                        'rgba(94, 55, 255,0.7)',
                        'rgba(94, 55, 255,0.3)',
                    ],
                    labels: ['Cash Wallet', 'Network Wallet', 'Packets Wallet'],
                    legend: {
                        show: false,
                        floating: true,
                        fontSize: '16px',
                        position: 'left',
                        offsetX: 0,
                        offsetY: 3,
                        labels: {
                            useSeriesColors: true,
                        },
                        markers: {
                            size: 0
                        },
                        formatter: function (seriesName, opts) {
                            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                        },
                        itemMargin: {
                            vertical: 5
                        }
                    },
                    responsive: [{
                        breakpoint: 48,
                        options: {
                            legend: {
                                show: false
                            }
                        }
                    }]
                };
            }else{
                options = {
                    series: series,
                    chart: {
                        height: 120,
                        type: 'radialBar',
                    },
                    tooltip: {
                        enabled: true,
                    },
                    plotOptions: {
                        radialBar: {
                            offsetY: -5,
                            startAngle: 0,
                            endAngle: 360,
                            hollow: {
                                size: '1%',
                                background: 'transparent',
                                image: undefined,
                            },
                            track: {
                                show: true,
                                startAngle: undefined,
                                endAngle: undefined,
                                strokeWidth: '95%',
                                size: "97%",
                                opacity: 1,
                                margin: 2,
                                dropShadow: {
                                    enabled: false,
                                    top: 0,
                                    left: 0,
                                    blur: 3,
                                    opacity: 0.5
                                },
                                background: 'var(--chart-bg)',
                            },
                            dataLabels: {
                                name: {
                                    show: false,
                                },
                                value: {
                                    show: false,
                                }
                            }
                        }
                    },
                    colors: [
                        'rgba(94, 55, 255,1)',
                        'rgba(94, 55, 255,0.7)',
                        'rgba(94, 55, 255,0.3)',
                    ],
                    labels: ['Cash Wallet', 'Network Wallet', 'Packets Wallet'],
                    legend: {
                        show: false,
                        floating: true,
                        fontSize: '16px',
                        position: 'left',
                        offsetX: 0,
                        offsetY: 3,
                        labels: {
                            useSeriesColors: true,
                        },
                        markers: {
                            size: 0
                        },
                        formatter: function (seriesName, opts) {
                            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                        },
                        itemMargin: {
                            vertical: 5
                        }
                    },
                    responsive: [{
                        breakpoint: 48,
                        options: {
                            legend: {
                                show: false
                            }
                        }
                    }]
                };
                element.removeClass('step-1');
                element.addClass('step-2');
            }
            html = '<div id="wallet_manage_chart_content"></div>';
            element.append(html);
            var chart = new ApexCharts(document.querySelector("#wallet_manage_chart_content"), options);
            chart.render();
        }else{
            setTimeout(() => {  element.removeClass('loading') }, 1500);
        }
    });
}