<?php 
session_start();
$message='';
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
	$sql="SELECT * FROM `shopping_car` WHERE `ID`='".$_SESSION['id']."'";
	$rows=mysql_query($sql,$link);
	if(!mysql_num_rows($rows))
	{
		$id=$_SESSION['id'];
		$sql="INSERT INTO `shopping_car` (`ID`) 
                          VALUES ('$id')";
		mysql_query($sql,$link);
		$sql="SELECT * FROM `shopping_car` WHERE `ID`='".$_SESSION['id']."'";
		$rows=mysql_query($sql,$link);
	}
	//$sql="SELECT * FROM `shopping_car` WHERE `ID`='".$_SESSION['id']."'";
	//echo $sql="INSERT INTO 'data' VALUES('$id','$password','$sid','$name','$birthday','$mail','$phone')";	
	$rows = mysql_query($sql,$link);
	$row=mysql_fetch_assoc($rows);
	$mystring = $row['GOODS_ID'];
	$findme   = $_POST['id'];
	$pos = strpos($mystring, $findme);
	if($pos!==false) 
		$message=1;//已加入過商品
	else
	{
		$goods=$_POST['id']."&".$row['GOODS_ID'];
		$sql="UPDATE `shopping_car` SET `GOODS_ID`='$goods' WHERE `ID`='".$_SESSION['id']."'";
		if(mysql_query($sql,$link))
			$message=2;//成功新增商品;
		else
			$message=3;//失敗新增商品;
	}
}

echo $message;
?> 