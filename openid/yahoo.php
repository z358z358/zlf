<?php
//var_dump($_REQUEST);
?>

<?php
//ㄎㄎ
//var_dump($_GET);
include('../include/sessionno.php');
//include('include/w3.html');


if(isset($_GET['openid_mode'])&&$_GET['openid_mode']=='cancel')
{
header("Location:http://www.zlf168.com");
die();
}

if(isset($_GET['openid_mode'])&&$_GET['openid_mode']=='id_res'&&isset($_GET['openid_identity'])&&isset($_GET['openid_ax_value_email']))
{
$openid=explode("a/",$_GET['openid_identity']);
$id=explode("@",$_GET['openid_ax_value_email']);
$id[0].="@yahoo";
$email=$_GET['openid_ax_value_email'];
//var_dump($openid);
//var_dump($id);
//var_dump($email);
include('../include/check.php');
if(!checkStr($id[0])||!checkStr($email)||!checkStr($openid[1]))
{
header("Location:http://www.zlf168.com");
die();
}

include('../include/config.php');
$password=sha1($openid[1].$id[0]);
$sql="SELECT * FROM `data` WHERE `ID`='$id[0]'";
$result = mysql_query($sql,$link); 
	if( mysql_num_rows($result)==0)
	{
	$date=date("Y-m-d",time()+8*60*60);
	echo $sql="INSERT INTO `data` (`ID`,`SID`, `PASSWORD`,`NAME`,`MAIL`,`MAILACT`,`FULL`,`CREATE`) 
                           VALUES ('$id[0]','0','$password',' ','$email','1','0','$date')";
		if (!mysql_query($sql,$link))
		{
		header("Location:http://www.zlf168.com");
		die();
		}
	$_SESSION['name'] =' ';
	$_SESSION['id'] = $id[0];
	header("Location:http://www.zlf168.com");
	die();
	}
	else if(mysql_num_rows($result)==1)
	{
		$row = mysql_fetch_assoc($result);
		if($row['PASSWORD']!=$password)
		{
		header("Location:http://www.zlf168.com");
		die();
		}
		//include('../include/check.php');	
		$ip=realip();
		$time=date("Y-m-d H:i:s",time()+8*60*60);
		$sid=session_id();
		//$id=$id[0];
		$sql="INSERT INTO `log` (`ID`, `TIME`, `ACT`, `IP`,`session_id`) 
								VALUES ('$id[0]','$time','in','$ip','$sid')";						   
		mysql_query($sql,$link);	
		
		if($row['FULL']==0)
		{
		$_SESSION['name'] =' ';
		$_SESSION['id'] = $id[0];
		header("Location:http://www.zlf168.com");
		die();
		}
		else
		{
		$_SESSION['name'] = substr($row['NAME'],-6,6);
		$_SESSION['id'] = $id[0];
		$_SESSION['birthday']=str_replace("-","",$row['BIRTHDAY']);
		$_SESSION['sex'] = $row['SID'][1];
		$_SESSION['sid'] = substr($row['SID'],6,4);
		header("Location:http://www.zlf168.com");
		die();
		}
	
	
	}




}
header("Location:http://www.zlf168.com");
?>

