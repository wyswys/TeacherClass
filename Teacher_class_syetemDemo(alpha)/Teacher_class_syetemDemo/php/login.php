<?php 
require dirname(__DIR__).'/lib/functions.php';
session_start();
$name = $_POST["login-user"];
$_SESSION["temp"][0]=$name;
$pwd = $_POST["login-password"];
$idf = $_POST["ident"];
$jud=0;
echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
$con = get_db();
if($idf=="teacher")//教师类型身份验证
{
	$result = mysql_query("SELECT * FROM user_teacher");
	while($row = mysql_fetch_array($result))
	{
		if($row['workNumber']== $name&&$row['password']== $pwd)
		{
			jump_success("登录成功", '../html/teacher/teacher_table_overview/index.php');
			
		}

	}
	if($jud==0)
	{
		jump_error('账号或密码错误！');
	}

}

if($idf=="department_head")//系负责人类型身份验证
{
	$result = mysql_query("SELECT * FROM user_department_head");
	while($row = mysql_fetch_array($result))
	{
		if($row['workNumber']== $name&&$row['password']== $pwd)
		{
			jump_success("登录成功", '../html/department_head/department_head-index');

		}

	}
	if($jud==0)
	{
		jump_error('账号或密码错误！');
	}

}

if($idf=="teaching_office")//教学办类型身份验证
{
	$result = mysql_query("SELECT * FROM user_teaching_office");
	while($row = mysql_fetch_array($result))
	{
		if($row['workNumber']== $name&&$row['password']== $pwd)
		{
			jump_success("登录成功", '../html/teaching_office/teaching_office-index.php');

		}

	}
	if($jud==0)
	{
		jump_error('账号或密码错误！');
	}

}	
?>
