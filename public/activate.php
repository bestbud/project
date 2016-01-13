<!DOCTYPE html>
<?php //include("../lib/activatecode_send.php") ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>账号激活</title>

	<link rel="stylesheet" type="text/css" href="bootstrap/css/mystyle.css" >
	<!-- bootstrap -->
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
<?php 
	/*
	时间：15/10/22
	作者：宋二毛^_^
	功能：发送激活邮件
	*/
	include_once("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); 
	include_once("../lib/smtp.class.php");error_reporting(E_ALL & ~E_NOTICE); 
	session_start(); 

	$uid= $_SESSION['uid'];
	$username= $_SESSION['username'];
	  	$sql="select * from t_user where uid='$uid'";
		$query=mysql_query($sql);
				//if($query)echo 1;else echo 0;
		$array=mysql_fetch_array($query);
				//if($array)echo 1;else echo 0;
	$email=$array[email];



	$password=$array[password];
	$regtime=$array[regtime];
	$token = md5($username.$password.$regtime); //创建用于激活识别码
	$token_exptime = time()+60*60*24;//过期时间为24小时后

	?>
		<div class="container-fluid" >
			<div class="row-fluid">
				<div class="span12">
					<div class="navbar ">
						<div class="navbar-inner">
					        <a href="login.php" class="navbar-form pull-right">登录</a>
							<a href="index.html" class="navbar-form pull-right">首页</a>
					    </div> 
				    </div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<form class="form-horizontal" method="post">
					  	<h4>邮箱激活</h4>
					  	<br>
					  	<p>该邮箱激活后，可用于登录账号或修改密码，请慎重修改并牢记！</p>
					  	<br>
					  <div class="form-group">
					    <div class="col-md-4">
					      <input type="text" class="form-control" id="email" name="email" value="<?php echo $email?>">
					    </div>
					    <div class="col-md-4">
					      <button type="submit" name="submit"class="btn btn-default">发送激活码</button>     
					    </div>
					  </div>
					</form>
				</div>
			</div>
		</div>
	<?php 
		if($_POST[submit]||isset($_POST[submit])){
			//echo $_POST[email]."????????".$email;
			if(strcmp($email,$_POST[email])){
			   //字符串不相等：strcmp($email,$_POST[email])比较字符串，相等返回0
				
				/*判断用户是否修改email，
				修改则判断邮件是否被其他用户注册，没有则更新数据库中的数据，并向新是邮件地址发送邮件*/

				 //判断用户是否存在
				$sql="select * from t_user where email='$_POST[email]'";
	            $query=mysql_query($sql);
	            $exist=is_array($row=mysql_fetch_array($query));
	         	if($exist){
	         		?>
	         		<script>
	         		alert("邮箱<?php echo $_POST[email];?>已经被其他用户绑定，不可用！如果您之前用此邮箱注册过本网站，可以选择找回密码或换个邮箱。");
	         		</script>
						 	<!-- <p class="warning"><br/>邮箱<?php echo $_POST[email];?>已经被其他用户绑定，不可用！<br>如果您之前用此邮箱注册过本网站，可以选择<a href="get_password.php">找回密码</a>。<br>或者换个邮箱。</p><br/>-->
				 	<meta http-equiv=refresh content='0; url=activate_error.php'>
					<?php
	         	}
	         	else{
				$email=$_POST[email];
				$query_update1=mysql_query("update `t_user` set email='$email' where uid=$uid");
				$query_update2=mysql_query("update `t_user_info` set email='$email' where uid=$uid");

				//if($query_update2)echo "email updated!";else echo "email not updated!";
			
				}
			};


			$sql="update `t_user` set `token`='$token',`token_exptime`='$token_exptime' where uid=$uid";
			$query=mysql_query($sql);
			if($query){//如果已更新数据库中的激活码和激活码有效时间，就给用户发送激活邮件
				//echo "ok";

				$smtpserver = "smtp.126.com"; //SMTP服务器
				$smtpserverport = 25; //SMTP服务器端口
				$smtpusermail = "wordm1@126.com"; //SMTP服务器的用户邮箱
				$smtpuser = "wordm1@126.com"; //SMTP服务器的用户帐号
				$smtppass = "999000"; //SMTP服务器的用户密码
				$smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
				$emailtype = "HTML"; //信件类型，文本:text；网页：HTML
				$smtpemailto = $email;
				$smtpemailfrom = $smtpusermail;
				$emailsubject = "用户帐号激活";
				$emailbody = "亲爱的".$username."：<br/>感谢您在我站注册了帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://121.248.50.165/task_active/public/active.php?verify=".$token."' target='_blank'>http://121.248.50.165/task_active/public/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>敬上</p>";
				$rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
				if($rs==1){
				?>
				 	<p class="success">恭喜您，邮件发送成功！<br/>请登录到您的邮箱<?php echo $email;?>及时激活您的帐号！</p><br/>

				 	<!-- <meta http-equiv=refresh content='5; url=index.php'> -->
				<?php								
				}
				else{
					$msg = $rs;	
				   echo "<p>邮件发送失败</p>"; 
				}
			}//else echo "no";
		}
?>


</body>
</html>