<!DOCTYPE html>
<?php  session_start(); ?>
<?php  include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); ?>
<?php 
	$uid=$_SESSION['uid'];
	$sql="select * from t_user_info where uid=$uid";
	$query=mysql_query($sql);
	$array=mysql_fetch_array($query);
	$location=$array["location"];
	$location=explode("/", $location);//分割字符串为省市区街道四元素数组
	//$_SESSION["location"]=$location;
	//setcookie("location",$array["location"]);
	//echo $_COOKIE["location"];

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑资料</title>

	<link rel="stylesheet" type="text/css" href="bootstrap/css/mystyle.css" >
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" >
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/icon.png">
	<style type="text/css">
      body {background-image:url(#);background-repeat:no-repeat; background-attachment:fixed;}
    </style>
    <script type="text/javascript" src="js/area.js"></script> 
  
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
		<!-- <div class="col-md-2"style="#">
			<ul calss="nav" style="margin-left:">
				<li class="active"><a href="index.html"><span class="glyphicon glyphicon-home">首页</span></a></li>
                <li><a href="user_info.php"><span class="glyphicon glyphicon-leaf">个人资料</span><br></a></li>
                <li><a href="user_info_edit.php"><span class="glyphicon glyphicon-pencil">编辑资料</span></a><br><hr></li>
                <li><a href="spectrum_show.php"><span class="glyphicon glyphicon-stats">查看频谱</span></a><br></li>
                <li><a href="device_location.php"><span class="glyphicon glyphicon-map-marker">检测位置</span><br></a></li>
			</ul>
		</div> -->
		<div class="col-md-4" style="border-left:solid gray;border-width:thin">
			<h4><span class="glyphicon glyphicon-pencil"></span>&nbsp;编辑个人资料</h4>
			<hr>
			<form class="form-horizontal" method="post" action="userInfoEdit_save.php" >
			    <h4>基本信息</h4><hr>
				<div class="form-group">
			    	<label class="col-md-2 control-label" for="name">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</label>
			    	<div class="col-md-6">
			      		<input type="text" class="form-control" name="name"id="name" value="<?php echo $array['name']; ?>">
			   		</div>
			 	</div>
			 	
			 	<div class="form-group">
			 		<label class="col-md-2 control-label" for="sex">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</label>
			    	<label for="sex_male">&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex"id="sex_male" value="male" checked="checked">男</label>
			        <label for="sex_female" >&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex"id="sex_female" value="female">女</label>
			   	</div>
			   	<div class="form-group">
			    	<label class="col-md-2 control-label" for="birthday">生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日</label>
			    	<div class="col-md-6">
			      		<input type="date" class="form-control"name="birthday"id="birthday" value="<?php echo $array['birthday']; ?>">
			   		</div>
			 	</div>
			 	<div class="form-group">
			 		<!-- 三级地址联动表单，需引用area.js文件 -->
			    	<label class="col-md-2 control-label" for="location">所&nbsp;&nbsp;在&nbsp;&nbsp;地</label>
			    	<div class="col-md-3">
			    		<select class="form-control"id="province" runat="server" name="province" > 
						</select> 
					</div>
			    	<div class="col-md-3">
			    		<select class="form-control"id="city" runat="server" name="city" > 
						</select> 
			    	</div>
					<div class="col-md-4">
						<select class="form-control"id="county" runat="server" name="county"> 
						</select>
					</div>	
					<br><br>
					<label class="col-md-2 control-label" for="street" style="font-weight:#;">街&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;道</label>
			    	<div class="col-md-10">
			      		<input type="text" class="form-control" name="street"id="street"value="<?php echo $location[3]; ?>">
			   		</div>

			   		<input type="hidden" id="location_hidden"name="location_hidden"value="<?php echo $array['location']; ?>">
						 
						

						
			 	</div>
			 	<br>
			 	<h4>联系信息</h4><hr>
			   	<div class="form-group">
			    	<label class="col-md-2 control-label" for="email" >邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</label>
			    	<div class="col-md-6">
			      		<input type="email" class="form-control" name="email"id="email"value="<?php echo $array["email"]; ?>"disabled="disabled">
			   		</div>
			   		<div class="col-sm-2">
			            <a href="activate.php"><button type="button" class="btn btn-default">修&nbsp;&nbsp;改</button></a>
			        </div>
			 	</div>
			 	<div class="form-group">
			    	<label class="col-md-2 control-label" for="mobile">手&nbsp;&nbsp;机&nbsp;&nbsp;号</label>
			    	<div class="col-md-6">
			      		<input type="mobile" class="form-control" name="mobile"id="mobile"onblur="mob_chk_onblur()" value="<?php echo $array["mobile"]; ?>">
			   		</div>
			   		<div class="col-md-4">
			   			<div id="mobile_warning"name="mobile_warning"></div>
			   		</div>
			   		<br>
			   		<div class="col-md-offset-2 col-md-10">
			        	<button type="button" name="mob_message_chk"id="mob_message_chk"class="btn btn-default" disabled="disabled">短信验证</button>		     
			        </div>
			 	</div>
			 	<div class="form-group">
			    	<label class="col-md-2 control-label" for="qq">QQ</label>
			    	<div class="col-md-6">
			      		<input type="text" class="form-control" name="qq"id="qq"value="<?php echo $array["qq"]; ?>">
			   		</div>
			 	</div>
			 	<hr>	
			    <h4>安全信息&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="password_change.php">修改密码</a></h4>
			 	<hr>
			 	<div class="form-group">
			        <div class="col-md-offset-2 col-md-10">
			         <button type="submit" name="submit"class="btn btn-default">保&nbsp;&nbsp;存</button>		     
			        </div>
			    </div>
			</form>
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
<!--js初始化函数--> 
<script type="text/javascript"> 
var ulocation=document.getElementById("location_hidden").value;
//alert(ulocation);
var array_ulocation=ulocation.split("/");
//alert(array_ulocation[0]+array_ulocation[2]);
opt0 = [array_ulocation[0],array_ulocation[1],array_ulocation[2]];
setup();
</script>
<script>
	function mob_chk_onblur(){//验证手机号格式
		//alert("it works");
	var mobile = document.getElementById("mobile");
	var mobile_warning=document.getElementById("mobile_warning");
	var mobile_val=mobile.value;
	    if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(mobile_val))){ 
	    	mobile_warning.style.color="red";
	        mobile_warning.innerHTML=("<p>手机号不足11位或前7位不正确</p>"); 
	        mobile.focus(); 
	        return false; 
	    } 
	    else {
	    	mobile_warning.style.color="green";
	    	mobile_warning.innerHTML=("<p>ok</p>");
	    	} 
	}
</script>
</html>  