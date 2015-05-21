<?php 
//include('include/session.php');
//include('include/w3.html');
include('include/check.php');

//foreach($_POST as $var => $value)
//{
//echo $var.":".$value."<br>";
//}
//var_dump($_POST);
$error=false;
foreach($_POST as $var => $value)
{
if(!checkStr($value))
$error=true;
}

if($error)
{
header("Location: userinfo.php");

}	
else
{
include('include/config.php');
if(empty($_POST['mail'])&&empty($_POST['phone'])&&empty($_POST['address'])&&empty($_POST['county'])&&empty($_POST['district'])&&empty($_POST['zipcode'])
&&empty($_POST['fixphone'])&&empty($_POST['account'])&&empty($_POST['credit'])&&$_FILES['Faccount']['error']&&$_FILES['Fcredit']['error'])
{
header("Location: userinfo.php");


}


else{


if(!empty($_POST['mail'])&&checkemail($_POST['mail']))
{
$sql="UPDATE `account`.`data` SET `MAIL`='".$_POST['mail']."',`MAILACT` =0 WHERE `data`.`ID`='".$_SESSION['id']."'";
mysql_query($sql,$link);

error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

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

$mail->SetFrom('gogeili.service@gmail.com', '客服 人員');

//$mail->AddReplyTo("onininonwork@gmail.com","First Last");

$mail->Subject    = "認證信";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

//$mail->MsgHTML($body);
$mail->Body=
"<body>
感謝".$_SESSION['name']."：<br>
請點以下連結來認證您的信箱：<a href=".$_SERVER['HTTP_HOST']."/act.php?account=".$_SESSION['id']."&act=".sha1($_POST['mail']).">我收到信了</a>
或直接輸入網址<br>
http://".$_SERVER['HTTP_HOST']."/act.php?account=".$_SESSION['id']."&act=".sha1($_POST['mail'])."
</body>
";

//$address = "onininonwork@gmail.com";
$mail->AddAddress($_POST['mail'], $_SESSION['name']);

//$mail->AddAttachment("/mail/images/phpmailer.gif");      // attachment
//$mail->AddAttachment("/mail/images/phpmailer_mini.gif"); // attachment

$mail->Send();

}
if(!empty($_POST['phone'])&&checkphone($_POST['phone']))
{
$sql="UPDATE `account`.`data` SET `PHONE`='".$_POST['phone']."' WHERE `data`.`ID`='".$_SESSION['id']."'";
mysql_query($sql,$link);
}
if(!empty($_POST['fixphone'])&&checkfixphone($_POST['fixphone']))
{
$sql="UPDATE `account`.`data` SET `FIXPHONE`='".$_POST['fixphone']."' WHERE `data`.`ID`='".$_SESSION['id']."'";
mysql_query($sql,$link);
}

if(!empty($_POST['county'])&&!empty($_POST['district'])&&!empty($_POST['zipcode'])&&!empty($_POST['address']))
{
$sql="UPDATE `account`.`data` SET `COUNTY`='".$_POST['county']."',`DISTRICT`='".$_POST['district']."',`ZIP`='".$_POST['zipcode']."',`ADDRESS`='".$_POST['address']."' WHERE `data`.`ID`='".$_SESSION['id']."'";
mysql_query($sql,$link);
}

if(!empty($_POST['fixphone'])&&checkfixphone($_POST['fixphone']))
{
$sql="UPDATE `account`.`data` SET `FIXPHONE`='".$_POST['fixphone']."' WHERE `data`.`ID`='".$_SESSION['id']."'";
mysql_query($sql,$link);
}

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


if 
(
(($_FILES["Faccount"]["type"] == "image/gif")|| ($_FILES["Faccount"]["type"] == "image/jpg")|| ($_FILES["Faccount"]["type"] == "image/png"))
&& ($_FILES["Faccount"]["size"] < 100001)
&& !($_FILES["Faccount"]["error"])
)
{
  $id=$_SESSION["id"];
  $time=date("Ymd",time()+8*60*60);
  $ip=realip();
  $sid=$type=explode("/",$_FILES["Faccount"]["type"]);
  $act="up";
  move_uploaded_file($_FILES["Faccount"]["tmp_name"],"upload/" . $_SESSION["id"]."_B_".$time.".".$type[1]); 
  $time=date("Y-m-d H:i:s",time()+8*60*60);  
  $sql="INSERT INTO `log` (`ID`, `TIME`, `ACT`, `IP`,`session_id`) 
                               VALUES ('$id','$time','$act','$ip','$sid[1]')";
  mysql_query($sql,$link);
}
else
{
  echo "上傳檔案失敗";
}

if 
(
(($_FILES["Fcredit"]["type"] == "image/gif")|| ($_FILES["Fcredit"]["type"] == "image/jpg")|| ($_FILES["Fcredit"]["type"] == "image/png"))
&& ($_FILES["Fcredit"]["size"] < 100001)
&& !($_FILES["Fcredit"]["error"])
)
{
  $id=$_SESSION["id"];
  $time=date("Ymd",time()+8*60*60);
  $ip=realip();
  $sid=$type=explode("/",$_FILES["Fcredit"]["type"]);
  $act="up";
  move_uploaded_file($_FILES["Fcredit"]["tmp_name"],"upload/" . $_SESSION["id"]."_C_".$time.".".$type[1]);  
  $time=date("Y-m-d H:i:s",time()+8*60*60);
  $sql="INSERT INTO `log` (`ID`, `TIME`, `ACT`, `IP`,`session_id`) 
                               VALUES ('$id','$time','$act','$ip','$sid[1]')";
  mysql_query($sql,$link);
}
else
{
  echo "上傳檔案失敗";
}


header("Location: userinfo.php");
mysql_close($link); 
}
}
?> 