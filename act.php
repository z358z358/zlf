<?php
function checkStr($str) {
    $interzis = '/[=,`\'"#$%\^&\*\+]/';
    if(preg_match($interzis, $str)) return false;
    else return true;
  }
  
if (empty($_GET['account'])||empty($_GET['act'])) 
{
header("Location: index.php");
}
else
{
	$error=false;
	foreach($_GET as $var => $value)
	{		
	if(!checkStr($value))
	$error=true;
	}
	
	if(!$error)
	{
	$id=$_GET['account'];
	include('include/w3.html');
	include('include/config.php');
	$title="認證網頁";
	include('include/header.php');

?>
</header>
<body>
<div class="body center">
	<div class="logo floatL">
		<a href="http://www.zlf168.com/"><img src="images/logo.png" border="0" alt="首頁"></a>
	</div>
	<div class="clearboth" style="height:240px;width:1000px;background-color:#CDEAF7;background-image:url('images/certifybg.png');background-position:50% 50%;background-repeat:no-repeat;padding-top:100px">

	<b><p style="font-size: 150%;margin-bottom:50px;">
<?php
	$sql="SELECT * FROM `data` WHERE `ID`='$id'";
	$rows=mysql_query($sql,$link);
	
	if(!mysql_num_rows($rows))
	{
		mysql_close($link); 
		echo "連結有誤";
	}
	else
	{
		$row = mysql_fetch_assoc($rows);
		if($row['MAILACT'])
		{
			echo "您已經認證過了";
		}
		else if($_GET['act']==sha1($row['MAIL']))
		{
			$sql2="UPDATE `data` SET  `MAILACT` =  '1' WHERE  `data`.`ID` =  '$id'";
			if(mysql_query($sql2,$link))
			echo "恭喜！電子信箱認證成功";
			else
			echo "資料庫忙碌中 信箱認證失敗";
			mysql_close($link); 
		}
		else
		{
			mysql_close($link); 
			echo "連結已失效";
		}
	
	}
	}
	
	?>
	</p>
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
?>