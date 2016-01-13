<!DOCTYPE html>
<?php  session_start(); ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人主页</title>
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

<div class="container-fluid" >
	<div class="row-fluid">
		<div class="col-md-12">
			<div class="navbar">
				<div class="navbar-inner">
					<a href="index.php" class="navbar-form pull-right">返回首页</a>
					<p class="navbar-form pull-right">Welcome <a href="user_info_edit.php"><?php echo $_SESSION['username'];?></a></p>
			    </div> 
		    </div>
		</div>
	</div>

	<div class="row-fluid">
		<?php include("include/menu.php") ?>
		<!-- <div class="col-md-2"style="border-right:solid gray;border-width:thin">
			<ul calss="nav" style="margin-left:">
				<li class="active"><a href="index.html"><span class="glyphicon glyphicon-home">首页</span></a></li>
                <li><a href="user_info.php"><span class="glyphicon glyphicon-leaf">个人资料</span><br></a></li>
                <li><a href="user_info_edit.php"><span class="glyphicon glyphicon-pencil">编辑资料</span></a><br><hr></li>
                <li><a href="spectrum_show.php"><span class="glyphicon glyphicon-stats">查看频谱</span></a><br></li>
                <li><a href="device_location.php"><span class="glyphicon glyphicon-map-marker">检测位置</span><br></a></li>
			</ul>
		</div> -->
		<div class="col-md-8" style="border-left:solid gray;border-width:thin">
		<h4>设备分布图：</h4>
        <p>单击图标可以查看设备基本信息，双击设备可进入相关设备管理页</p>
		<div id="divMap" style="width:100%;height:400px;border:solid 1px gray"></div>
		</div>
		<div class="col-md-2">	
         <div>
            <h4>设备列表</h4>
            <ul>
                <li id="01"><a href="device_control.php#dev01.php">01号设备</a></li>
                <li id="02"><a href="device_control.php#dev02.php">02号设备</a></li>
                <li id="03"><a href="device_control.php#dev03.php">03号设备</a></li>
                <li id="04"><a href="device_control.php#dev04.php">04号设备</a></li>
                <li id="05"><a href="device_control.php#dev05.php">05号设备</a></li>
                <li id="06"><a href="device_control.php#dev06.php">06号设备</a></li>
                <li id="07"><a href="device_control.php#dev07.php">07号设备</a></li>
                <li id="08"><a href="device_control.php#dev08.php">08号设备</a></li>
                <li id="09"><a href="device_control.php#dev09.php">09号设备</a></li>
                <li id="10"><a href="device_control.php#dev10.php">10号设备</a></li>
                <li id="11"><a href="device_control.php#dev11.php">11号设备</a></li>
                <li id="12"><a href="device_control.php#dev12.php">12号设备</a></li>
                <li id="13"><a href="device_control.php#dev13.php">13号设备</a></li>
                <li id="14"><a href="device_control.php#dev14.php">14号设备</a></li>
                <li id="15"><a href="device_control.php#dev15.php">15号设备</a></li>
                <li id="16"><a href="device_control.php#dev16.php">16号设备</a></li>
                <li id="17"><a href="device_control.php#dev17.php">17号设备</a></li>
                <li id="18"><a href="device_control.php#dev18.php">18号设备</a></li>
                <li id="19"><a href="device_control.php#dev19.php">19号设备</a></li>
                <li id="20"><a href="device_control.php#dev20.php">20号设备</a></li>
            </ul>
        </div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="col-md-12">
		</div>
	</div>
	
</div>
<footer>
	<?php include("include/footer.php") ?> 
</footer>
</body>
</html>
<script type="text/javascript">

	var map1 = new BMap.Map("divMap");            // 创建Map实例
    var point1 = new BMap.Point(118.8278010000,31.8755870000); //无线谷经纬度坐标，经纬度弄反是西非
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