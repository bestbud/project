<!DOCTYPE html>
<?php  session_start(); ?>
<?php  include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人资料</title>

	<link rel="stylesheet" type="text/css" href="bootstrap/css/mystyle.css" >
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" >
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/icon.png">
	<style type="text/css">
      body {background-image:url(#);background-repeat:no-repeat; background-attachment:fixed;}
    </style>
</head>


<body>
<div class="container-fluid" >
	<div class="row-fluid">
		<div class="span12">
			<div class="navbar ">
				<div class="navbar-inner">
					<a href="userpage.php" class="navbar-form pull-right">返回个人主页</a>
					<p class="navbar-form pull-right">Welcome <a href="user_info_edit.php"><?php echo $_SESSION['username'];?></a></p>
			    </div> 
		    </div>
		</div>
	</div>
	
	<div class="row-fluid">
	<?php include("include/menu.php") ?>
		<!-- <div class="col-md-2 "style="#">
			<ul calss="nav" style="margin-left:%">
				<li class="active"><a href="index.html"><span class="glyphicon glyphicon-home">首页</span></a></li>
                <li><a href="user_info.php"><span class="glyphicon glyphicon-leaf">个人资料</span><br></a></li>
                <li><a href="user_info_edit.php"><span class="glyphicon glyphicon-pencil">编辑资料</span></a><br><hr></li>
                <li><a href="spectrum_show.php"><span class="glyphicon glyphicon-stats">查看频谱</span></a><br></li>
                <li><a href="device_location.php"><span class="glyphicon glyphicon-map-marker">检测位置</span><br></a></li>
			</ul>
		</div> -->
		<div class="col-md-6" style="border-left:solid gray;border-width:thin">
			<h4><span class="glyphicon glyphicon-pencil"></span>&nbsp;个人资料</h4>
			<hr>
			<?php 
			$uid=$_SESSION['uid'];
			$sql="select * from t_user_info where uid=$uid";
			$query=mysql_query($sql);
			$array=mysql_fetch_array($query);
			 ?>
				<p>姓名：<?php echo $array['name']; ?></p><br>
				<p>性别：<?php echo $array['sex']==0?男:女; ?></p><br>
				<p>生日：<?php echo $array['birthday']; ?></p><br>
				<p>所在地：<?php echo $array['location']; ?></p><br>
				<p>email：<?php echo $array['email']; ?></p><br>
				<p>手机号：<?php echo $array['mobile']; ?></p><br>
				<p>QQ号：<?php echo $array['qq']; ?></p><br>
 

		</div>
		<div class="col-md-3"style="#">
		</div>
		<div class="col-md-1"style="#">
		</div>

	</div>
</div>
<footer>
	<?php include("include/footer.php") ?> 
</footer>
</body>
</html>