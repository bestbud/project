<!DOCTYPE html>
<?php  include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); 
include("../lib/authcode.php");error_reporting(E_ALL & ~E_NOTICE);
?>
<?php  session_start(); ?>
<?php //注册跳转后自动填充用户名
if(!empty($_SESSION['username'])){$reg_username=$_SESSION['username'];}else{$reg_username='';}
//if(!empty($_SESSION['password'])){$reg_password=$_SESSION['password'];}else{$reg_password='Password';}
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=8XlluTBXpUYwcdzDHV3XcdMz"></script>
	<title>用户登录</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" >
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css" >
	<link rel="shortcut icon" href="img/icon.png">
	<style type="text/css">
      body {background-image:url(#);background-repeat:no-repeat; background-attachment:fixed;}
      form { margin-top: 5%; 
      	     margin-left:30%;
      	     padding:2%;
      		}
      h4{margin-left:5%;}
      .warning{color: red;
      	text-align: center;
      }
      .success{color:green;
      	text-align: center;
      }

    </style>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="#">
			<div class="navbar ">
				<div class="navbar-inner">
					<a href="index.php" class="navbar-form pull-right">返回首页</a>
			    </div> 
		    </div>
		</div>
	</div>
    <div class="row-fluid">
		<div class="#">
			<form class="form-horizontal" method="post">
			  	<h4>用户登录</h4>
			  <div class="form-group">
			    <label class="col-sm-2 control-label">用&nbsp;&nbsp;户&nbsp;&nbsp;名</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="loginid" name="loginid" placeholder="Email/Username"value="<?php echo $reg_username?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-2 control-label">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</label>
			    <div class="col-sm-4">
			      <input type="password" class="form-control" id="password"name="password" >
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <div class="checkbox">
			        <label>
			          <input type="checkbox" id="remember_me" name="remember_me">记住我
			        </label>
			      </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" name="submit"class="btn btn-default">登&nbsp;&nbsp;&nbsp;&nbsp;录</button>
			      &nbsp;&nbsp;&nbsp;&nbsp;
			      <a href="get_password.php"><button type="button" name="get_password" id="get_password"class="btn btn-default">找回密码</button></a>
			      &nbsp;&nbsp;&nbsp;&nbsp;
			      <a href="register.php"><button type="button" name="login_link" id="login_link"class="btn btn-default">用户注册</button>
</a>
			    </div>
			  </div>
			</form>
			<?php
				if($_POST[submit]||isset($_POST[submit])){
	  				$loginid=$_POST['loginid'];
	     			$sql="select * from t_user  where username='$loginid' or email='$loginid'";
	     			$query=mysql_query($sql);
	        		$exist=is_array($row=mysql_fetch_array($query));//判断是否存在这样一个用户 


					if($exist){
	        			$str =$row['password'];
			            $key =$row['username'];
			           // $act1 = "ENCODE";
			            $act = "DECODE";

			            $password=authcode($str,$act,$key,0);//解密
			            /*数据表中的password原为32位，存不下加密后的密码，已改为100*/
			            //echo authcode($password,"DECODE",$key,100)."<br>";
			            //echo $str."<br>"."/".$key."<br>"."/".$password."<br>";
			            //echo $_POST['password']."<br>";
			            //$mw=authcode('1234',$act1,$key,100);
			            // echo $mw."<br>"."/".authcode( $mw,$act2,$key,100);
	            	    //$exist2=$exist?md5(trim($_POST['password']))==$row['password']:FALSE;//判断密码 row数组的键值对应的列名是区分大小写的
	            		
		           		if($password==$_POST['password']){
		                  $_SESSION['uid']=$row['uid']; // session赋值
		               	  $_SESSION['username']=$row['username'];
		                  //$_SESSION['user_shell']=md5($row['username'].$row['password']);
		                  //echo  $_SESSION['username'];
		               
		                  // if( $_POST['remember_me']=="on"){}else{} //checkbox是否选中
		                 
		               
						    //判断账号是否已被激活
		                    $status=$row['status'];
		                    if($status){
			                    ?>
			                 	<p class="success">登录成功！马上跳转至个人主页……</p><br/>
			                	<meta http-equiv=refresh content='2; url=userpage.php'>       
			               		 <?php
		                    }
		                    else{
		                     	?>
			                 	<p class="success">您的账号尚未激活，账号激活页面<a href="activate.php">邮箱激活</a><br>将跳转到个人主页……</p><br/>
			                	<meta http-equiv=refresh content='2; url=userpage.php'>       
			               		 <?php	
		                    }


						  }	
						else{
						?>
							 <p class="warning">用户名或密码不正确！</p>

						<?php SESSION_DESTROY();  }  
					}
					else{
						?>
							 <p class="warning">用户名不存在</p>

						<?php SESSION_DESTROY(); 
					}		
			   }  
			?>
		</div>
	</div>
</div>	
</body>
</html>