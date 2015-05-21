<!--left menu-->
	
<?php
//       store的首頁
$menu=array();
$chose=array();
$max=0;
//if(empty($_GET['act']))
//{
	if(empty($_GET['menu'])&&empty($_GET['goodid']))
	{
		$key=0;
	}
	else  if(empty($_GET['goodid']))
	{
		$key=$_GET['menu'];
		
	}
	else if(!empty($_GET['goodid']))
	{
		$key=$_GET['goodid'];
		$sql="SELECT * FROM `store_good` WHERE `GOODS_ID`='$key'";
		$rows=mysql_query($sql,$link);
		if(!mysql_num_rows($rows))
		{
			header("Location:store.php");
		}
		else
		{
			$row = mysql_fetch_assoc($rows);
			$key = $row['KIND_ID'];
		}
	}
		
	$jump=false;
	while(!$jump)
	{
		$find=1;
		if($key==0)
		{
			$jump=true;
		}
		$sql="SELECT * FROM `store_kind` WHERE `PARENT_ID`='$key' ORDER BY  `SORT_ORDER` ASC ";
		$rows=mysql_query($sql,$link);
		if(!mysql_num_rows($rows))
		{
			$find=0;
		}
		$count=0;
		while($row = mysql_fetch_assoc($rows))
		{
			$menu[$max][$count++]=$row["NAME"];
			$menu[$max][$count++]=$row["KIND_ID"];
		}
		$sql="SELECT * FROM `store_kind` WHERE `KIND_ID`='$key' ORDER BY  `SORT_ORDER` ASC";
		$rows=mysql_query($sql,$link);
		$row = mysql_fetch_assoc($rows);
		if($row["NAME"]!='')
		{
		array_push($chose, $row["NAME"]);
		array_push($chose, $row["KIND_ID"]);
		}
		$key=$row["PARENT_ID"];
		$max+=$find;
		
	}
	$max--;
	//if(empty($chose))
	//$chose[0]="商城首頁";
//}

while($max>=0)
{				
	for($i=0;$i<count($menu[$max]);$i+=2)
	{ 
		$select="";
		if(in_array($menu[$max][$i], $chose))
			$select="store_select";
						//echo '<li class="store_menu_li '.$select.'"><a href="store.php?menu='.$menu[$max][$i+1].'" >'.$menu[$max][$i].'</a></li>';
	}
	$max--;		
}			
?>
<script type="text/javascript">
$(document).ready(function() {
	$('#<?php if(!empty($chose)) echo $chose[count($chose)-1];?>').next(".merc_menu_body").slideDown(500).siblings(".merc_menu_body").slideUp("fast");
		//$(this).siblings().css({backgroundImage:"url(left.png)"});

});
</script>
	<div class="gbg_long corner left" id="g_bg_long">
	<?php 
	echo '<a href="store.php">購物商城</a>';
	
	if(!empty($chose))
	for($i=count($chose)-1;$i>=0;$i-=2)
	echo '><a href="store.php?menu='.$chose[$i].'">'.$chose[$i-1].'</a>';
	?>
	<div class="floatR b" style="padding-right:10px;"><a href="shopfaq.php" style="font-size: 18px;color:#265812;text-decoration: none;">購物須知</a></div>
	</div>
	<div class="floatL">
	<?php 
	//var_dump($menu);
	//var_dump($chose);
	if(count($menu)>2)
	{
		$j=0;
		if(count($chose)>5)$j=2;
	?>
	<div class="book_menu_title corner" id="navigation" style="font-size:18px; "> <div class="gbg" id="g_bg"> <?php echo  $chose[$j]; ?> </div>
		<ul class="navbar1"></br>
		<?php
		for($i=0;$i<count($menu[0]);$i+=2)
		echo '<li><a style="text-decoration:none" href="store.php?menu='.$menu[0][$i+1].'">'.$menu[0][$i].'</a></li></br>';
		?>
		</ul>
	</div>
	<?php
	}

	$sql="SELECT * FROM `store_kind` WHERE `PARENT_ID`=0 ORDER BY  `SORT_ORDER` ASC ";
	$rows=mysql_query($sql,$link);
	$count=0;
	while($row = mysql_fetch_assoc($rows))
	{
		$menu2[0][$count++]=$row["NAME"];
		$menu2[0][$count++]=$row["KIND_ID"];
	}
	for($i=0;$i<count($menu2[0]);$i+=2)
	{
		$sql="SELECT * FROM `store_kind` WHERE `PARENT_ID`=".$menu2[0][$i+1]." ORDER BY  `SORT_ORDER` ASC ";
		$rows=mysql_query($sql,$link);
		$count=0;
		while($row = mysql_fetch_assoc($rows))
		{
			$menu2[$i+1][$count++]=$row["NAME"];
			$menu2[$i+1][$count++]=$row["KIND_ID"];
		}
	}
	
	//var_dump($menu2);
	?>
	<!--商品分類MENU-->
	<div class="merchandise corner" id="merc" style="font-size:18px;padding-bottom:10px;"> <div class="gbg" id="g_bg">商品分類 </div>
	<ul class="navbar2 left">
		<div id="firstpane">
		<?php
		for($i=0;$i<count($menu2[0]);$i+=2)
		{
			echo'<li class="merc_menu_head b" id="'.$menu2[0][$i+1].'">'.$menu2[0][$i].'</li>
				<div class="merc_menu_body nob">'; 
			for($j=0;$j<count($menu2[$i+1]);$j+=2)		
			echo '<a href="store.php?menu='.$menu2[$i+1][$j+1].'">'.$menu2[$i+1][$j].'</a>';
			
			echo'<div class="merc_menu_dash"></div>
				</div>';
		}
		?>
        </div>
	</ul>
	</div>
	</div>
  <!--left menu end--> 