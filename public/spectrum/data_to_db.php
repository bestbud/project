<?php 
    $myfile=fopen("data.txt","r");
    $head=fgets($myfile);//第一个数
    $f0=(double)fgets($myfile);//中心频率了 单位MHZ
    $bw=(double)fgets($myfile);//是带宽 单位HZ
    $g=(double)fgets($myfile);//硬件增益  
    $nfft=(double)fgets($myfile);//是fft的长度

    $data=array(); //$nfft个频点数据，计算好的可直接用户图表显示
    $i=0;
    while(!feof($myfile)){
        $spot=(double)fgets($myfile);
        // $spot=10*(log10($spot)+2*log10(1.8)-2*log10($nfft)-2*log10(512))-$g;
        $spot=10*(log10($spot)-2*log10($nfft))-$g;
        $data[$i++]=$spot;
    }

    if(($length=count($data))!=$nfft)echo "length error!";
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


    echo $data_txt=implode(',',$data);//数组转字符串
    echo "<br>";
//存入数据库
    include("../../lib/db.php");error_reporting(E_ALL & ~E_NOTICE);
    $sql = "insert into `spectrum` (`f0`,`bw`,`g`,`nfft`,`data`) values ('$f0','$bw','$g','$nfft','$data_txt')";
    if($query=mysql_query($sql)){
     echo "成功存入数据库";
    }else echo "lose";

 ?>