<?php
 include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE);
$verify = stripslashes(trim($_GET['verify']));
$nowtime = time();
$query = mysql_query("select uid,token_exptime from t_user where status='0' and `token`='$verify'");
$row = mysql_fetch_array($query);
if($row||$query){
	if($nowtime>$row['token_exptime']){ //24h后
		$msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.';
	}
	else{
		mysql_query("update t_user set status=1 where uid=".$row['uid']);
		if(mysql_affected_rows($GLOBALS['DB'])!=1) die(0);
		$msg = '激活成功！';
    }
}
else{
	$msg = 'error，账号未激活！';	
}

echo $msg;
?>
<meta http-equiv=refresh content='5; url=login.php'>