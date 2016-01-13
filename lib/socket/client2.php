<?php
error_reporting(E_ALL);
set_time_limit(0);
echo "<h2>TCP/IP Connection</h2>\n";

$port = 59535;
//$ip = "127.0.0.1";
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

echo "试图连接 '$ip' 端口 '$port'...\n";
$result = socket_connect($socket, $ip, $port);
if ($result < 0) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
}else {
    echo "连接OK\n";
}

$in = 0;
$out = '';

    // for($count=1;$count<10;$count++){
    //     $in++;
    //     sleep(1);
    //     socket_write($socket, $in, strlen($in));
    // }

// if(!socket_write($socket, $in, strlen($in))) {
//     echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
// }else {
//     echo "发送到服务器信息成功！\n";
//     echo "发送的内容为:<font color='red'>$in</font> <br>";
// }
do{
  socket_write($socket, $in, strlen($in));  
  echo $in++;
  //sleep(1);
 // socket_read($socket, 8192);
//if(socket_read($socket, 8192)) break;
}while($in<15);
// {
//     echo "接收服务器回传信息成功！\n";
    echo "接受的内容为:",$out;
// }


echo "关闭SOCKET...\n";
socket_close($socket);
echo "关闭OK\n";

?>