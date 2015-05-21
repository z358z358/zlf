<?php
require 'php-sdk/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '100582416725737',
  'secret' => '8c7b9789def87d821060561bc401bf49',
));

//var_dump($facebook);

// Get User ID
$user = $facebook->getUser();


if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}


if ($user) {
//var_dump($user_profile);
include('../include/config.php');


$password=sha1($user_profile['id']);
$id_token=explode("@",$user_profile['email']);
$email=$user_profile['email'];
$id=$id_token[0]."@fb";
//var_dump($id);
$sql="SELECT * FROM `data` WHERE `ID`='$id'";
$result = mysql_query($sql,$link); 
	if( mysql_num_rows($result)==0)
	{
	$date=date("Y-m-d",time()+8*60*60);
	echo $sql="INSERT INTO `data` (`ID`,`SID`, `PASSWORD`,`NAME`,`MAIL`,`MAILACT`,`FULL`,`CREATE`) 
                           VALUES ('$id','0','$password',' ','$email','1','0','$date')";
		if (!mysql_query($sql,$link))
		{
		header("Location:http://www.zlf168.com");
		die();
		}
	$_SESSION['name'] =' ';
	$_SESSION['id'] = $id;
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
		
	include('../include/check.php');	
	$ip=realip();
	$time=date("Y-m-d H:i:s",time()+8*60*60);
	$sid=session_id();
	$id=$row['ID'];
	$sql="INSERT INTO `log` (`ID`, `TIME`, `ACT`, `IP`,`session_id`) 
                               VALUES ('$id','$time','in','$ip','$sid')";						   
	mysql_query($sql,$link);		
				
		
		if($row['FULL']==0)
		{
		$_SESSION['name'] =' ';
		$_SESSION['id'] = $row['ID'];
		header("Location:http://www.zlf168.com");
		die();
		}
		else
		{
		$_SESSION['name'] = substr($row['NAME'],-6,6);
		$_SESSION['id'] = $row['ID'];
		$_SESSION['birthday']=str_replace("-","",$row['BIRTHDAY']);
		$_SESSION['sex'] = $row['SID'][1];
		$_SESSION['sid'] = substr($row['SID'],6,4);
		header("Location:http://www.zlf168.com");
		die();
		}	
	}
} else {
	
  //$loginUrl = $facebook->getLoginUrl();
  $loginUrl =$facebook->getLoginUrl(array('redirect_uri' => 'http://www.zlf168.com/openid/facebook.php','scope' => 'email'));
  header("Location:".$loginUrl);
  die();
}
header("Location:http://www.zlf168.com");
?>