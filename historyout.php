<?php
include('include/session.php');
include('include/w3.html');
$title='會員中心';
include('include/header.php');
include('include/config.php');
$id=$_SESSION['id'];
$sql = "SELECT `exchange`.`DATE` AS '日  期',`exchange`.`TIME` AS '時間',`exchange`.`TO` AS '兌換對象',`exchange`.`VALUE` AS '儲值數量'"
    . "	FROM `exchange`"
    . "	WHERE `exchange`.`ID`='".$id."'"
	. " ORDER BY  `exchange`.`DATE` DESC ,`exchange`.`TIME` DESC ";
//	. " GROUP BY `bonus`.`GAME`";
$rows=mysql_query($sql,$link);


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
 
 
$(".tablesorter th").css("background-color","#993300");
$(".tablesorter th").css("border","0.1em solid #993300");
$(".tablesorter td").css("border","0.1em solid #993300");
$(".tablesorter td").css("font-weight","bold");
$(".tablesorter td").addClass("center");
$(".tablesorter td:nth-child(4)").addClass("right");
$(".tablesorter").css("margin","0");
$("table.tablesorter thead tr th, table.tablesorter tfoot tr th").css("padding","5px 0 5px 0");
$("table.tablesorter tbody td").css("padding","5px 0 5px 0");
$(".tablesorter td:nth-child(4)").css("padding-right","5px");

$(".tablesorter td").hover(
		function() 
		{  
		$(this).parent().children().css("background-color", "#FFDCCC");
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
</header>
<body class="index">
<div class="body center">
<noscript> 
<div class="center"><b>此頁需要在所用瀏覽器上啟用 Javascript。</b></div>
</noscript> 
	<!--logo + menu-->
	<div>
		<div class="logo floatL whitebg">
			<a href="http://www.zlf168.com/"><img src="images/logo.png" border="0" alt="首頁"/></a>
		</div>
	
		<div class="headmenu floatR  corner" data-corner="BL:60px cc:#FFFFFF">
	
		</div>
	</div>
	<!--logo + menu end-->
	
	<!--login + bigad-->
	<div class="clearboth"></div>
	<div>
		<div class="floatL login whitebg left">
		
			
<?php
if (isset( $_SESSION['name']))
	{
	//echo $_SESSION['name'];
	include('include/in.php');
?>	   
   
<?php
	}
	else 
	{
	include('include/out.php');
?>	
 
<?php
	}
?>
		</div>
	

		<div class=" floatR "> <!--corner data-corner="right 83px" whitebg-->
		<div class="absolute" style="z-index:10"></div>
		<div id="flashab" class="headab flashab" style="z-index:1"></div>
		
		</div>

	</div>
	<!--login + bigad end-->
	
	<!--left menu-->
	<?php
	include('include/leftmenu.php');
	?>
	<!--left menu end-->
	
	<!--right main-->
	<div class="rightmain floatR corner" data-corner="TL 60px cc:#FFFFFF">
	

	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:0px"><a href="userinfo.php"><img src="images/userinfo/userinfo.png" border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:177.5px"><a href="account.php"><img src="images/userinfo/rg.png." border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:355px"><a href="historyin.php"><img src="images/userinfo/thin.png" border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:532.5px"><a href="historyout.php"><img src="images/userinfo/thout.on.png" border="0"/></a></div>


		<div class="corner info whitebg left"  data-corner="bottom 20px">
		<div style="padding:15px">
		
<?php
if(!mysql_num_rows($rows))
	{
	echo "無資料";
	}
else{

echo "<table id=bonus class=tablesorter>";
	echo "<thead>";
	echo "<tr>";
	//$field=mysql_fetch_field($rows);
	
	$width=array(70,45,100,90,80,80);
	
	$j=0;
	while($field=mysql_fetch_field($rows))
	{
	echo '<th class="center" width="'.$width[$j].'"><b>'.$field->name."</b></th>";
	$j++;
	}
	
	//echo "<th><input type=checkbox /></th>";
	
	//echo "<td><a href=bonusinfo.php?sortby=".$field->name.">".$field->name."</a></td>";
	echo "</tr></thead><tbody>";

	while($row = mysql_fetch_row($rows))
	{ 
		echo "<tr>";
		
		echo "<td>";
		echo substr($row[0],0,10);
		echo "</td>";
		echo "<td>";
		echo substr($row[1],0,5);
		echo "</td>";
    
		for($i=2;$i<count($row);$i++)
		{
   // if($i==1)
   // echo "<td><a href=select_list.php?T1=".$ID."&T2=".$row[$i].">".$row[$i]."</td>"; 
   // else 
		echo "<td>".$row[$i]."</td>";
			
		}
		// echo '<td><input type=checkbox class=checkbox name=chkbox[] onclick="hightlightTr(this);sum();" value='.$row[$i]."></td>";


		echo "</tr>";
	}
	
	
	echo "</tbody></table>";
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
<?php
}
?>	
	
		</div>
		</div>
	
	
	</div>
	<!--right main-->
	
	<div class="clearboth">
	<?php 
	include('include/foot.html');
	?>
	</div>
	<?php 
	include('include/leftrightad.php');
	?>
</div>
<map name="planetmap1">
  <area shape="rect" coords="35,100,160,140" href="icashS1.php" />
</map>
<map name="planetmap2">
  <area shape="rect" coords="35,100,160,140" href="creditS1.php" />
</map>
<map name="planetmap3">
  <area shape="rect" coords="35,100,160,140" href="store.php" />
</map>

</body>
</html>