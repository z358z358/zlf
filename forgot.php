<?php
session_start();
include('include/w3.html');
$title='查詢密碼';
include('include/header.php');
?>
</header>
<body>
<div class="body center">
	<div class="logo floatL">
		<a href="/"><img src="images/logo.png" border="0" alt="首頁"></a>
	</div>
	<div class="clearboth" style="height:240px;width:1000px;background-color:#CDEAF7;background-image:url('images/certifybg.png');background-position:50% 50%;background-repeat:no-repeat;padding-top:50px">

<?php
if(empty($_GET['step']))
{
?>
<script>
$(document).ready(function() {

	$("#form1").submit(function() {
      
        //$("span").text("Validated...").show();
		//$("#chkr6").html('<img src="images/ok.png">');
		$("input#submit").before('<p style="font-size: 150%">請稍候</p>');
		$("input#submit").remove();
        return true;
      
    });

});
</script>	
	<form id="form1" name="form1" method="POST" action="/forgot.php?step=check">
	<p style="font-size: 150%;margin-bottom:30px;margin-right:100px">查詢密碼，請輸入以下資訊：</p>
	
	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>帳&nbsp號&nbsp名&nbsp稱</label>
		<input id="id"  type="text" name="id" maxlength="10"  size="30"/>
	</div>
	
	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>電&nbsp子&nbsp信&nbsp箱</label>
		<input id="email" type="text" name="mail" size="30"  />
		<span id="chkmail"></span> 
	</div>
	
	<input id="submit" style="margin-top:30px;" type="image" src="images/ect/submit.png" ALT="Submit Form">
<?php
	if (isset($_GET['error']))
	{
		if($_GET['error']==1)
		echo "帳號或E-mail錯誤";
		else if($_GET['error']==2)
		echo "E-mail尚未認證 無法申請";
	}
?>
	
</form>
<?php
}
else if($_GET['step']=="check")
{
	include('include/sessionno.php');
	//include('include/w3.html');
	include('include/check.php');


	if(empty($_POST['id'])||empty($_POST['mail']))
	{
		header("Location: forgot.php?error=1");
		die();
	}
	else
	{
		$id=$_POST['id'];
		$umail=$_POST['mail'];

//check start


		if(!checkid($id)||!checkemail($umail))
		{
			header("Location: forgot.php?error=1");
			die();
		//goto fail;
		}
		else
		{

			//check end
			include('include/config.php');
			$sql="SELECT * FROM `data` WHERE `ID`='$id' AND  `MAIL` =  '$umail'";
			//echo $sql="INSERT INTO 'data' VALUES('$id','$password','$sid','$name','$birthday','$mail','$phone')";	
			$rows=mysql_query($sql,$link);



			if(!mysql_num_rows($rows))
			{
				mysql_close($link); 
				header("Location: forgot.php?error=1");
				die();
			}
			else
			{
				$row = mysql_fetch_assoc($rows);
	
				if(!$row['MAILACT'])
				{
					mysql_close($link); 
					header("Location: forgot.php?error=2");
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

					$mail->Subject    = "Go給利會員：修改密碼信件";

					$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

					//$mail->MsgHTML($body);
					$mail->Body=
					"<body>
					".$row['NAME']."您好<br>
					請點以下連結來修改密碼：<a href=".$_SERVER['HTTP_HOST']."/resetpw.php?account=".$id."&act=".sha1($row['PASSWORD']).">我要改密碼</a><br>
					或直接輸入網址<br>
					http://".$_SERVER['HTTP_HOST']."/resetpw.php?account=".$id."&act=".sha1($row['PASSWORD'])."
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
	<p style="font-size: 150%;">修改密碼信已寄出：
	<?php
	echo $umail;
	?></p>
	<p style="font-size: 150%;margin-top:50px;margin-bottom:50px;">請到信箱內點選連結，<a href="http://www.google.com.tw/#hl=zh-TW&q=<?php echo $mail_token[1];  ?>&oq=<?php echo $mail_token[1];  ?>" >在Google上搜尋<?php echo $mail_token[1];  ?></a></p>
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


<?php
}
?>
	</div>
	<div class="clearboth">
	<?php 
	include('include/foot.html');
	?>
	</div>
</div>
</body>
</html>