(function ($) {
    var options = {
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
            data: generateDayWiseTimeSeries('buy'),
        }, {
            name: 'Sell',
            data: generateDayWiseTimeSeries('sell'),
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

    var chart = new ApexCharts(
        document.querySelector("#timeline-chart"),
        options
    );

    chart.render();

    var resetCssClasses = function (activeEl) {
        var els = document.querySelectorAll("button");
        Array.prototype.forEach.call(els, function (el) {
            el.classList.remove('active');
        });

        activeEl.target.classList.add('active')
    }

    document.querySelector("#one_month").addEventListener('click', function (e) {
        resetCssClasses(e)
        chart.updateOptions({
            xaxis: {
                min: new Date('20 Nov 2018').getTime(),
                max: new Date('19 Dec 2018').getTime(),
            }
        })
    })

    document.querySelector("#six_months").addEventListener('click', function (e) {
        resetCssClasses(e)
        chart.updateOptions({
            xaxis: {
                min: new Date('20 Nov 2018').getTime(),
                max: new Date('19 May 2019').getTime(),
            }
        })
    })

    document.querySelector("#one_year").addEventListener('click', function (e) {
        resetCssClasses(e)
        chart.updateOptions({
            xaxis: {
                min: new Date('20 Nov 2018').getTime(),
                max: new Date('19 Nov 2019').getTime(),
            }
        })
    })

    document.querySelector("#ytd").addEventListener('click', function (e) {
        resetCssClasses(e)
        chart.updateOptions({
            xaxis: {
                min: new Date('20 Nov 2018').getTime(),
                max: new Date('19 Jan 2019').getTime(),
            }
        })
    })

    document.querySelector("#all").addEventListener('click', function (e) {
        resetCssClasses(e)
        chart.updateOptions({
            xaxis: {
                min: undefined,
                max: undefined,
            }
        })
    })

    document.querySelector("#ytd").addEventListener('click', function () {

    })


    function generateDayWiseTimeSeries(type) {
        var series = [];
        $.ajax({
            url: "../../scripts/getTransactionsChart.php",
            type: "post",
            data: {mode: type},
            async: false,
            success: function(data){
                data = JSON.parse(data);
                for (let i = 0; i < data.length; i++) {
                    var date = new Date(data[i]['datetime']);
                    var milliseconds_date = date.getTime();
                    series.push([milliseconds_date, data[i]['s_amount']]);
                }
            }
        })
        return series;
    }


})(jQuery);