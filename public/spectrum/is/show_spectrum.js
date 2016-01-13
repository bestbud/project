//highchart图表显示
$(function () {
    $(document).ready(function () {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        $('#container').highcharts({
             credits: {
                enabled:false // 禁用版权信息
            },
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                // events: {
                //     load: function () {

                //         // set up the updating of the chart each second
                //         var series = this.series[0];
                //         setInterval(function () {
                //             var x = (new Date()).getTime(), // current time
                //                 y = Math.random();
                //             series.addPoint([x, y], true, true);
                //         }, 1000);
                //     }
                // }
            },
            title: {
                text: '频谱图'
            },
            xAxis: {
                title: {
                    text: '频率(Mhz)'
                },
                min:2399.5,
                max:2400.5
            },
            yAxis: {
                title: {
                    text: '(DB)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                         +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: '频谱',
                data: (function() {
                    var data = [], 
                        getdata,
                        i;

                        $.get("../get_data.php",function(data,status){
                            alert("Data: " + data + "\nStatus: " + status);

                        });

                    for (i =0; i <nfft; i += 1) {
                        data.push({
                            x: f0-(bw/2)+i*(bw/nfft),
                            y: parseFloat(data_spectrum[i])
                        });
                    }
                    return data;
                }())
            }]
        });
    });
});