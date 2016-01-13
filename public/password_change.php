<!DOCTYPE html>
<?php  include("../lib/db.php");error_reporting(E_ALL & ~E_NOTICE); 
include("../lib/authcode.php");error_reporting(E_ALL & ~E_NOTICE); 
?>
<?php  session_start(); ?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>密码修改</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" >
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css" >
	<link rel="shortcut icon" href="img/icon.png">

	<style type="text/css">
      body {background-image:url(#);background-repeat:no-repeat; background-attachment:fixed;}
      form{margin-left:30%; margin-top:5%;}
      h4{margin-left: 8%;}
      .warning{color: red;
      	text-align: center;
      }
      .success{color:green;
      	text-align: center;
      }
    </style>
    <script>
	function showpassword_onclick(i){
		if(i==1){//判断是哪个密码框
			var btn_id="showoldpw";
			var input_id="password";
		}
		else{
			var btn_id="shownewpw";
			var input_id="new_password";
		}
		var val=document.getElementById(btn_id).innerHTML;//<button>元素按键上的文字为 innerHTML属性；<input type="button">按键文字为value属性

		if(val=="显示"){
			document.getElementById(input_id).type="text";
			document.getElementById(btn_id).innerHTML="隐藏";
		}
		else{
			document.getElementById(input_id).type="password";
			document.getElementById(btn_id).innerHTML="显示";
		}

	}
	</script>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="navbar ">
				<div class="navbar-inner">
					<a href="userpage.php" class="navbar-form pull-right">返回个人主页</a>
					<p class="navbar-form pull-right">Welcome <a href="user_info_edit.php"><?php echo $_SESSION['username'];?></a></p>
			    </div> 
		    </div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="#" id="regdiv" name="regdiv">
			<form class="form-horizontal" method="post" action="" >
			  	<h4>密码修改</h4>
			  	<div class="form-group">
			    	<label class="col-sm-2 control-label" for="password">原&nbsp;密&nbsp;&nbsp;码</label>
			    	<div class="col-sm-4">
			      		<input type="password" class="form-control"  name="password" id="password" placeholder="Password">
			   		</div>
			   		<div class="col-sm-2">
			        	<button type="button" class="btn btn-default btn-sm" id="showoldpw"onclick="showpassword_onclick(1);"value="0">显示</button>		     
			      	</div>
			 	</div>
			  	<div class="form-group">
			    	<label class="col-sm-2 control-label" for="new_password">新&nbsp;密&nbsp;&nbsp;码</label>
			    	<div class="col-sm-4">
			      		<input type="password" class="form-control" name="new_password"id="new_password" placeholder="New Password">
			   		</div>
			   		<div class="col-sm-2">
			        	<button type="button" class="btn btn-default btn-sm" id="shownewpw"onclick="showpassword_onclick(2);"value="0">显示</button>		     
			      	</div>
			 	</div>
			    <div class="form-group">
			    	<label class="col-sm-2 control-label">确认密码</label>
			    	<div class="col-sm-4">
			      		<input type="password" class="form-control" id="new_password2"name="new_password2" placeholder="New Password Again">
			    	</div>
			    </div>
			    <div class="form-group">
			      <div class="col-sm-offset-2 col-sm-10">
			        <button type="submit" name="submit"class="btn btn-default" onclick="#">修&nbsp;&nbsp;改</button>		     
			      </div>
			     </div>
			</form>
			<?php 

			if($_POST[submit]||isset($_POST[submit])){
				if(empty($_POST[password])||empty($_POST[new_password])||empty($_POST[new_password2])){
					?>
                     <p class="warning">请填写完整！</p>
                     <script>
                     document.getElementById('password').focus();
                     </script>
					<?php	
				}
				else{

					$uid=$_SESSION['uid'];
					$sql="select * from t_user where uid=$uid";
					$query=mysql_query($sql);
					//if($query)echo 1;else echo 0;
					$array=mysql_fetch_array($query);
					//if($array)echo 1;else echo 0;					
					if($array){
						$username=$array[username];
	        			$str =$array['password'];
			            $key =$array['username'];
			           // $act1 = "ENCODE";
			            $act = "DECODE";

			            $password=authcode($str,$act,$key,0);//解密
			            /*数据表中的password原为32位，存不下加密后的密码，已改为100*/
			            //echo authcode($password,"DECODE",$key,100)."<br>";
			            //echo $str."<br>"."/".$key."<br>"."/".$password."<br>";
			            //echo $_POST['password']."<br>";
			            //$mw=authcode('1234',$act1,$key,100);
			            // echo $mw."<br>"."/".authcode( $mw,$act2,$key,100);
	            	    //$exist2=$exist?md5(trim($_POST['password']))==$array['password']:FALSE;//判断密码 row数组的键值对应的列名是区分大小写的
	            		
		           		if($password==$_POST['password']){
		           			//echo "原密码正确".$password;
					 		$password1 = (isset($_POST['new_password'])) ? $_POST['new_password'] : '';
		    				$password2 = (isset($_POST['new_password2'])) ? $_POST['new_password2'] : '';
		    				if($password1 && $password1 == $password2){
								$str = $password1;
					            $key =$username;
					            $act = "ENCODE";
					            //$act2 = "DECODE";
					            $password=authcode($str,$act,$key,0);//以用户名为秘钥对密码进行加密
					            //echo authcode($password,"DECODE",$key,100)."<br>".$password1;
					            $query_update=mysql_query("update `t_user` set password='$password' where uid=$uid");
					            //if($query_update)echo "password updated!";else echo "email not updated!";

					            ?>
					              <p class="success">密码修改成功<a href="userpage.php">返回个人主页</a></p>
					              <meta http-equiv=refresh content='5; url=userpage.php'>       

					            <?php

		    				}
							else{
					           	?>
					               <p class="warning">新密码两次输入不一致，请重新输入</p>
					               <form><input type="hidden" id="password_hidden" name="password_hidden"value="<?php echo $password;?>"></form>
					               <script>
			                        document.getElementById('new_password').focus();
			                        document.getElementById('password').value=document.getElementById('password_hidden').value;
			                        
			                       </script> 
					            <?php exit();
				        	}
		           		}
		           		else{
				           	?>
		                     <p class="warning">原密码错误!重新写或<a href="get_password.php">找回原密码</a></p>
		                     <script>
		                     document.getElementById('password').focus();
		                     </script>
							<?php		
		           		}
		           	}
		           else{}
				}
		          
			}	
			?>
		</div>
	</div>
</div>	
</body>
</html>