<!DOCTYPE html>
<?php  include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); 
include("../lib/authcode.php");error_reporting(E_ALL & ~E_NOTICE); 时
?>
<?php  session_start(); ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
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
		<div class="col-sm-12">
			<div class="navbar ">
				<div class="navbar-inner">
					<a href="index.html" class="navbar-form pull-right">返回首页</a>
			    </div> 
		    </div>
		</div>
	</div>
    <div class="row-fluid">
		<div class="span12">
			<br><br><br><br><br>

			<form class="form-horizontal" method="post" form="form1">
			  <div class="form-group">
			    <label class="col-sm-4 control-label">请输入用户名或注册用的邮箱：</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="usernameOrEmail" name="usernameOrEmail" placeholder="Email/Username">
			    </div>
			    <div class="col-sm-2">
			      <button type="submit" name="submit"class="btn btn-default">获取密码</button>
			    </div>
			  </div>
			  <div class="form-group">
			  	 <div class="col-sm-offset-2 col-sm-10">
			      <a href="login.php"><button type="button" name="get_password" id="get_password"class="btn btn-default">想起来了，回去登录</button></a>
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
						$email=$row['email'];
						/*HTML获取解密后的密码*/
						$str =$row['password'];
			            $key =$row['username'];
			            $act = "DECODE";
			            //$act2 = "DECODE";
			            $password=authcode($str,$act,$key,0);//以用户名为秘钥对密码进行加密
			            //echo authcode($password,"DECODE",$key,100)."<br>".$password1;
	                ?>
	                <form form="form1"><input type="hidden" id="email_hidden" name="email_hidden" value="<?php echo $email;?>"></form>
	                <script>
		                var email=document.getElementById('email_hidden').value;
		                alert("您的邮箱为:  "+email);
		            </script>
		            <?php //发送含有密码的邮件
			            	include_once("../lib/smtp.class.php");
							$smtpserver = "smtp.126.com"; //SMTP服务器
						    $smtpserverport = 25; //SMTP服务器端口
						    $smtpusermail = "wordm1@126.com"; //SMTP服务器的用户邮箱
						    $smtpuser = "wordm1@126.com"; //SMTP服务器的用户帐号
						    $smtppass = "999000"; //SMTP服务器的用户密码
						    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
						    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
						    $smtpemailto = $email;
						    $smtpemailfrom = $smtpusermail;
						    $emailsubject = "用户密码找回";
						    $emailbody = "亲爱的".$row['username']."：<br/>感谢您使用我站的密码找回功能。<br/>您的密码为:".$password."<br/>如果此次密码找回请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'></p>";
						    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
							if($rs==1){
						?>
		     			 	<p class="success">恭喜您，邮件发送成功，请登录邮箱找回密码……</p><br/>
							
		     			 	<meta http-equiv=refresh content='5; url=login.php'>
						<?php								
					        }
					        else{
								$msg = $rs;	
						       echo "<p>邮件发送失败</p>"; 
							}
						echo $msg;

		             ?>

		            <script>
		                //alert("邮件发送成功，请登录邮箱找回密码……");
	                </script>
	                <meta http-equiv=refresh content='3; url=login.php'>       
	                <?php
					  }	
					else{
					?>
						 <script>alert("用户名或邮箱不存在，请重新注册一个账号");</script>
						 <!-- <p class="warning">用户名或邮箱不存在，请重新注册一个账号</p> -->
						 <meta http-equiv=refresh content='1; url=register.php'> 

					<?php SESSION_DESTROY();  }  	
			   }  
			?>
		</div>
	</div>
</div>	
<footer>
	<?php include("include/footer.php") ?> 
</footer>
</body>
</html>