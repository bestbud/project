<?php 
include("../db.php");error_reporting(E_ALL & ~E_NOTICE); 
$xy=$buf;
$did=1;
$x=;
$y=;

$sql = "insert into `spectrum_1` ('did,'x','y','xy') values ('$did','$x','$y','$xy')";

$query_insert=mysql_query($sql);

 ?>
