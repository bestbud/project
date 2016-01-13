<!DOCTYPE html>
<?php  session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>设备管理</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" >
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/icon.png">

    <style type="text/css">
      li{font-size: 19px;
            }
    
    </style>
</head>
<body>
<div class="header">
    <div class="row-fluid">
        <div class="col-md-12 header" style="background-color:#6A5ACD;position:absolute;">  
        <h3 style="color:white">&nbsp;&nbsp;&nbsp;&nbsp;设备管理页</h3>
        </div>
    </div>
</div>
<div class="row-fluid">
    <br>
    <hr>
    <div class="col-md-2">
    &nbsp;&nbsp;<a href="userpage.php">返回用户主页</a>
        <ul>
        <li><a href="device/device01.php"target="container"onclick="#">设备01</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备02</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备03</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备04</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备05</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备06</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备07</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备08</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备09</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备10</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备11</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备12</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备13</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备14</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备15</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备16</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备17</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备18</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备19</a></li>
        <li><a href="device/devicex.php"target="container"onclick="#">设备20</a></li>
        </ul>
    </div>
    <div class="col-md-10">
        <div id="device_detail">
            <iframe width="100%" height="550px"class="" unselectable="on" name="container" id="container" src="device/device01.php">
                
            </iframe>
        </div>
    </div>
</div> 
<div class="row-fluid">
    <div class="col-md-12">   
    <?php include("include/footer.php") ?> 
    </div>
</div>
</body>
</html>