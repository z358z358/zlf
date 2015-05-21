<?php


//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

require_once('class.phpmailer.php');
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
$mail->Username   = "onininonwork@gmail.com";  // GMAIL username
$mail->Password   = "s123938110";            // GMAIL password
$mail->CharSet    = 'utf-8';

$mail->SetFrom('onininonwork@gmail.com', '客服 人員');

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
?>