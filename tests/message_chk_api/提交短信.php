<?php //�ύ����
$post_data = array();
$post_data['userid'] = 12;
$post_data['account'] = 'test';
$post_data['password'] = 'test';
$post_data['content'] = '����php�ύ'; 
$post_data['mobile'] = '13905792605';
$post_data['sendtime'] = ''; //����ʱ���ͣ�ֵΪ0����ʱ���ͣ������ʽYYYYMMDDHHmmss������ֵ
$url='http://www.qf106.com/sms.aspx?action=send';
$o='';
foreach ($post_data as $k=>$v)
{
   $o.="$k=".urlencode($v).'&';//����������Ҫ��urlencode������
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //�����Ҫ�����ֱ�ӷ��ص�������Ǽ�����䡣
$result = curl_exec($ch);
?>