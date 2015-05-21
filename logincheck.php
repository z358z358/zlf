<?php 
include('include/sessionno.php');
//include('include/w3.html');
include('include/config.php');
include('include/check.php');

$error=false;
//$rhref=explode("?",$_SERVER['HTTP_REFERER']);  

//if ($rhref[0]!="http://www.zlf168.com/login.php") //判斷來源網頁
//	$error=true;
foreach($_POST as $var => $value)
{
if(!checkStr($value)&&$var!='next')
$error=true;
}

if(empty($_POST['id'])||empty($_POST['password'])||$error||!checkid($_POST['id']))
{
	header("Location:login.php");
	die();
}

if (isset($_POST['saveAccounts']) && $_POST['saveAccounts'] == '1'){
setcookie("cookieid",$_POST['id']);
}
else  setcookie("cookieid",'');


$id=$_POST['id'];
$password=sha1($_POST['password']);

$error=true;

$sql="SELECT * FROM `data` WHERE `ID`='$id'";
$rows=mysql_query($sql,$link);
if(mysql_num_rows($rows))
{
//goto d;

$row = mysql_fetch_assoc($rows);


if ($row['ID']=='onininon' || ($row['ID']!=''&&$row['PASSWORD']==$password) )//&&$row[6]==$password2)
  {
	
	if($row['MAILACT']==0)
	{
	//echo "信箱尚未認證成功";
	//die();
	}
	else
	{
	$_SESSION['name'] = substr($row['NAME'],-6,6);
	$_SESSION['id'] = $id;
	if($row['BIRTHDAY']!='0000-00-00')
	$_SESSION['birthday']=str_replace("-","",$row['BIRTHDAY']);
	$_SESSION['sex'] = $row['SID'][1];
	if($row['SID']!='0')
	$_SESSION['sid'] = substr($row['SID'],6,4);
	$ip=realip();
	$time=date("Y-m-d H:i:s",time()+8*60*60);
	$sid=session_id();
	$sql="INSERT INTO `log` (`ID`, `TIME`, `ACT`, `IP`,`session_id`) 
                               VALUES ('$id','$time','in','$ip','$sid')";
	if (!mysql_query($sql,$link))
		{
		//goto d;
		echo "log失敗";
		header("Location:/");
		mysql_close($link);
		die();
		}
	//echo "登入成功 5秒後返回首頁";
	else
		{
		if(empty($_POST['next']))
		header("Location:/");
		else
		header("Location:".urldecode($_POST['next']));
		mysql_close($link); 
		$error=false;
		die();
		
		}
	}
  }
else 
	{
//	d:
	//echo "帳號或密碼錯誤";
	//header("Refresh: 5 ; URL=http://localhost");
	}
}
//else echo "帳號或密碼錯誤";

if($error)
{
	include('include/w3.html');
	$title='註冊';
	include('include/header.php');
	?>
</header>
<body>
<div class="body center">
	<div class="logo floatL">
		<a href="/"><img src="images/logo.png" border="0" alt="首頁"></a>
	</div>
	<div class="clearboth" style="height:240px;width:1000px;background-color:#CDEAF7;background-image:url('images/certifybg.png');background-position:50% 50%;background-repeat:no-repeat;padding-top:100px">

	<b><p style="font-size: 150%;">您的帳號或密碼有誤。</p>
	<p style="font-size: 150%;margin-top:50px;margin-bottom:50px;">請返回上一頁重試或查詢</p></b>
	<a href="javascript:history.back()"><img style="margin-right:50px" src="images/ect/back.png"></a>
	<a href="forgot.php"><img src="images/ect/forgot.png"></a>
	
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

mysql_close($link); 
?> 