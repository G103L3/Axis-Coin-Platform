(function ($) {
    getOffersData();
    setInterval(function() {getOffersData()}, 3000);
    setInterval(function() {printOffers()}, 1000);
})(jQuery);
offers_data = "";
transactions_chart_data = "";
async function printOffers() {
    printOffersChartWidget(transactions_chart_data);
    printOffersWidget(offers_data);
}
async function getOffersData() {
    offers_data = getOffers();
    transactions_chart_data = getTransactionsChart();
}
async function printOffersWidget(data){
    if($('#transaction-buy-card_content').length > 0){
        $('#transaction-buy-card_content').remove();
    }
    $('#transaction-buy-card').each(function () {
        let element = $(this);
        let html = "";
        if(!element.hasClass('loading')) {
            element.append('<div id="transaction-buy-card_content">');
            if (data.length == 0) {
                html = '<div class="row table-div" style="padding-bottom: 20px;" id="table_element">' +
                '<div class="col-xl-12 col-xxl-12 col-md-12 col-12" style="line-height: 50px; text-align: center; ">There are nothing to buy yet </div><a href="#sell" class="btn btn-success mt-0 btm-sm text-white">Be the first to sell</a>' +
                '</div>';
            }
            for (let i = 0; i < data.length; i++) {
                html = '<div class="row table-div" id="table_element' + i + '" style="padding:3px;">' +
                       '<div class="col-xl-3 col-xxl-5 col-md-3 col-lg-5 col-5" style="line-height: 30px; text-align: left; font-size: 12px;">\n' +
                    '<i class="las la-cubes la-2x"></i> : ' +
                    '' + (Math.round(data[i]['packets_quantity'] * 100) / 100).toString().replace(/\.+/g, ",") + ' Packets\n' +
                    '                                                        </div>\n' +
                    '                          <div class="col-xl-6 col-xxl-7 col-md-5 col-lg-4 col-7" style="line-height: 30px; text-align: left; font-size: 12px;">\n' +
                    '<div class="row change-rate"><i class="cc BTC" style="width: 20px; height: 20px; font-size: 20px; margin-top: -3.2px; margin-right: 2px;"></i> :  ' + (Math.round(data[i]['revox_coins_quantity'] * 100) / 100).toString().replace(/\.+/g, ",") + ' RVX <p id="change_rate_quantity" class="display-none">' + (Math.round(data[i]['revox_coins_quantity'] * 100) / 100).toString() + '</p><p id="change_rate_style" class="display-none">line-height: 30px; text-align: left; font-size: 12px;</p><p id="change_rate_class" class="display-none">text-primary</p><p id="change_rate_extra" class="display-none"> per Pack</p></div>' +
                    '                                                        </div>';
                if(data[i]['type'] == "buy"){
                    html +=
                        '                                                        <div class="col-xl-3 col-xxl-12 col-md-4 col-lg-3 col-12" style="line-height: 30px; text-align: center; font-size: 12px;">\n' +
                        '                                                            <a href="#buy-2" onclick="buy_click(\'' + data[i]['id'] + '\', \'' + data[i]['packets_quantity'] + '\', \'' + data[i]['seller_id'] + '\')" data-toggle="tab" class="btn btn-success mt-0 btm-sm text-white" style="height: 25px; padding: 0px;">Buy</a>' +
                        '                                                        </div>';

                }else{
                    if(data[i]['type'] == "own"){
                        html +=
                            '                                                        <div class="col-xl-3 col-xxl-12 col-md-4 col-lg-3 col-12" style="line-height: 30px; text-align: center; font-size: 12px;">\n' +
                            '                                                            <a href="#buy-2" onclick="buy_click(\'' + data[i]['id'] + '\', \'' + data[i]['packets_quantity'] + '\', \'' + data[i]['seller_id'] + '\')" data-toggle="tab" class="btn btn-primary mt-0 btm-sm text-white" style="height: 25px; padding: 0px;">Rebuy</a>' +
                            '                                                        </div>';

                    }
                }


                html += '</div>';
            }
            $('#transaction-buy-card_content').append(html);
            element.append('</div>');
            $('#buy-sell_card').addClass('card');
            $('#buy_button').removeClass('display-none');
            $('#sell_button').removeClass('display-none');
            $('#buy_extra_text').removeClass('display-none');

        }else{
            $('#buy-sell_card').removeClass('card');
            $('#buy_button').addClass('display-none');
            $('#sell_button').addClass('display-none');
            $('#buy_extra_text').addClass('display-none');
            setTimeout(() => {  element.removeClass('loading') }, 1500);
        }
    });
}
offers_chart_last_data = "";
async function printOffersChartWidget(data){
    $('#offers-chart').each(function () {
        let element = $( this );
        if(JSON.stringify(data) != JSON.stringify(offers_chart_last_data) || element.hasClass('loading') || element.hasClass('step-1')) {
            if ($('#offers_chart_content').length > 0) {
                $('#offers_chart_content').remove();
            }
        }
        if ($('#offers_details_content').length > 0) {
            $('#offers_details_content').remove();
        }
        let html;
        if(!element.hasClass('loading')){
            var options;
            if(element.hasClass('step-2')){
                if(JSON.stringify(data) != JSON.stringify(offers_chart_last_data)){
                    options = {
                        chart: {
                            type: "area",
                            height: 300,
                            foreColor:  'var(--text-02)',
                            fontFamily: 'Rubik, sans-serif',
                            stacked: false,
                            dropShadow: {
                                enabled: true,
                                enabledSeries: [0],
                                top: -2,
                                left: 2,
                                blur: 5,
                                opacity: 0.06
                            },
                            toolbar: {
                                show: false,
                            },
                            animations: {
                                enabled: false,
                            }
                        },
                        colors: ['#3de50d', '#65b0e5'],
                        stroke: {
                            curve: "smooth",
                            width: 3
                        },
                        dataLabels: {
                            enabled: false
                        },
                        series: [{
                            name: 'Buy',
                            data: generateDayWiseTimeSeries(data[0]),
                        }, {
                            name: 'Sell',
                            data: generateDayWiseTimeSeries(data[1]),
                        }],
                        markers: {
                            size: 0,
                            strokeColor: "#fff",
                            strokeWidth: 3,
                            strokeOpacity: 1,
                            fillOpacity: 1,
                            hover: {
                                size: 6
                            }
                        },
                        xaxis: {
                            type: "datetime",
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            }
                        },
                        yaxis: {
                            labels: {
                                offsetX: -10,
                                offsetY: 0
                            },
                            tooltip: {
                                enabled: true,
                            }
                        },
                        grid: {
                            show: false,
                            padding: {
                                left: -5,
                                right: 5
                            }
                        },
                        tooltip: {
                            x: {
                                format: "dd MMM yyyy"
                            },
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'left'
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.5,
                                opacityTo: 0,
                                stops: [0, 100, 100]
                            }
                        },
                    };
                    offers_chart_last_data = data;
                }
            }else{
                options = {
                    chart: {
                        type: "area",
                        height: 300,
                        foreColor: "#8C87C2",
                        fontFamily: 'Rubik, sans-serif',
                        stacked: false,
                        dropShadow: {
                            enabled: true,
                            enabledSeries: [0],
                            top: -2,
                            left: 2,
                            blur: 5,
                            opacity: 0.06
                        },
                        toolbar: {
                            show: false,
                        }
                    },
                    colors: ['#3de50d', '#65b0e5'],
                    stroke: {
                        curve: "smooth",
                        width: 3
                    },
                    dataLabels: {
                        enabled: false
                    },
                    series: [{
                        name: 'Buy',
                        data: generateDayWiseTimeSeries(data[0]),
                    }, {
                        name: 'Sell',
                        data: generateDayWiseTimeSeries(data[1]),
                    }],
                    markers: {
                        size: 0,
                        strokeColor: "#fff",
                        strokeWidth: 3,
                        strokeOpacity: 1,
                        fillOpacity: 1,
                        hover: {
                            size: 6
                        }
                    },
                    xaxis: {
                        type: "datetime",
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    yaxis: {
                        labels: {
                            offsetX: -10,
                            offsetY: 0
                        },
                        tooltip: {
                            enabled: true,
                        }
                    },
                    grid: {
                        show: false,
                        padding: {
                            left: -5,
                            right: 5
                        }
                    },
                    tooltip: {
                        x: {
                            format: "dd MMM yyyy"
                        },
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'left'
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.5,
                            opacityTo: 0,
                            stops: [0, 100, 100]
                        }
                    },
                };
                element.removeClass('step-1');
                element.addClass('step-2');
            }
            html = '<div id="offers_chart_content"></div>';
            html += '<div id="offers_details_content"><div class="chart-content text-center">\n' +
                '                        <div class="row">\n' +
                '                            <div class="col-xl-4 col-sm-6 col-6">\n' +
                '                                <div class="chart-stat">\n' +
                '                                    <p class="mb-1">Circulating</p>\n' +
                '                                    <strong>' + (Math.round((data[3][0]['circulating']) * 100) / 100).toString() + ' RVX</strong>\n' +
                '                                       <p style="color: #5dafe8">Total amount of RVX for sale</p>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <div class="col-xl-4 col-sm-6 col-6">\n' +
                '                                <div class="chart-stat">\n' +
                '                                    <p class="mb-1">All Time High Sell</p>\n' +
                '                                    <strong>' + (Math.round((data[2][0]['max_amount']) * 100) / 100).toString() + ' RVX</strong>\n' +
                '                                       <p style="color: #5dafe8">#1 Quantity of RVX per pack ever sold</p>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <div class="col-xl-4 col-sm-6 col-6">\n' +
                '                                <div class="chart-stat">\n' +
                '                                    <p class="mb-1">Popularity</p>\n' +
                '                                    <strong>' + (Math.round((data[4][0]['mode']) * 100) / 100).toString() + ' RVX</strong>' +
                '                                       <p style="color: #5dafe8">#1 Best-selling amount of RVX per pack</p>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div></div>';
            element.append(html);
            var chart = new ApexCharts(document.querySelector("#offers_chart_content"), options);
            chart.render();
        }else{
            setTimeout(() => {  element.removeClass('loading') }, 1500);
        }
    });
}

function generateDayWiseTimeSeries(data) {
    let series = [];
            for (let i = 0; i < data.length; i++) {
                var date = new Date(data[i]['datetime']);
                var milliseconds_date = date.getTime();
                series.push([milliseconds_date, data[i]['revox_coins_quantity']]);
            }
    return series;
}