<?php
error_reporting(E_ALL);
//确保在连接客户端时不会超时
set_time_limit(0);
$ip = '121.248.50.165';
$port = 59535;
/*
 +-------------------------------
 *    @socket通信整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_bind
 *    @socket_listen
 *    @socket_accept
 *    @socket_read
 *    @socket_write
 *    @socket_close
 +--------------------------------
 */
/*----------------    以下操作都是手册上的    -------------------*/
if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
    echo "socket_create() 失败的原因是:".socket_strerror($sock)."\n";
}

if(($ret = socket_bind($sock,$ip,$port)) < 0) {
    echo "socket_bind() 失败的原因是:".socket_strerror($ret)."\n";
}

if(($ret = socket_listen($sock,14)) < 0) {
    echo "socket_listen() 失败的原因是:".socket_strerror($ret)."\n";
}

do {
    if (($msgsock = socket_accept($sock)) < 0) {
        echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
        break;
    } else { 
		$myfile = fopen("../../data/spectrum.txt", "a") or die("Unable to open file!");
        do{
			//发到客户端
        	$msg ="连接成功!\n";
        	socket_write($msgsock, $msg, strlen($msg));
        	//服务器端机器显示
			echo "连接成功\n".$count; 
        	while(($buf = socket_read($msgsock,8192))<=0);//阻塞直到读取到字符
			//$myfile = fopen("../../data/spectrum.txt", "a") or die("Unable to open file!");
            //fclose($myfile);
			fwrite($myfile, $buf);
            //服务器端机器显示
        	$talkback = "收到信息:$buf\n";
        	echo $talkback;
        }while($msgsock>0);
		fclose($myfile);
     }  
} while (true);
socket_close($sock);
?>