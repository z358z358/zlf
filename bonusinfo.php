<?php 
include('include/session.php');
include('include/w3.html');
include('include/config.php');
$title='紅利兌換';
include('include/header.php');
?>
<script src="javascripts/jquery.tablesorter.min.js"></script>
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#bonus").tablesorter(); 
    } 
); 
  
</script>  
</header>
<body>
<?php

$id=$_SESSION['id'];
if (empty($_GET['sortby'])) $sort="TIME";
else $sort=$_GET['sortby'];
//"SELECT `gameinfo`.`COMPANY`,`bonus`.`GAME`,SUM(`bonus`.`VALUE`) AS 'VALUE'"
//"SELECT `gameinfo`.`COMPANY`,`bonus`.`GAME`,`gameinfo`.`GAMETYPE`,`bonus`.`VALUE`"
$sql = "SELECT `gameinfo`.`COMPANY` AS '公司名稱',`bonus`.`GAME` AS '遊戲名稱',`gameinfo`.`GAMETYPE` AS '遊戲種類',`gamex`.`TYPE` AS '兌換種類',`gamex`.`RATIO` AS '兌換比例',`gameinfo`.`ACTIVITY` AS '活動項目',`bonus`.`VALUE` AS '獲得紅利'"
    . "	FROM `bonus` LEFT JOIN `gameinfo` ON(`bonus`.`GAME`=`gameinfo`.`GAME`) "
	. "              LEFT JOIN `gamex` ON(`bonus`.`GAME`=`gamex`.`GAME` AND `bonus`.`FROM`=`gamex`.`TYPE`)"
    . "	WHERE `bonus`.`SID`='".$id."'";
//	. " GROUP BY `bonus`.`GAME`";
$rows=mysql_query($sql,$link);
if(!mysql_num_rows($rows))
	{
	echo "無資料";
	}
else{
	$sum=0;
	echo "<table id=bonus class=tablesorter>";
	echo "<thead>";
	echo "<tr>";
	//$field=mysql_fetch_field($rows);
	while($field=mysql_fetch_field($rows))
	echo "<th>".$field->name."</a></th>";
	//echo "<td><a href=bonusinfo.php?sortby=".$field->name.">".$field->name."</a></td>";
	echo "</tr></thead><tbody>";

	while($row = mysql_fetch_row($rows))
	{ 
		echo "<tr>";
    
		for($i=0;$i<count($row);$i++)
		{
   // if($i==1)
   // echo "<td><a href=select_list.php?T1=".$ID."&T2=".$row[$i].">".$row[$i]."</td>"; 
   // else 
		echo "<td>".$row[$i]."</td>";
			if($i==6)
			{
			$sum+=$row[$i];
			}
		}
		
	}
	
	
	echo "</tbody></table>";
	}
	echo "總共".$sum."點紅利";


mysql_close($link); 
?> 
</body>
</html>