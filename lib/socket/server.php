<?php
//确保在连接客户端时不会超时
set_time_limit(0);
//接收show_live.php页表单传过来的参数
$sub_f0=$_POST['sub_f0'];
$sub_bw=$_POST['sub_bw'];
$sub_nfft=$_POST['sub_nfft'];

$ip = '121.248.50.165';
//$ip = "127.0.0.1";
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

if(($ret = socket_listen($sock,4)) < 0) {
    echo "socket_listen() 失败的原因是:".socket_strerror($ret)."\n";
}

$myfile = fopen("testfile.txt", "w") or die("Unable to open file!");

while (true) {

    $connection = socket_accept($sock);
    if (!$connection) {
        echo "socket_accept() failed: reason: " . socket_strerror($connection) . "\n";
        break;
    } else {
        echo "连接成功\n";
        while ($buf = @socket_read($connection , 16384)) {
            //$talkback = "收到的信息:$buf\n";
            //echo $talkback;
            //发到客户端
            //$msg ="测试成功！\n";
            $msg=$f0.','.$bw.','.$nfft;
            socket_write($connection, $msg, strlen($msg));

            $number = array();
            echo "收到信息\n";
            echo "字符串长度".strlen($buf)."\n";
            //for ($i=0; $i < strlen($buf) - 1; $i++) { 
                //echo ord($buf[$i]);
                //echo "\n";
            //}
            for ($i=0; $i < strlen($buf) - 1; $i=$i + 4) { 
                $number[$i/4] = ord($buf[$i]) * 16777216 + ord($buf[$i + 1]) * 65536 + ord($buf[$i + 2]) * 256 + ord($buf[$i + 3]);
            }

            $head=$number[0];//第一个数
            $f0=(double)$number[1];//中心频率了 单位MHZ
            $bw=(double)$number[2];//是带宽 单位HZ
            $g=(double)$number[3];//硬件增益  
            $nfft=(double)$number[4];//是fft的长度

            $data=array(); 
            for($j=5,$i=0;$j<count($number);$j++){
               $data[$i]=10*(log10((double)$number[j])-2*log10($nfft))-$g;
            }

            //后半数据放到前面
            function reverse(array $data){//数组前后半段数据交换
                $reverse_data=array();
                for($j=count($data)/2,$i=0;$j<count($data);$j++){
                  $reverse_data[$i++]=$data[$j];
                }
                for($j=0,$harf_len=count($data)/2;$j<(count($data)/2);$j++){
                  $reverse_data[$harf_len++]=$data[$j];
                }
                return $reverse_data;
            }

            $data=reverse($data);
            $data_txt=implode(',',$data);//数组转字符串

            include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE);
            $sql = "insert into `spectrum` (`f0`,`bw`,`g`,`nfft`,`data`) values ('$f0','$bw','$g','$nfft','$data_txt')";
            if($query=mysql_query($sql)){
             echo "成功存入数据库";
            }else echo "lose";

            // foreach ($number as $value) {
            //     echo $value."\n";
            //     fwrite($myfile, $value."\n");
            // }


        }
    
    }
    
    
    fclose($myfile);
    socket_close($sock);
    echo "关闭连接\n";
    
}

?>
