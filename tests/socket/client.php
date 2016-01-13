<?php
error_reporting(E_ALL);
set_time_limit(0);
echo "<h2>TCP/IP Connection</h2>\n";

$port = 59535;
$ip = '121.248.50.165';

/*
 +-------------------------------
 *    @socket连接整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_connect
 *    @socket_write
 *    @socket_read
 *    @socket_close
 +--------------------------------
 */

	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if ($socket < 0) {
		echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
	}else {
		echo "OK.\n";
	}
	//客户端机器显示
	echo "试图连接 '$ip' 端口 '$port'...\n";
	while(($result = socket_connect($socket, $ip, $port))<=0);
	while(($out = socket_read($socket, 8192))<=0); 
	echo "接受的内容为:",$out;
	$in = 0;
	for($count=1;$count<10;$count++){
        //$in++;
        $in=99;
        //sleep(1);
        if(!socket_write($socket, $in, strlen($in))) {
			echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
		}
		else {
			echo "发送消息:<font color='red'>$in</font> <br>";
		}
    }
	while(($out = socket_read($socket, 8192))<=0); 
	echo "接受的内容为:",$out;

	socket_close($socket);
	echo "关闭OK\n";
?>