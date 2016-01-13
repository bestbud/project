<!DOCTYPE html>
<?php  include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); ?>
<?php  session_start(); ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=8XlluTBXpUYwcdzDHV3XcdMz"></script>
	<title>找回密码</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" >
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css" >
	<link rel="shortcut icon" href="img/icon.png">
	<style type="text/css">
      body {background-image:url(#);background-repeat:no-repeat; background-attachment:fixed;}
      form { margin-top: 5%; 
      	     margin-left:30%;
      	     padding:2%;
      		}
      h4{margin-left:5%;}
      .warning{color: red;
      	text-align: center;
      }
      .success{color:green;
      	text-align: center;
      }

    </style>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="navbar ">
				<div class="navbar-inner">
					<a href="index.html" class="navbar-form pull-right">返回首页</a>
			    </div> 
		    </div>
		</div>
	</div>
    <div class="row-fluid">
		<div class="span12">
			<form class="form-horizontal" method="post">
			  <div class="form-group">
			    <label class="col-sm-12 control-label">请输入用户名或注册用的邮箱：</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="usernameOrEmail" name="usernameOrEmail" placeholder="Email/Username">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" name="submit"class="btn btn-default">获取密码</button>
			      &nbsp;&nbsp;&nbsp;&nbsp;
			      <a href="index.php"><button type="button" name="get_password" id="get_password"class="btn btn-default">返回主页</button></a>
			    </div>
			  </div>
			</form>
			<?php
				if($_POST[submit]||isset($_POST[submit])){
	  				$usernameOrEmail=$_POST['usernameOrEmail'];
	     			$sql="select * from t_user  where username='$usernameOrEmail' or email='$usernameOrEmail'";
	     			$query=mysql_query($sql);
	        		$exist=is_array($row=mysql_fetch_array($query));//判断是否存在这样一个用户 
	            		//$exist2=$exist?md5(trim($_POST['password']))==$row['password']:FALSE;//判断密码 row数组的键值对应的列名是区分大小写的
	            		// if($exist){echo 密码正确;}else{echo 密码错误;}
	           		if($exist){
	                  echo "get it !"
	                 
	                ?>
	                <script>
	                alert("您的邮箱为")
	                </script>
	                 	<p class="success">邮件发送成功，请登录邮箱找回密码</p><br/>
	                	<meta http-equiv=refresh content='2; url=login.php'>       
	                <?php
					  }	
					else{
					?>
						 <p class="warning">用户名或密码不正确！</p>

					<?php SESSION_DESTROY();  }  	
			   }  
			?>
		</div>
	</div>
</div>	
</body>
</html>