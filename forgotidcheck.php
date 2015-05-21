<?php 
include('include/sessionno.php');
//include('include/w3.html');
include('include/check.php');


if(empty($_POST['sid'])||empty($_POST['mail']))
{
header("Location: forgotid.php?error=1");
die();
}
else{
$sid=strtoupper($_POST['sid']);
$umail=$_POST['mail'];

//check start


if(!check_twid($sid)||!checkemail($umail))
{
header("Location: forgotid.php?error=1");
die();
//goto fail;
}
else
{

//check end
include('include/config.php');
$sql="SELECT * FROM `data` WHERE `SID`='$sid' AND  `MAIL` =  '$umail'";
//echo $sql="INSERT INTO 'data' VALUES('$id','$password','$sid','$name','$birthday','$mail','$phone')";	
$rows=mysql_query($sql,$link);



if(!mysql_num_rows($rows))
	{
		mysql_close($link); 
		header("Location: forgotid.php?error=1");
		die();
	}
else
	{
	$row = mysql_fetch_assoc($rows);
	
	if(!$row['MAILACT'])
	{
		mysql_close($link); 
		header("Location: forgotid.php?error=2");
		die();
	}
	else if(strpos($row['ID'], '@')!==false)
	{
	$id_token=explode("@",$row['ID']);
	echo "此帳號為$id_token[1]帳號，帳號密碼並非Go給利管理，請聯絡$id_token[1]。";
	die();
	}
	else
	{
	
//error_reporting(E_ALL);
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
$mail->IsHTML(true);
$mail->SetFrom('gogeili.service@gmail.com', '客服 人員');

//$mail->AddReplyTo("onininonwork@gmail.com","First Last");

$mail->Subject    = "Go給利會員：查詢帳號信件";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

//$mail->MsgHTML($body);
$mail->Body=
"<body>
".$row['NAME']."您好<br>
您的帳號為：".$row['ID']."
</body>
";

//$address = "onininonwork@gmail.com";
$mail->AddAddress($umail,$row['NAME']);

//$mail->AddAttachment("/mail/images/phpmailer.gif");      // attachment
//$mail->AddAttachment("/mail/images/phpmailer_mini.gif"); // attachment


	if(!$mail->Send()) 
	{
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
		$mail_token=explode("@",$umail);
		include('include/w3.html');
		$title='申請成功';
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
	<p style="font-size: 150%;">查詢帳號信已寄出：
	<?php
	echo $umail;
	?></p>
	<p style="font-size: 150%;margin-top:50px;margin-bottom:50px;">請到信箱內查看，<a href="http://www.google.com.tw/#hl=zh-TW&q=<?php echo $mail_token[1];  ?>&oq=<?php echo $mail_token[1];  ?>" >在Google上搜尋<?php echo $mail_token[1];  ?></a></p>
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


	

	//echo "<br>申請成功<br><a href='http://www.zlf168.com/'>回首頁</a>";
	//header("Refresh: 1 ; URL=http://localhost");
	}
//fail:
mysql_close($link);
} 
}
}
?> 