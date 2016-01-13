<!DOCTYPE html>
<?php  include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); 
include("../lib/authcode.php");error_reporting(E_ALL & ~E_NOTICE); 
?>
<?php  session_start(); ?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户注册</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" >
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css" >
	<link rel="shortcut icon" href="img/icon.png">

	<style type="text/css">
      body {background-image:url(#);background-repeat:no-repeat; background-attachment:fixed;}
      form{margin-left:30%; margin-top:5%;}
      h4{margin-left: 8%;}
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
			        <a href="login.php" class="navbar-form pull-right">登录</a>
					<a href="index.php" class="navbar-form pull-right">首页</a>
			    </div> 
		    </div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12" id="regdiv" name="regdiv">
			<form class="form-horizontal" method="post" action="" >
			  	<h4>用户注册</h4>
			  	<div class="form-group">
			    	<label class="col-sm-2 control-label" for="username">用&nbsp;户&nbsp;&nbsp;名</label>
			    	<div class="col-sm-4">
			      		<input type="text" class="form-control"  name="username" id="username" placeholder="Username" value="<?php ?>">
			   		</div>
			 	</div>
			  	<div class="form-group">
			    	<label class="col-sm-2 control-label" for="email">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</label>
			    	<div class="col-sm-4">
			      		<input type="email" class="form-control" name="email"id="email" placeholder="Email">
			   		</div>
			 	</div>
			    <div class="form-group">
			    	<label class="col-sm-2 control-label" for="password">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</label>
			    	<div class="col-sm-4">
			      		<input type="password" class="form-control" name="password"id="password" placeholder="Password">
			    	</div>
			    </div>
			    <div class="form-group">
			    	<label class="col-sm-2 control-label">确认密码</label>
			    	<div class="col-sm-4">
			      		<input type="password" class="form-control" id="password2"name="password2" placeholder="Password">
			    	</div>
			    </div>
			    <div class="form-group">
			      <div class="col-sm-offset-2 col-sm-10">
			        <button type="submit" name="submit"class="btn btn-default" onclick="#">注&nbsp;&nbsp;册</button>		     
			      </div>
			     </div>
			</form>
			<?php 

			if($_POST[submit]||isset($_POST[submit])){
				//判断注册信息是否填写完整
			  	if(empty($_POST[email])||empty($_POST[username])||empty($_POST[password])||empty($_POST[password2])){
					?>
                     <p class="warning">请完整填写注册信息！</p>
					<?php
                     exit;	
				}
				//判断邮箱格式
				 if ( empty($_POST[email])|| !preg_match("/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",$_POST[email])) {
				 	?>
                     <p class="warning">邮箱格式不正确！</p>
					<?php
                     exit;
                 } 
                 //判断用户是否存在
				 $sql="select * from t_user where username='$_POST[username]' or email='$_POST[email]'";
	             $query=mysql_query($sql);
	             $attitle=is_array($row=mysql_fetch_array($query));
	         	if($attitle){
		    ?>
		        <p class="warning">用户名或邮箱已存在！</p>
		    <?php
					exit();}
			 	else{

			 		$password1 = (isset($_POST['password'])) ? $_POST['password'] : '';
    				$password2 = (isset($_POST['password2'])) ? $_POST['password2'] : '';
    				if($password1 && $password1 == $password2)
    					{//$password=md5($password1);
						$str = $password1;
			            $key =trim($_POST[username]);
			            $act = "ENCODE";
			            //$act2 = "DECODE";
			            $password=authcode($str,$act,$key,0);//以用户名为秘钥对密码进行加密
			            //echo authcode($password,"DECODE",$key,100)."<br>".$password1;

    					}
					else{
		           	?>
		              <p class="warning">两次密码不一致，请重新输入</p>
		            <?php exit();
		        		}
		           	//注册信息写入数据库，注册成功
			       // $sql="insert into task_user (username, password,email) values ('$_POST[username]', '$password', '$_POST[email]')";
			       // $query=mysql_query($sql);

                   //邮件激活账号
			        $username =trim($_POST[username]);
			        //$password = md5(trim($_POST['password']));
					$email = trim($_POST['email']);
					$regtime = time();

					$token = md5($username.$password.$regtime); //创建用于激活识别码
					$token_exptime = time()+60*60*24;//过期时间为24小时后

					$sql = "insert into `t_user` (`username`,`password`,`email`,`token`,`token_exptime`,`regtime`) values ('$username','$password','$email','$token','$token_exptime','$regtime')";

					$query_insert=mysql_query($sql);
					

					if(mysql_insert_id()||$query_insert){//写入成功
						/*将uid写入表t_user_info里*/
						$_SESSION['username']= $username;
						//$_SESSION['password']= $password1;//安全隐患

						$sql="select * from t_user where username='$username' or email='$email'";
						$query=mysql_query($sql);
						//if($query)echo 1;else echo 0;
						$array=mysql_fetch_array($query);
						//if($array)echo 1;else echo 0;
						$uid=$array[uid];
						$email=$array[email];
						$sql = "insert into `t_user_info` (`uid`,`email`) values ('$uid','$email')";
						$query=mysql_query($sql);
						//if($array)echo 89;else echo 00;

						/*发送激活邮件*/
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
					    $emailsubject = "用户帐号激活";
					    $emailbody = "亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://121.248.49.140/task_active/public/active.php?verify=".$token."' target='_blank'>http://121.248.49.140/task_active/public/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>敬上</p>";
					    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
						if($rs==1){
					?>
	     			 	<p class="success">恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！</p><br/>
						
	     			 	<meta http-equiv=refresh content='5; url=login.php'>
					<?php								
				        }
				        else{
							$msg = $rs;	
					       echo "<p>邮件发送失败</p>"; 
						}
					echo $msg;
					}

	     			 if($query){
	     		
						}
					}
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