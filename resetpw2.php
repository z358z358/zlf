<?php
if (empty($_POST['account'])||empty($_POST['mail'])||empty($_POST['password'])||empty($_POST['repassword'])
	||empty($_POST['act'])||$_POST['password']!=$_POST['repassword']) 
{
header("Location: index.php");
die();
}
else
{	include('include/check.php');
	$error=false;
	foreach($_POST as $var => $value)
	{
	if(!checkStr($value))
	$error=true;
	}
	$id=$_POST['account'];
	$umail=$_POST['mail'];
	$act=$_POST['act'];
	include('include/config.php');
	$sql="SELECT * FROM `data` WHERE `ID`='$id' AND `MAIL`='$umail'";
	$rows=mysql_query($sql,$link);
	if(!mysql_num_rows($rows)||$error||!checkid($id)||!checkemail($umail)||!checkpassword($_POST['password']))
	{
		mysql_close($link);
		//echo "Location: resetpw.php?account=".$id."&act=".$act."&error=1";
		
		header("Location: resetpw.php?account=".$id."&act=".$act."&error=1");
		die();
	}
	else 
	{
		$row = mysql_fetch_assoc($rows);
		if($act==sha1($row['PASSWORD']))
		{
		$sql2="UPDATE `data` SET  `PASSWORD` =  '".sha1($_POST['password'])."' WHERE  `data`.`ID` =  '$id'";
		if(mysql_query($sql2,$link))
		{
			include('include/w3.html');
			$title='重設密碼';
			include('include/header.php');
	?>
</header>
<body>
<div class="body center">
	<div class="logo floatL">
		<a href="http://www.zlf168.com/"><img src="images/logo.png" border="0" alt="首頁"></a>
	</div>
	<div class="clearboth" style="height:240px;width:1000px;background-color:#CDEAF7;background-image:url('images/certifybg.png');background-position:50% 50%;background-repeat:no-repeat;padding-top:100px">

	<b>
	<p style="font-size: 150%;margin-top:50px;margin-bottom:50px;">重設密碼成功！</p>
	<a href="http://www.zlf168.com/"><img src="images/backindex.png"></a></b>

	</div>
	<div class="clearboth">
	<?php 
	include('include/foot.html');
	?>
	</div>
</div>
</body>
</html>
			
		<?php
		
		}
		
		else
		echo "資料庫忙碌中 更改密碼失敗";
		}
		else
		{
		header("Location: resetpw.php?account=".$id."&act=".$act."&error=2");
		die();
		}
		mysql_close($link); 
		
	}
	
}
?>