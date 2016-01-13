<?php 
//数组$data_out_db 为从数据库取出的频点数据

    include("../../lib/db.php");error_reporting(E_ALL & ~E_NOTICE);
    $datain=mysql_query("select data from spectrum where sid='$sid'");
    $row=mysql_fetch_array($datain);
    $data_out_db=explode(',',$row['data']);
   // echo $data_show[2];
   //echo count($data_show);
 ?>