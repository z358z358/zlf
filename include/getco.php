<?php 
session_start();
$message = 2; 
if (!empty($_GET['number'])) 
{
//goto not_tw;顆顆


$number=$_GET['number'];
if(is_numeric($number))
{
//goto not_tw;

if(!empty($_SESSION['id'])&&!empty($_SESSION['ad'][$number])&&time()-$_SESSION['ad'][$number]>1)
{
include('config.php');
$sql="SELECT * FROM `gzinfo` WHERE `MENU`='$number[0]'";
$rows=mysql_query($sql,$link);
$row = mysql_fetch_assoc($rows);
$value=$row['VALUE'];

$id=$_SESSION['id'];
$time=date("Y-m-d",time()+8*60*60);
$sql="SELECT * FROM `gz` WHERE `TIME`='$time' AND `FROM`='".$_GET['number']."' AND `ID`='".$_SESSION['id']."'";
$rows=mysql_query($sql,$link);
if(!mysql_num_rows($rows))
{
	$sql="INSERT INTO `gz` (`ID`, `TIME`,`FROM`,`VALUE`) 
                               VALUES ('$id','$time','$number','$value')";
	$rows=mysql_query($sql,$link);
	$message = 0; 
}
else
{
	$message = 1; 
}

//echo $sql="INSERT INTO 'data' VALUES('$id','$password','$sid','$name','$birthday','$mail','$phone')";	
//$result = mysql_query($sql,$link); 
//if( mysql_num_rows($result) != 1 ) 
//{ 
// The user ID specified was not found  
//} 
//else 
//{ 
// The user ID found 
//$message = 1; 
//} 


//mysql_close($link);
//not_tw:
}
}
}
echo $message;
?> 