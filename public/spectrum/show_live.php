<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>频谱显示</title>
    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" >
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css" >
    <link rel="shortcut icon" href="../img/icon.png">

    <style type="text/css">
      body {background-image:url(#);background-repeat:no-repeat; background-attachment:fixed;}
      .block{margin:20%;
             padding:15;
             padding-left: 30%;
            }
    </style>
</head>
<body>
<br>
<br>
<br>
<div class="row-fluid">
    <div class="col-md-2">
        <ul calss="nav" style="margin-left:%">
            <li class="active"><a href="../index.php"><span class="glyphicon glyphicon-home">首页</span></a></li>
            <li><a href="../user_info.php"><span class="glyphicon glyphicon-leaf">个人资料</span><br></a></li>
            <li><a href="../user_info_edit.php"><span class="glyphicon glyphicon-pencil">编辑资料</span></a><br><hr></li>
            <li><a href="show_live.php"><span class="glyphicon glyphicon-stats">查看频谱</span></a><br></li>
            <li><a href="../device_location.php"><span class="glyphicon glyphicon-map-marker">检测位置</span><br></a></li>
        </ul>
    </div>
    <div class="col-md-7" style="border-left:solid gray;border-width:thin">
        <h3>参数设置</h3><hr>
        <div style="padding-left: 10%;">
           <form class="form-inline" method="post">
              <div class="form-group">
                <label class="control-label">中心频率</label>
                <input type="number" value="2400"class="form-control" id="sub_f0" name="sub_f0">MHz，
              </div><br>
              <div class="form-group">
                <label class="control-label">带&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;宽</label>
                <input type="number" value="1000000"class="form-control" id="sub_bw" name="sub_bw">Hz，
              </div><br>
              <div class="form-group">
                <label class="control-label">采样点数</label>
                <input type="number" value="128"class="form-control" id="sub_nfft" name="sub_nfft">
              </div><br>
              <button type="submit" class="btn btn-default"onclick="">确定</button>
             <br><br>
                <!-- <input type="button" id="button"value="105" onclick="getdata(this.value)"> -->
            </form> 
        </div>
        
        <!-- <p>检测点位置显示：</p>
        <div id="divMap" style="width:100%;height:300px;border:solid 1px gray"></div> -->
        <h3>频谱图显示</h3><hr>
        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto">  
        </div>

        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <td>create_time</td>
                <td>f0</td>
                <td>bw</td>
                <td>g</td>
                <td>nfft</td>
            </tr>
            <tr>
                <td id="create_time"></td>
                <td id="f0"></td>
                <td id="bw"></td>
                <td id="g"></td>
                <td id="nfft"></td>
            </tr>
            </table>
            <br>
            <br>
            <br>
        </div>
    </div>
    <div class="col-md-3" style="border-left:solid gray;border-width:thin">
        <div>
            <p><b>状态显示：</b></p>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="col-md-12">
       <?php
        echo "<hr>";
        echo "<p><center>Copyright © 2015-" . date("Y") . " Song</p></center>";
        ?>
    </div>
</div>
</body>

<!-- 频谱图显示 -->
    <script src="../../lib/highcharts/js/jquery-1.11.3.js"></script>
    <script src="../../lib/highcharts/js/highcharts.js"></script> 
    <script src="../../lib/highcharts/js/modules/exporting.js"></script>
   
    <!--  <script src="js/show_spectrum.js"></script> -->
    <script>
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
                events: {
                    load: function () {
                        function drew_spectrum(){
                            htmlobj=$.ajax({
                                url: 'get_data_string.php',
                                type: 'GET',
                                dataType: 'JSON',
                                data: {sid: 105},
                            })
                            .done(function(data) {//将从服务器接收的Jason数据在图中显示出来
                                console.log("success");
                               // console.log(data);

                            var chart = $('#container').highcharts();
                            var showdata=[],
                                f0=data.f0,
                                bw=data.bw/1000000,
                                nfft=data.nfft,
                                sdata=data.data,
                                create_time=data.create_time,
                                g=data.g;
                                // console.log(f0);
                                // console.log(bw);
                                // console.log(nfft);
                                // console.log(sdata);

                                for (i =0; i <nfft; i += 1) {
                                    showdata.push({
                                        x: f0-(bw/2)+i*(bw/nfft),
                                        y: sdata[i]
                                    });
                                }
                            chart.series[0].setData(showdata);

                            $("#f0").html(f0);//设置表格中值
                            $("#bw").html(bw);
                            $("#nfft").html(nfft);
                            //$("#data").html(sdata);
                            $("#create_time").html(create_time);
                            $("#g").html(g);
                            })
                            .fail(function() {
                                console.log("error");
                            })
                            .always(function() {
                                console.log("complete");
                            });
                        }

                        drew_spectrum();//画图

                        setInterval(drew_spectrum, 15000);//每隔15秒刷新图一次
                    }
                }
            },
            title: {
                text: '频谱图'
            },
            xAxis: {
                title: {
                    text: '频率(Mhz)'
                },
                // min:2399.5,
                // max:2400.5
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
                        Highcharts.numberFormat(this.y, 2)+'DB';
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'v',
                data: []
            }]
        });
        $('#button').click(function () {
            // chart.series[0].setData([129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4, 29.9, 71.5, 106.4]);
            htmlobj=$.ajax({
                url: 'get_data_string.php',
                type: 'GET',
                dataType: 'JSON',
                data: {sid: 105},
            })
            .done(function(data) {//将从服务器接收的Jason数据在图中显示出来
                console.log("success");
               // console.log(data);

            var chart = $('#container').highcharts();
            var showdata=[];
                for (i =0; i <data.length; i += 1) {
                    showdata.push({
                        x: 2400-(1/2)+i*(1/data.length),
                        y: data[i]
                    });
                }
            chart.series[0].setData(showdata);
                // console.log(showdata);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });
    });//end of ready 
});    
</script>
    
</html>