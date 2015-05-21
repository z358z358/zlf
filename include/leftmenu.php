<div class="clearboth"></div>
	<div  class="floatL" >
	<div class="leftmenu whitebg corner" data-corner="bottom 30px">
		<div id="flashmenu" class="flashmenu">
		</div>
		<br>
<?php
include('include/config.php');
$date=date(" n月 j日 ",time()+8*60*60);
echo $date;
$weekarray=array("日","一","二","三","四","五","六");  
echo "星期".$weekarray[date("w",time()+8*60*60)]; 
?>
<br><br>
<!--<table style="margin:auto" cellspacing="0" cellpadding="3" border="0"><tr><td rowspan="2">
<img height="31" src="http://udn.com/WEATHER/IMAGES/taipeiicon.gif" width="38"/></td><td colspan="3">
<a href="http://udn.com/WEATHER/taipei.htm" target="_blank" style="text-decoration: none"><b>台北</b></a></td></tr><tr><td>
<img height="13" src="http://udn.com/WEATHER/IMAGES/taipeilowtemp.gif" width="27"/></td><td>-</td> <td>
<img height="13" src="http://udn.com/WEATHER/IMAGES/taipeihightemp.gif" width="27"/></td></tr></table>-->
	</div>
	<?php
		$images = glob("images/store/images/index/left{*.gif,*.jpg,*.png}", GLOB_BRACE);
		shuffle($images);
		$adlink=array();
		for($i=0;$i<count($images);$i++)
		{
			$adlink[$i]="";
			$target=explode("images/store/images/",$images[$i]);
			$sql="SELECT `LINK` FROM `ad_link` WHERE `TARGET` = '".$target[1]."'";
			$rows=mysql_query($sql,$link);
			if(mysql_num_rows($rows))
			{
				$row = mysql_fetch_assoc($rows);;
				$adlink[$i]=$row['LINK'];
			}					
		}
		for($i=0;$i<count($images);$i++)
		{	
			echo '<div class="fullimg leftab" style="height:210px;width:250px">';
			if(empty($adlink[$i]))
				echo '<img src='.$images[$i].' />';
			else
				echo '<a href="'.$adlink[$i].'"><img src='.$images[$i].' /></a>';		
			echo '</div>';
		}	
	  ?>  
	</div>