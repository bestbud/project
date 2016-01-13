<!DOCTYPE html>
<?php include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); ?>
<?php  session_start(); ?>
<?php 
	$uid=$_SESSION['uid'];
	$sql="select * from device  where uid='$uid'";
	$query=mysql_query($sql);
	$exist=is_array($row=mysql_fetch_array($query));
	if($exist){
		$latitude=$row[latitude];
		$longitude=$row[longitude];
		
	}else{
	$warning="暂时没有设备所在位置经纬度信息！";
	}//end of if($exist)

 ?>
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
					<a href="userpage.php" class="navbar-form pull-right">返回个人主页</a>
					<p class="navbar-form pull-right">Welcome <a href="user_info_edit.php"><?php echo $_SESSION['username'];?></a></p>
			    </div> 
		    </div>
		</div>
	</div>

	<div class="row-fluid">
    <?php include("include/menu.php") ?>
		<!-- <div class="col-md-2">
			<ul calss="nav" style="margin-left:%">
				<li class="active"><a href="index.html"><span class="glyphicon glyphicon-home">首页</span></a></li>
                <li><a href="user_info.php"><span class="glyphicon glyphicon-leaf">个人资料</span><br></a></li>
                <li><a href="user_info_edit.php"><span class="glyphicon glyphicon-pencil">编辑资料</span></a><br><hr></li>
                <li><a href="spectrum_show.php"><span class="glyphicon glyphicon-stats">查看频谱</span></a><br></li>
                <li><a href="device_location.php"><span class="glyphicon glyphicon-map-marker">检测位置</span><br></a></li>
			</ul>
		</div> -->
		<div class="col-md-8" style="border-left:solid gray;border-width:thin">
		<br>
		<p class="lead">检测点位置显示</p> 
		<p class="lead">经纬度:<span><?php echo $longitude;?></span>,<span><?php echo $latitude;?></span></p>
			<form action="">
				<input type="hidden" id="longitude"name="longitude"value="<?php echo $longitude; ?>">
				<input type="hidden" id="latitude" name="latitude"value="<?php echo $latitude; ?>">

			</form>
		<div id="divMap" style="width:100%;height:400px;border:solid 1px gray"></div>
		</div>
		<!-- <div class="col-md-3">
			
		</div> -->
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
	// var latitude=document.getElementById(latitude);
	// var longitude=document.getElementById(longitude);
	// alert(latitude.innerHTML);

	var map1 = new BMap.Map("divMap");            // 创建Map实例
    var point1 = new BMap.Point(118.8278010000,31.8755870000); //无线谷经纬度坐标，经纬度弄反是西非
    var point2=new BMap.Point(118.8255370000,31.8926350000); //东大九龙湖图书馆
    var point3=new BMap.Point(118.8002230000,32.0617390000);//四牌楼校区
    map1.centerAndZoom(point1,13);  
    // map1.centerAndZoom("南京",15);      // 初始化地图,用城市名设置地图中心点             
    map1.enableScrollWheelZoom();   //启用滚轮放大缩小
    map1.addControl(new BMap.NavigationControl());           //添加控件    

    var marker1=new BMap.Marker(point1); //创建标注
     	map1.addOverlay(marker1);     //将标注添加到地图中去
    	var opts = {                               //创建信息窗口，点击图标显示
		  	width : 200,     // 信息窗口宽度
			height: 100,     // 信息窗口高度
			title : "中国无线谷" , // 信息窗口标题
			}
		var infoWindow = new BMap.InfoWindow("地址：南京市江宁区秣周东路9号", opts);  // 
			marker1.addEventListener("click", function(){          
			map1.openInfoWindow(infoWindow,point1); //开启信息窗口
		     });

     var marker2=new BMap.Marker(point2);
    	map1.addOverlay(marker2);
     var marker3=new BMap.Marker(point3);
    	map1.addOverlay(marker3);

   
</script>