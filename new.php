<?php 
include('include/sessionno.php');
//include('include/w3.html');
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

if(empty($_POST['captcha'])||empty( $_SESSION['turing_string'] )||($_POST['captcha']!=$_SESSION['turing_string'])||($_POST['agree']==0)||$error)
{
header("Location: register.php");
die();
}	
else
{
if(empty($_POST['id'])||empty($_POST['password'])||empty($_POST['name'])||empty($_POST['year'])||empty($_POST['month'])||
empty($_POST['day'])||empty($_POST['mail'])||empty($_POST['phone'])||empty($_POST['address'])||empty($_POST['sid'])||
empty($_POST['repassword'])||empty($_POST['county'])||empty($_POST['district'])||empty($_POST['zipcode']))
{
header("Location: register.php");
die();
}


else{

$id=$_POST['id'];
$sid=strtoupper($_POST['sid']);
$password=$_POST['password'];
$name=$_POST['name'];
$birthday=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
$umail=$_POST['mail'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$county=$_POST['county'];
$district=$_POST['district'];
$zip=$_POST['zipcode'];
$fixphone=(isset($_POST['fixphone']))?$_POST['fixphone']:0;

//check start


if($password!=$_POST['repassword']||!check_twid($sid)||!checkemail($umail)||!checkid($id)||!checkdate($_POST['month'],$_POST['day'],$_POST['year'])||!checkphone($phone)||($fixphone&&!checkfixphone($fixphone))||!checkname($name)||!checkpassword($password))
{

header("Location: register.php");
die();
//goto fail;
}
else
{

//check end
include('include/config.php');
$sql="SELECT * FROM `data` WHERE `SID`='$sid'";
$sql2="SELECT * FROM `data` WHERE `ID`='$id'";
//echo $sql="INSERT INTO 'data' VALUES('$id','$password','$sid','$name','$birthday','$mail','$phone')";	
$result = mysql_query($sql,$link); 
$result2 = mysql_query($sql2,$link); 
if( mysql_num_rows($result)||mysql_num_rows($result2)) 
{
mysql_close($link);
header("Location: register.php");
die();
}
else
{
$password=sha1($password);
$date=date("Y-m-d",time()+8*60*60);
$sql="INSERT INTO `data` (`ID`,`SID`, `PASSWORD`, `NAME`, `BIRTHDAY`, `MAIL`, `PHONE`,`FIXPHONE`,`ZIP`,`COUNTY`,`DISTRICT`,`ADDRESS`,`CREATE`) 
                           VALUES ('$id','$sid','$password','$name','$birthday','$umail','$phone','$fixphone','$zip','$county','$district','$address','$date')";
$sql2="INSERT INTO `account` (`ID`,`MONEY`) 
                           VALUES ('$id','0')";		
$sql3="INSERT INTO `realaccount` (`ID`) 
                           VALUES ('$id')";						   

//echo $sql="INSERT INTO 'data' VALUES('$id','$password','$sid','$name','$birthday','$mail','$phone')";	

if (!mysql_query($sql,$link)||!mysql_query($sql2,$link)||!mysql_query($sql3,$link))
  {
  die();
  }
else 
	{


//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');
include('include/setting.php');
require_once('mail/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

//$body             = file_get_contents('mail/contents.php');
//$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "gogeili.service@gmail.com";  // GMAIL username
$mail->Password   = "29039291";            // GMAIL password
$mail->CharSet    = 'utf-8';

$mail->SetFrom($service_email, '客服 人員');

//$mail->AddReplyTo("onininonwork@gmail.com","First Last");

$mail->Subject    = "認證信";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

//$mail->MsgHTML($body);
$mail->Body=
"<body>
感謝".$name."<br>
請點以下連結來認證您的信箱：<a href=".$_SERVER['HTTP_HOST']."/act.php?account=".$id."&act=".sha1($umail).">我收到信了</a>
或直接輸入網址<br>
http://".$_SERVER['HTTP_HOST']."/act.php?account=".$id."&act=".sha1($umail)."
</body>
";

//$address = "onininonwork@gmail.com";
$mail->AddAddress($umail, $name);

//$mail->AddAttachment("/mail/images/phpmailer.gif");      // attachment
//$mail->AddAttachment("/mail/images/phpmailer_mini.gif"); // attachment

$mail->Send();

if(!empty($_POST['bank'])&&!empty($_POST['account'])&&checkaccount($_POST['account'])&&checkbank($_POST['bank']))
{
$sql="UPDATE `account`.`realaccount` SET `NUMBER`='".$_POST['account']."',`BANK`='".$_POST['bank']."' WHERE `realaccount`.`ID`='".$id."'";
mysql_query($sql,$link);
}


if(!empty($_POST['credit'])&&checkcredit($_POST['credit']))
{
$number=preg_replace('/\D/', '', $_POST['credit']);
$sql="UPDATE `account`.`realaccount` SET `CREDIT`='".$number."' WHERE `realaccount`.`ID`='".$id."'";
mysql_query($sql,$link);
}


/*	if(!$mail->Send()) 
	{
		echo "Mailer Error: " . $mail->ErrorInfo;
	}
	else */
	{
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

	<b><p style="font-size: 150%;">認證信已寄出：
	<?php
	echo $umail;
	?></p>
	<p style="font-size: 150%;margin-top:50px;margin-bottom:50px;">電子信箱認證成功才可以登入會員</p>
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