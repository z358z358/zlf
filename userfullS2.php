<?php 
//include('include/w3.html');
include('include/session.php');
include('include/check.php');

//foreach($_POST as $var => $value)
//{
//echo $var.":".$value."<br>";
//}

$error=false;
foreach($_POST as $var => $value)
{
if(!checkStr($value))
$error=true;
}
//var_dump($_POST);

if(empty($_POST['captcha'])||empty( $_SESSION['turing_string'] )||($_POST['captcha']!=$_SESSION['turing_string'])||($_POST['agree']==0)||$error)
{
header("Location: userfullS1.php");
die();
}	
else
{
if(empty($_POST['name'])||empty($_POST['year'])||empty($_POST['month'])||empty($_POST['day'])||empty($_POST['sid']))
{
header("Location: userfullS1.php");
die();
}
else{


$sid=strtoupper($_POST['sid']);
$name=$_POST['name'];
$birthday=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
$error=true;

//check start
if(!empty($_POST['credit']))
{
$error&=checkcredit($_POST['credit']);
}
if(!empty($_POST['account'])&&!empty($_POST['bank']))
{
$error&=checkaccount($_POST['account']);
$error&=checkbank($_POST['bank']);
}



if(!check_twid($sid)||!checkdate($_POST['month'],$_POST['day'],$_POST['year'])||!checkname($name)||!$error)
{
header("Location: userfullS1.php");
die();
//goto fail;
}
else
{

//check end
include('include/config.php');
$sql="SELECT * FROM `data` WHERE `SID`='$sid'";
//echo $sql="INSERT INTO 'data' VALUES('$id','$password','$sid','$name','$birthday','$mail','$phone')";	
$result = mysql_query($sql,$link); 
if( mysql_num_rows($result)) 
{
mysql_close($link);
header("Location: userfullS1.php");
die();
}
else
{


$sql="UPDATE `account`.`data` SET `NAME`='".$name."',`BIRTHDAY`='".$birthday."',`SID`='".$sid."',`FULL`='1' WHERE `data`.`ID`='".$_SESSION['id']."'";
$sql2="INSERT INTO `account` (`ID`,`MONEY`) 
                           VALUES ('$_SESSION[id]','0')";	
$sql3="INSERT INTO `realaccount` (`ID`) 
                           VALUES ('$_SESSION[id]')";
						   

//echo $sql="INSERT INTO 'data' VALUES('$id','$password','$sid','$name','$birthday','$mail','$phone')";	

if (!mysql_query($sql,$link)||!mysql_query($sql2,$link)||!mysql_query($sql3,$link))
  {
  echo "資料庫寫入失敗，請稍候再試。";
  die();
  }
else 
	{
	{
if(!empty($_POST['bank'])&&!empty($_POST['account'])&&checkaccount($_POST['account'])&&checkbank($_POST['bank']))
{
$sql="UPDATE `account`.`realaccount` SET `NUMBER`='".$_POST['account']."',`BANK`='".$_POST['bank']."' WHERE `realaccount`.`ID`='".$_SESSION['id']."'";
mysql_query($sql,$link);
}


if(!empty($_POST['credit'])&&checkcredit($_POST['credit']))
{
$number=preg_replace('/\D/', '', $_POST['credit']);
$sql="UPDATE `account`.`realaccount` SET `CREDIT`='".$number."' WHERE `realaccount`.`ID`='".$_SESSION['id']."'";
mysql_query($sql,$link);
}
	
	include('include/w3.html');
	$title='註冊';
	include('include/header.php');
	?>
</header>
<body>
<div class="body center">
	<div class="logo floatL">
		<a href="http://www.zlf168.com/"><img src="images/logo.png" border="0" alt="首頁"></a>
	</div>
	<div class="clearboth" style="height:240px;width:1000px;background-color:#CDEAF7;background-image:url('images/certifybg.png');background-position:50% 50%;background-repeat:no-repeat;padding-top:100px">

	<b><p style="font-size: 150%;">恭喜成為正式會員！
	<p style="font-size: 150%;margin-top:50px;margin-bottom:50px;">將享有所有功能！</p>
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
	//header("Refresh: 1 ; URL=http://localhost");
	}
//fail:
mysql_close($link); 
}
}
}
}
?> 