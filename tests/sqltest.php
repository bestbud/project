<!DOCTYPE html>
<?php  include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); ?>
<?php  session_start(); ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>sqltest</title>
</head>


<body>
	<?php 
	$username=$_SESSION['username'];
	$uid=$_SESSION["uid"];
	$sql="select * from t_user_info where uid=$uid";
	$query=mysql_query($sql);
	if($query)echo 1;else echo 0;
	$array=mysql_fetch_array($query);
	if($array)echo 1;else echo 0;
	echo $array[name];
	 ?>
		<p>姓名：<?php echo $array['name']; ?></p><br>
		<p>性别：<?php echo $array['sex']==0?男:女; ?></p><br>
		<p>生日：<?php echo $array['birthday']; ?></p><br>
		<p>所在地：<?php echo $array['location']; ?></p><br>
		<p>email：<?php echo $array['email']; ?></p><br>
		<p>手机号：<?php echo $array['mobile']; ?></p><br>
		<p>QQ号：<?php echo $array['qq']; ?></p><br>
		
	<?php 
	$username=$_SESSION['username'];
	$sql="select * from t_user where username=$username";
	$query=mysql_query($sql);
	if($query)echo 1;else echo 0;
	$array=mysql_fetch_array($query);
	if($array)echo 1;else echo 0;
	echo $array[uid].$array[username];
	 ?>

</body>
</html>
