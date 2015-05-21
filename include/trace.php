<?php 
session_start();
$message='';
$rows;

if (!isset( $_SESSION['id']))//沒登入
{
	$message=-1;//沒登入
}
else if(empty($_POST['id']))
{
	$message=-2;//沒傳商品id
}
else
{
	include('config.php');
	$findme   = $_POST['id'];	
	$s = "SELECT `USER_ID`, `GOODS_ID` FROM `wishlist` WHERE `USER_ID`='".$_SESSION['id']."' AND `GOODS_ID`='$findme'";
	$result = mysql_query($s, $link);
	if(mysql_num_rows($result) > 0)
		$message=1;//已加入過商品
	else
	{
		$time=time()+8*60*60;
				$sql="REPLACE INTO `wishlist` (`USER_ID`, `GOODS_ID`, `TIME`)
				VALUES ('".$_SESSION['id']."', '$findme', '$time')";
		if(mysql_query($sql,$link))
			$message=2;//成功新增商品;
		else
			$message=3;//失敗新增商品;
	}
}
echo $message;
?> 