(function ($) {

    // BTC Line Chart

    var options = {
        chart: {
            height: 100,
            type: 'line',
            zoom: {
                enabled: false
            },

            toolbar: {
                show: false,
            }
        },
        series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 80, 10, 41, 35, 51, 49, 62, 69, 91, 80]
        }],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: ["#7391FF"],
        },
        grid: {
            show: false,
        },
        tooltip: {
            enabled: false,
            x: {
                format: "dd MMM yyyy"
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            axisBorder: {
                show: false
            },

            labels: {
                show: false
            }
        },
    }

    var chart = new ApexCharts(
        document.querySelector("#btcChart"),
        options
    );
    chart.render();

    // BTC Line Chart

    var options = {
        chart: {
            height: 100,
            type: 'line',
            zoom: {
                enabled: false
            },

            toolbar: {
                show: false,
            }
        },
        series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 80, 10, 41, 35, 51, 49, 62, 69, 91, 80]
        }],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: ["#7391FF"],
        },
        grid: {
            show: false,
        },
        tooltip: {
            enabled: false,
            x: {
                format: "dd MMM yyyy"
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            axisBorder: {
                show: false
            },

            labels: {
                show: false
            }
        },
    }

    var chart = new ApexCharts(
        document.querySelector("#ltcChart"),
        options
    );
    chart.render();

    // BTC Line Chart

    var options = {
        chart: {
            height: 100,
            type: 'line',
            zoom: {
                enabled: false
            },

            toolbar: {
                show: false,
            }
        },
        series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 80, 10, 41, 35, 51, 49, 62, 69, 91, 80]
        }],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: ["#7391FF"],
        },
        grid: {
            show: false,
        },
        tooltip: {
            enabled: false,
            x: {
                format: "dd MMM yyyy"
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            axisBorder: {
                show: false
            },

            labels: {
                show: false
            }
        },
    }

    var chart = new ApexCharts(
        document.querySelector("#xrpChart"),
        options
    );
    chart.render();

    // BTC Line Chart

    var options = {
        chart: {
            height: 100,
            type: 'line',
            zoom: {
                enabled: false
            },

            toolbar: {
                show: false,
            }
        },
        series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 80, 10, 41, 35, 51, 49, 62, 69, 91, 80]
        }],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: ["#7391FF"],
        },
        grid: {
            show: false,
        },
        tooltip: {
            enabled: false,
            x: {
                format: "dd MMM yyyy"
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            axisBorder: {
                show: false
            },

            labels: {
                show: false
            }
        },
    }

    var chart = new ApexCharts(
        document.querySelector("#dashChart"),
        options
    );
    chart.render();




})(jQuery);