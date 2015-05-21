<?php
include('include/session.php');
include('include/w3.html');
$title='會員中心';
include('include/header.php');
include('include/config.php');
$id=$_SESSION['id'];
?>
<style type="text/css">
table.tablesorter thead tr .headerSortUp {
	background-image:none;
}
table.tablesorter thead tr .headerSortDown {
	background-image:none;
}
table.tablesorter thead tr .header {
	background-image:none;
}
</style>
<script src="javascripts/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="javascripts/jquery.tablesorter.pager.js"></script>
<script  type="text/javascript">
$(function(){
$('td').each(function()
{
	if($(this).html()<0)
	$(this).attr('style','color:red');
});

$(".tablesorter th").css("background-color","#996600");
$(".tablesorter th").css("border","0.1em solid #996600");
$(".tablesorter td").css("border","0.1em solid #996600");
$(".tablesorter td").css("font-weight","bold");
$(".tablesorter td").addClass("center");
$(".tablesorter td:nth-child(5)").addClass("right");
$(".tablesorter").css("margin","0");
$("table.tablesorter thead tr th, table.tablesorter tfoot tr th").css("padding","5px 0 5px 0");
$("table.tablesorter tbody td").css("padding","5px 0 5px 0");
$(".tablesorter td:nth-child(5)").css({"padding-right" : "5px" , "letter-spacing" : "3px"});

$(".tablesorter td").hover(
		function() 
		{  
		$(this).parent().children().css("background-color", "#FFFFCC");
		//$("input:checked").parent().parent().css("background-color", "#000000");
		},
		function() 
		{  
		$(this).parent().children().css("background-color", "");	
		//$("input:checked").parent().parent().css("background-color", "#000000");		
		});
$("#bonus").tablesorter().tablesorterPager({container: $("#pager")}); 
});
</script>

<?php
$sum=0;
$sql = "SELECT `order_log`.`TIME` AS '日期  |  時間', `order_goods`.`GOODS_NAME` AS '商品' ,`order_goods`.`GOODS_SIZE` AS '規格' , `order_goods`.`GOODS_NUM` AS '數量' , `order_goods`.`CO_PRICE` AS '單價'"
	." FROM `order_log`"
	." LEFT JOIN `order_goods`"
	." ON `order_goods`.`ENCRYPTED_ID` = `order_log`.`ENCRYPTED_ID`"
	." WHERE `USER_ID`='".$id."' AND `order_goods`.`ENCRYPTED_ID`= ' ".$_GET['id']."'"
	." ORDER BY `order_log`.`TIME` DESC";
	$rows=mysql_query($sql,$link);
	echo "<table id=bonus class=tablesorter>";
			echo "<thead>";
			echo "<tr>";
			//$field=mysql_fetch_field($rows);
			
			//$width=array(70,45,100,90,80,80);
			
			$j=0;
			while($field=mysql_fetch_field($rows))
			{
				echo '<th class="center"><b>'.$field->name."</b></th>";
				$j++;
			}
			
			//echo "<th><input type=checkbox /></th>";
			
			//echo "<td><a href=bonusinfo.php?sortby=".$field->name.">".$field->name."</a></td>";
			echo "</tr></thead><tbody>";

			while($row = mysql_fetch_row($rows))
			{ 

			
				for($i=0;$i<count($row);$i++)
				{
				
						echo "<td>".$row[$i]."</td>";	
						
				}
				$sum+=$row[3]*$row[4];
				// echo '<td><input type=checkbox class=checkbox name=chkbox[] onclick="hightlightTr(this);sum();" value='.$row[$i]."></td>";
				echo "</tr>";
			}
			echo "</tbody>";
			$sql = "SELECT *"
			." FROM `order`"
			." WHERE `USER_ID`='".$id."' AND `ENCRYPTED_ID`= '".$_GET['id']."'";
			$rows=mysql_query($sql,$link);
			$row = mysql_fetch_assoc($rows);
			echo '<div class="floatL">收件者:'.$row['NAME'].'&nbsp&nbsp地址:'.$row['COUNTY'].$row['DISTRICT'].$row['ADDRESS'].'<br><br>電話:'.$row['PHONE'].'&nbsp&nbsp市話:'.$row['FIXPHONE'].'</div>
			<div class="right" style="font-size:30px;font-weight:bold;margin:40px;">總額：'.$sum.'</div>';
			
			echo "</table>";
?>
<div id="pager" class="center" style="margin-top:20px">
		        <label class="first">最前頁</label>
		        <label class="prev">前一頁</label>
		        <input type="text" size="1" readonly="readonly" class="pagedisplay"/>
		        <label class="next">下一頁</label>
		        <label class="last">最末頁</label>
		        <select style="display:none" class="pagesize">
			        <option selected="selected" value="10">10</option>
		        </select>
		    </div>		
			
