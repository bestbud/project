<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>

	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" >
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/icon.png">

	<style type="text/css">
      body {background-image:url(#);background-repeat:no-repeat; background-attachment:fixed;}
      .block{margin:20%;
      	     padding:15;
      	     padding-left: 30%;
            }
    
    </style>


</head>


<body>
<div class="header">
	<div class="row-fluid">
		<div class="col-md-12 header" style="background-color:#6A5ACD">
			<br>
			<img src="img/xiaohui.png"  width="50px" height="50px"alt="东南大学校徽" >
			<span class="lead text-center" style="font-size:28px;color:white"><strong>频谱监测项目</strong></span>
		
				<a class="btn btn-default btn-lg pull-right" href="login.php" role="button" style="margin-left:20px;margin-right:80px">登录</a>
				<a class="btn btn-default btn-lg pull-right" href="register.php" role="button">注册</a><br><br>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="col-md-1">
	</div>
	<div class="col-md-10">
		<br>
		<div id="divMap" style="width:100%;height:480px;border:solid 1px white"></div>	
	</div>
	<div class="col-md-1">
	</div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
<script type="text/javascript">

	var map1 = new BMap.Map("divMap");            // 创建Map实例
    var point1 = new BMap.Point(118.8278010000,31.8755870000); //无线谷经纬度坐标
    var point2=new BMap.Point(118.8255370000,31.8926350000); //东大九龙湖图书馆
    var point3=new BMap.Point(118.8002230000,32.0617390000);//四牌楼校区
    map1.centerAndZoom(point1,13);  
    // map1.centerAndZoom("南京",15);      // 初始化地图,用城市名设置地图中心点             
    map1.enableScrollWheelZoom();  
    map1.addControl(new BMap.NavigationControl());           //添加控件    
                //启用滚轮放大缩小



    var marker=[],point;
    for (var i = 0; i < 20; i++) {
        point= new BMap.Point(90+Math.random()*30,23+Math.random()*20);
        marker[i]=new BMap.Marker(point); //创建标注
        map1.addOverlay(marker[i]);     //将标注添加到地图中去
        var opts = {                               //创建信息窗口，点击图标显示
            width : 200,     // 信息窗口宽度
            height: 100,     // 信息窗口高度
            title : "设备位置" // 信息窗口标题
            };
        var infoWindow;  
            marker[i].addEventListener("click", function(e){     
                infoWindow = new BMap.InfoWindow("经度:"+e.point.lng+",纬度"+e.point.lat, opts);
                map1.openInfoWindow(infoWindow,point); //开启信息窗口
             });
            marker[i].addEventListener("dblclick",function(){
                window.location.href="device_control.php";  
            });
    };

    var markerwxg=new BMap.Marker(point1); //创建标注
     	map1.addOverlay(markerwxg);     //将标注添加到地图中去
   		 //markerwxg.setAnimation(BMAP_ANIMATION_BOUNCE); //图标跳动效果
    	var opts = {                               //创建信息窗口，点击图标显示
            width : 200,     // 信息窗口宽度
            height: 100,     // 信息窗口高度
            title : "设备位置" // 信息窗口标题
            };
        var infoWindow;  
            markerwxg.addEventListener("click", function(e){     
                infoWindow = new BMap.InfoWindow("经度:"+e.point.lng+",纬度"+e.point.lat+"<br>中国无线谷", opts);
                map1.openInfoWindow(infoWindow,point1); //开启信息窗口
             });
            markerwxg.addEventListener("dblclick",function(){
                window.location.href="device_control.php";  
            });

    var markerseu=new BMap.Marker(point2);
    	map1.addOverlay(markerseu);
     
        markerseu.addEventListener("click", function(e){     
            infoWindow = new BMap.InfoWindow("经度:"+e.point.lng+",纬度"+e.point.lat+"<br>东南大学", opts);
            map1.openInfoWindow(infoWindow,point2); //开启信息窗口
         });
        markerseu.addEventListener("dblclick",function(){
            window.location.href="device_control.php";  
        });
</script>
</body>
</html>
