<?php 
session_start();
$message=0;
include('config.php');
	if(isset($_POST['option']))
$ischecked = $_POST['option'];
	if(!empty($ischecked))
	{
		$N = count($ischecked);
		for($i=0; $i<$N; $i++)
		{
			$sql = "DELETE FROM `wishlist`	WHERE `GOODS_ID` = '$ischecked[$i]'";
			mysql_query($sql, $link);
			$message=1;
		}	
	}
	echo $message;
	
?>

