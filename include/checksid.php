<?php 
include('check.php');

$message = 2; 
if (!empty($_GET['id'])) {
//goto not_tw;


$id=strtoupper($_GET['id']);
if(check_twid($id))
{
//goto not_tw;顆顆

include('config.php');
$sql="SELECT * FROM `data` WHERE `SID`='$id'";
//echo $sql="INSERT INTO 'data' VALUES('$id','$password','$sid','$name','$birthday','$mail','$phone')";	
$result = mysql_query($sql,$link); 
if( mysql_num_rows($result) != 1 ) 
{ 
// The user ID specified was not found 
$message = 0; 
} 
else 
{ 
// The user ID found 
$message = 1; 
} 


mysql_close($link);
//not_tw:
}
}
echo $message;
?> 