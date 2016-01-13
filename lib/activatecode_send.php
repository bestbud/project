<?php 
/*
时间：15/10/22
作者：宋二毛^_^
功能：发送激活邮件
注意：在public目录下的文件可以直接引用本文件，其他目录下的文件引用本目录时应该校正incluede url
*/
include_once("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); 
include_once("../lib/smtp.class.php");error_reporting(E_ALL & ~E_NOTICE); 
session_start(); 

$uid= $_SESSION['uid'];
$username= $_SESSION['username'];
  	$sql="select * from t_user where uid='$uid'";
	$query=mysql_query($sql);
			if($query)echo 1;else echo 0;
	$array=mysql_fetch_array($query);
			if($array)echo 1;else echo 0;
$email=$array[email];
$password=$array[password];
$regtime=$array[regtime];
$token = md5($username.$password.$regtime); //创建用于激活识别码
$token_exptime = time()+60*60*24;//过期时间为24小时后

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
		$emailbody = "亲爱的".$username."：<br/>感谢您在我站注册了帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://121.248.49.140/task_active/public/active.php?verify=".$token."' target='_blank'>http://121.248.49.140/task_active/public/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>敬上</p>";
		$rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
		if($rs==1){
		?>
		 	<p class="success">恭喜您，邮件发送成功！<br/>请登录到您的邮箱<?php echo $email;?>及时激活您的帐号！</p><br/>

		 	<meta http-equiv=refresh content='5; url=index.php'>
		<?php								
		}
		else{
			$msg = $rs;	
		   echo "<p>邮件发送失败</p>"; 
		}
	}else echo "no";
 ?>