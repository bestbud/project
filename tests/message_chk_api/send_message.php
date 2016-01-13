<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>	提交短信</title>
</head>
<body>
	<p>提交短信模块</p>
</body>
</html>
<?php 
//短信发送验证码http://www.symzcm.net/index.html
//提交短信 户名：RB521 密码：102030 ID：12637
$post_data = array();
$post_data['userid'] = '12637';
$post_data['account'] = 'RB521';
$post_data['password'] = '102030';
$post_data['content'] = '验证码测试验证码1234'; 
$post_data['mobile'] = '15062286157';
$post_data['sendtime'] = ''; //不定时发送，值为0，定时发送，输入格式YYYYMMDDHHmmss的日期值
$url='http://www.qf106.com/sms.aspx?action=send';
$o='';
foreach ($post_data as $k=>$v)
{
   $o.="$k=".urlencode($v).'&';//短信内容需要用urlencode编码下
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
$result = curl_exec($ch);
?>

<?php //查询余额
// $post_data = array();
// $post_data['userid'] = '12637';
// $post_data['account'] = 'RB521';
// $post_data['password'] = '102030';
// $url='http://www.qf106.com/sms.aspx?action=overage';
// $o='';
// foreach ($post_data as $k=>$v)
// {
//     $o.=urlencode("$k=".$v).'&';
// }
// $post_data=substr($o,0,-1);
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_HEADER, 0);
// curl_setopt($ch, CURLOPT_URL,$url);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
// //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
// $result = curl_exec($ch);
?>

<?php //验证帐号
$post_data = array();
$post_data['userid'] = '12637';
$post_data['account'] = 'RB521';
$post_data['password'] = '102030';
$url='http://www.qf106.com/sms.aspx?action=overage';
$o='';
foreach ($post_data as $k=>$v)
{
    $o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
$result = curl_exec($ch);
?>