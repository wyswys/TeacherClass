<?php 
$name = $_POST["login-user"]; 
session_start();
$_SESSION["temp"][0]=$name;
$pwd = $_POST["login-password"];
$idf = $_POST["ident"];
$jud=0;
$con = mysql_connect("localhost","root","");
	if (!$con)
  	{
  		die('Could not connect: ' . mysql_error());
  	}
  	else
  	{
  		mysql_select_db("teacher_class_system", $con);//连接到数据库
			if($idf=="teacher")//教师类型身份验证
	  		{
		  		$result = mysql_query("SELECT * FROM user_teacher");
				while($row = mysql_fetch_array($result))
			   {
			  	 	if($row['work_number']== $name&&$row['password']== $pwd)
						{
							echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
							echo"
							<script>
							window.location.href='../html/teacher/teacher-index.php'</script>";
							$jud=1;
							
						}

			   }
			  if($jud==0)
				 {
					echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
					echo"
					<script>alert('账号或密码错误！');
					window.location.href='../html/login.html'</script>";
				}
	
			 }
			 if($idf=="manager")//管理员类型身份验证
	  		{
		  		$result = mysql_query("SELECT * FROM user_manager");
				while($row = mysql_fetch_array($result))
			   {
			  	 	if($row['work_number']== $name&&$row['password']== $pwd)
						{
							echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
							echo"
							<script>
							window.location.href='../html/manager/manager-index.php'</script>";
							$jud=1;
							
						}

			   }
			  if($jud==0)
				 {
					echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
					echo"
					<script>alert('账号或密码错误！');
					window.location.href='../html/login.html'</script>";
				}
	
			 }
			
			
			
	   
	   		
	   
	

  	}
?>
