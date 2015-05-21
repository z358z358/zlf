<?php
include('include/session.php');
//include('include/w3.html');
include('include/config.php');
include('include/check.php');

	
	$ip=realip();
	$time=date("Y-m-d H:i:s",time()+8*60*60);
	$sid=session_id();
	$id=$_SESSION['id'];
	$sql="INSERT INTO `log` (`ID`, `TIME`, `ACT`, `IP`,`session_id`) 
                               VALUES ('$id','$time','out','$ip','$sid')";
							   
	if (mysql_query($sql,$link))
		{
				
	//echo "登出成功 5秒後返回首頁";	
	
  }
else 
	{
	//echo "error";
	//header("Refresh: 5 ; URL=http://localhost");
	}
header("Location:/");
session_destroy();
//header("Location: http://localhost");
mysql_close($link);
?>