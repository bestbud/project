<?php
    $sid = $_REQUEST['sid'];
    include("../../lib/db.php");error_reporting(E_ALL & ~E_NOTICE);
    $datain=mysql_query("select * from spectrum where sid='$sid'");
    

    //向客户端返回json文件 含频谱相关所有数据

    $row=mysql_fetch_array($datain);
    do{ 
        $data=explode(",",$row['data']);
        for ($i=0; $i <count($data) ; $i++) { 
            $data[$i]=(double)$data[$i];
        }
        $arr=array(
            'create_time'=>$row['create_time'],
            'g'=>$row['g'],
            'f0'=>(double)$row['f0'],
            'bw'=>(double)$row['bw'],
            'nfft'=>(int)$row['nfft'],
            'data'=>$data
            );
        echo $string=json_encode($arr);
        // $str=json_decode($string);
        // print_r($str);

    }while($row=mysql_fetch_array($datain));
                
    // $data_out_db=explode(',',$row['data']); 
    // $data_out=implode(',',$data_out_db);   

    mysql_close($GLOBALS['DB']);
?>