<?php
class callme
{
  function callmeplease($text)
  {
	session_start();
	$text1=$text;
	$link = mysql_connect('localhost','root',''); 
	if (!$link) { 
	die('Could not connect to MySQL: ' . mysqli_error()); 
	} 

	if (!mysql_select_db("account",$link)) { 
	die('Could not connect to DB: ' . mysqli_error()); 
	} 
	mysql_query("SET NAMES 'utf8'",$link);
	
	$id = strtok($text, "+");
	$score=strtok($id);
	$time=date("Y-m-d H:i:s",time()+8*60*60);
	if(empty($_SESSION['id'])||$id!=$_SESSION['id'])
	die();
	$id2=$_SESSION['id'];
	
    $sql="INSERT INTO `bonus` (`ID`, `TIME`, `GAME`, `VALUE`,`FROM`) 
                               VALUES ('$id2','$time','躲避遊戲','$score','闖關獎勵')";
							   
	mysql_query($sql,$link);
	mysql_close($link); 
	return $text1;
  }
}