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
			$sql="SELECT * FROM `shopping_car` WHERE `ID`='".$_SESSION['id']."'";
			$rows=mysql_query($sql,$link);
			if(!mysql_num_rows($rows))
			{
				$id=$_SESSION['id'];
				$sql="INSERT INTO `shopping_car` (`ID`) 
							   VALUES ('$id')";
				mysql_query($sql,$link);
				$message=1; //success (new userID in db)
				exit();
			}
			$sql="SELECT * FROM `shopping_car` WHERE `ID`='".$_SESSION['id']."'";
			$rows = mysql_query($sql,$link);
			$row=mysql_fetch_assoc($rows);
			$mystring = $row['GOODS_ID'];
			$findme   = $ischecked[$i];
			$pos = strpos($mystring, $findme);
			if($pos!==false) 
				$message=2; //already in cart
			else
			{
				$goods=$findme."&".$row['GOODS_ID'];
				$sql="UPDATE `shopping_car` SET `GOODS_ID`='$goods' WHERE `ID`='".$_SESSION['id']."'";
				if(mysql_query($sql,$link))
					$message=3;//success
				else
					$message=4;//failed
			}
		}	
	}
	echo $message;

?>
