<?php
header("Content-type: text/xml");  
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";  

    $sid = $_REQUEST['sid'];
    include("../../lib/db.php");error_reporting(E_ALL & ~E_NOTICE);
    $datain=mysql_query("select * from spectrum where sid='$sid'");
    

    //向客户端返回XML文件 含频谱相关所有数据
    echo "<spectrum>";
    $row=mysql_fetch_array($datain);
    do{
        echo "<sid>".$row['sid']."</sid>";
        echo "<uid>".$row['uid']."</uid>";
        echo "<did>".$row['did']."</did>";
        echo "<f0>".$row['f0']."</f0>";
        echo "<bw>".$row['bw']."</bw>";
        echo "<g>".$row['g']."</g>";
        echo "<nfft>".$row['nfft']."</nfft>";
        echo "<data>".$row['data']."</data>";
        echo "<create_time>".$row['create_time']."</create_time>";
    }while($row=mysql_fetch_array($datain));
    echo"</spectrum>";
                
    // $data_out_db=explode(',',$row['data']); 
    // $data_out=implode(',',$data_out_db);   

    mysql_close($GLOBALS['DB']);
?>