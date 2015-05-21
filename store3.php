<?php
session_start();
include('include/w3.html');
$title='給利購物';
include('include/header.php');
?>
<script type="text/javascript" src="javascripts/galleria/galleria-1.2.5.min.js"></script>
<script type="text/javascript" src="javascripts/jquery.slidingGallery-1.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	Galleria.loadTheme('javascripts/galleria/themes/classic/galleria.classic.min.js');
	$("#gallery").galleria
	({
		width: 670,
		height:300,
		debug:false,
		autoplay: true,
		queue: false,
		showInfo: false,
		showCounter: false
	});
		
	$("#gallery").mouseover(function () 
	{
		$('#gallery').data('galleria').pause();
	}).mouseout(function () 
	{
		$('#gallery').data('galleria').play();
	});
	
	var zoomFunc = function(dimension) 
	{
		return dimension * 2;
	}
	var shrinkFunc = function(dimension) 
	{
		return dimension * 0.8;
	}

	$('div.gallery2 img').slidingGallery
	({
		defaultLayout:'portrait',
		Pheight:100,
		Pwidth:150,
		Pzoom:zoomFunc,
		Lzoom:zoomFunc,
		gutterWidth:10,
		useCaptions:true,
		container: $('div.gallery2')
	});
	
	$(".store_li").mouseover(function () 
	{
		var color=$(this).css("background-color");
		$(this).css("color",color);
		$(this).css("background-color","#FFFFFF");
	}).mouseout(function () 
	{
		var color=$(this).css("color");
		$(this).css("color","#FFFFFF");
		$(this).css("background-color",color);
	});
	
	$(".none").removeClass("none");
});
</script>
</header>
<body class="store">
<div class="body center"> 
  
  <!--logo + menu-->
  <?php
include('include/logomenu.php');
?>
  <!--logo + menu end--> 
  
  <!--login + bigad-->
  <div>
    <div class="floatL login whitebg left" style="background-image:url('images/store/loginbg.png')">
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
  <div class="shopcar"><img src="images/store/right.png" usemap="#planetmap1"></div>
  <map name="planetmap1">
	<!--<<area shape="rect" coords="0,0,35,80" href="store.php?act=recent" />
	area shape="rect" coords="0,80,35,160" href="store.php?act=trace" />-->
	<area shape="rect" coords="0,160,35,230" href="store.php?act=car" />
  </map>
  
    <!--step -->
    <div class="news" style="background-image:url('images/store/mainhead.png')"> 
		<div class="newsmain gallery2 none" style="background-image:none"> 
			<?php
			
				$images = glob("images/store/images/goodstore/{*.gif,*.jpg,*.png}", GLOB_BRACE);
				for($i=0;$i<count($images);$i++)
				{
					if($i!=0)
						echo '<img src="'.$images[$i].'" layout="portrait">';
					else
						echo '<img src="'.$images[$i].'" class="start" layout="portrait">';
				}
			?>
		</div>
	</div>
    <!--step end-->
    
    <?php 
include('include/config.php');
   //       store的首頁
   
$menu=array();
$chose=array();
$max=0;

if(empty($_GET['act']))
{
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
		array_push($chose, $row["NAME"]);
		$key=$row["PARENT_ID"];
		$max+=$find;
		
	}
	$max--;
	if(empty($chose))
	$chose[0]="商城首頁";
	//var_dump($menu,$chose,$max); 首頁+未到末端menu
?>
    <!--text-->
    <div class="text whitebg corner store_textbg" style="padding:15px"> 
	
		<div class="corner" style="padding:5px;padding-bottom:10px;background-color:#FCF0DC">
		
		<?php
		$menuclass=1;
		while($max>=0)
		{
		?>
			<div class="center store_menu<?php echo $menuclass++;?>" >
				<ul class="store_menu_ul">
				<?php
				if($menuclass==1)
				echo '<li class="store_menu_li"><a href="store.php">商城首頁</a></li>';
				if($max>=0)
				{
					for($i=0;$i<count($menu[$max]);$i+=2)
					{ 
						$select="";
						if(in_array($menu[$max][$i], $chose))
						$select="store_select";
						echo '<li class="store_menu_li '.$select.'"><a href="store.php?menu='.$menu[$max][$i+1].'" >'.$menu[$max][$i].'</a></li>';
					}
					$max--;
				}
				?>
				</ul>
			</div>
		<?php
		}
	if(empty($_GET['menu'])&&!empty($_GET['goodid']))
	{  //商品頁面
	
	$key=$_GET['goodid'];
	$sql="SELECT * FROM `store_good` WHERE `GOODS_ID`='$key'";
	$rows=mysql_query($sql,$link);
	if(!mysql_num_rows($rows))
	{
		$find=0;
	}
	else
		$row = mysql_fetch_assoc($rows);
?>
<script type="text/javascript" src="javascripts/jquery.pikachoose.js"></script>
<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" type="text/css" href="css/pikacss3.css" />
<script language="javascript">
$(document).ready(function ()
{
		$("#pikachoose").PikaChoose({showTooltips:false});
		$(".css-tabs:first").tabs(".css-panes:first > div");
		$(".addcar").click(function()
		{
			//alert($(this).attr('id'));
			var id=$(this).attr('id');
			$.ajax
			({
				url: 'include/addcar.php',
				type: 'POST',
				data: {id: id},
				error: function(xhr) {},
				success: function(response) 
				{
					if(response==1)
					{
						alert('此商品已在購物車內。');
					}
					else if(response==2)
					{
						alert('成功將此商品加入到購物車！');
					}
					else if(response==3)
					{
						alert('失敗，請稍候再試');
					}
					else if(response==-1)
					{
						alert('需要登入會員！');
					}	
					
				}
			})
		
		})
});
</script>

			<div class="good_infobg whitebg">
			
				<div class="pikachoose floatL">
					<ul id="pikachoose"> 
					<?php
						 $images = glob("images/store/images/".$row['GOODS_ID']."{*.gif,*.jpg,*.png}", GLOB_BRACE);
						 for($i=0;$i<count($images);$i++)
						 echo '<li class="fullimg"><img src="'.$images[$i].'" /></li>';
					?>
					</ul>
				</div>

				<div class="good_name">
				<?php echo $row['GOODS_NAME'];?>
				</div>
				
				<div class="good_id right">
				<?php echo "編號：".$row['GOODS_ID'];?>
				</div>
				
				<div class="good_feature left">
					<?php echo  $row['GOODS_DESC']?>
				</div>
				<div class="good_underline "></div>
				
				<div class="imgbottom">
					<div class="good_times floatR">
						<p>倍數</p><p>ｘ</p>
						<img src="images\store\times\<?php echo  $row['TIMES']?>.png">
					</div>
					<div class="floatR">
						<div class="good_price right">
							<div class="floatL">兌換</div><span class="good_price_number textunderline"><?php echo $row['CO_PRICE'];?></span><span class="good_unit"><img src="images/co.png"></span>
						</div>
						<div class="good_price right" style="display:none">
							<div class="floatL">特價</div><span class="good_price_number textunderline"><?php echo $row['NT_PRICE'];?></span><span class="good_unit">&nbsp元</span>
						</div>
						<div class="good_price right">
							<div class="floatL">規格</div><span class="good_price_number textunderline"><select style="width:120px">
							<?php
							$size_token=explode("&",$row['GOODS_SIZE']);
							for($i=0;$i<count($size_token);$i++)
								echo '<option>'.$size_token[$i].'</option>';
							
							?>
							</select></span>
						</div>
					</div>
				</div>
				
				<div class="clearboth"></div>
				
				<div class="good_button">
					<img src="images/store/buttontrace.png"><input style="margin-right: 25px;" id="<?php echo $row['GOODS_ID'];?>" class="addcar"  type="image" src="images/store/buttoncar.png" /><img src="images/store/buttonco.png">
				</div>
				
				
			</div>
			
			<div class="good_info left" style="line-height:150%">
				<ul class="css-tabs">
				<li><a>商品特色</a></li>
				<li><a>商品規格</a></li>	
				<li><a>商品運送</a></li>
				<li><a>商品保證</a></li>
				<li><a>服務說明</a></li>
				
				</ul>
				<!-- panes -->
				<div class="css-panes corner" data-corner="BOTTOM">

				<?php
				$bodytag = str_replace("<div", "<p",$row['GOODS_INFO']);
				$bodytag = str_replace("</div", "</p",$bodytag );
				$info_token=explode("&Separated",$bodytag);
				for($i=0;$i<count($info_token);$i++)
					echo '<div>'.$info_token[$i].'</div>';		
				?>
				  			  
				</div>
				<!-- panes end-->
			</div>
			

			<!--
			<div class="good_buymore whitebg corner">
				<p class="left">加購相關商品：（可複選）</p>
				<div class="buymore_block floatL">
					<INPUT TYPE=CHECKBOX NAME="mushrooms"   />
					<div class="buymore_img fullimg"><img src="images/no.png"></div>
					<div class="buymore_info">
						<p class="buymore_name">名字</p>
						<p>1</p>
						<p>1</p>
						<p>1</p>
					
					</div>
				</div>
				<div class="buymore_block floatL">
					<INPUT TYPE=CHECKBOX NAME="mushrooms"   />
					<div class="buymore_img fullimg"><img src="images/no.png"></div>
					<div class="buymore_info">
						<p class="buymore_name">名字</p>
						<p>1</p>
						<p>1</p>
						<p>1</p>
					
					</div>
				</div><div class="buymore_block floatL">
					<INPUT TYPE=CHECKBOX NAME="mushrooms"   />
					<div class="buymore_img fullimg"><img src="images/no.png"></div>
					<div class="buymore_info">
						<p class="buymore_name">名字</p>
						<p>1</p>
						<p>1</p>
						<p>1</p>
					
					</div>
				</div><div class="buymore_block floatL">
					<INPUT TYPE=CHECKBOX NAME="mushrooms"   />
					<div class="buymore_img fullimg"><img src="images/no.png"></div>
					<div class="buymore_info">
						<p class="buymore_name">名字</p>
						<p>1</p>
						<p>1</p>
						<p>1</p>
					
					</div>
				</div>
				
				<div class="clearboth"></div>
				
			
			</div>
			加購-->
			<div class="good_button">
				<img src="images/store/buttontrace.png"><input style="margin-right: 25px;" id="<?php echo $row['GOODS_ID'];?>" class="addcar"  type="image" src="images/store/buttoncar.png" /><img src="images/store/buttonco.png">
			</div>


<?php
	}
	else
	{  /*末端選單頁面<div class="store_head">
					<?php echo $chose[0]."焦點";?>
				</div>*/
		?>
			
			
			<div class="store_focus">		
				<div style="display:none">
				<div id="gallery" style="margin-top:5px;min-height:300px"> <img src='images/01.png' /> <img src='images/02.png' /> <img src='images/03.png' /> <img src='images/04.png' /> <img src='images/05.png' /> <img src='images/06.png' /> </div>
				</div>
			</div>
			
<?php
		if(count($chose)<3)
		{
?>
			
			<!-- block start -->
			<div class="store_block corner">
				<div class="store_head">
					最新精選
				</div>
				<ul class="store_ul">
					<?php 
					$max++;
					for($i=0;$i<count($menu[$max]);$i+=2)
					{ 
						echo '<li class="store_li store_head'.($i/2+1).' corner" data-corner="TOP 5px">'.$menu[$max][$i].'</li>';
					}
					?>	
				</ul>
				<div class="store_container whitebg corner" data-corner="BOTTOM">
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					
				</div>
			
			</div>
			<!-- block end -->
			
			<!-- block start -->
			<div class="store_block corner">
				<div class="store_head">
					限時特價
				</div>
				<ul class="store_ul">
					<?php 
					//$max++;
					for($i=0;$i<count($menu[$max]);$i+=2)
					{ 
						echo '<li class="store_li store_head'.($i/2+1).' corner" data-corner="TOP 5px">'.$menu[$max][$i].'</li>';
					}
					?>	
				</ul>
				<div class="store_container whitebg corner" data-corner="BOTTOM">
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					
				</div>
			
			</div>
			<!-- block end -->
			
			<!-- block start -->
			<div class="store_block corner">
				<div class="store_head">
					倍數最多
				</div>
				<ul class="store_ul">
					<?php 
					//$max++;
					for($i=0;$i<count($menu[$max]);$i+=2)
					{ 
						echo '<li class="store_li store_head'.($i/2+1).' corner" data-corner="TOP 5px">'.$menu[$max][$i].'</li>';
					}
					?>	
				</ul>
				<div class="store_container whitebg corner" data-corner="BOTTOM">
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					<div class="store_list yellowbg">
					
					</div>
					
				</div>
			
			</div>
			<!-- block end -->
<?php
		}
		else
		{
			$key=$_GET['menu'];
			$sql="SELECT * FROM `store_good` WHERE `KIND_ID`='$key' AND `ONLINE`='1'";
			$rows=mysql_query($sql,$link);
			if(!mysql_num_rows($rows))
			{
				echo "此區暫無商品";
			}
			else
			{
				$sql2="SELECT * FROM `specialinfo`";
				$rows2=mysql_query($sql2,$link);
				$i=1;
				while($row2 = mysql_fetch_assoc($rows2))
				{
					$special[$i]=$row2['VALUE'];
					$i++;
				}
?>
<script language="javascript">
$(document).ready(function ()
{

});
</script>
			<!-- block start -->
			<div class="store_block whitebg corner">
				<div class="store_block_head">
					<div class="floatL store_sortby">
						<a>依時間排序</a>｜
						<a>依價錢排序</a>｜
						<a>依倍數排序</a>
					</div>
					<div class="floatR store_page">
						<label>正在第</label>
						<span>
						1
						</span>
						<label>頁</label>
					</div>
					<div class="clearboth"></div>
				</div>
				
				<div class="font0">
					<!-- good start -->
					<?php
					while($row = mysql_fetch_assoc($rows))
					{
					$images = glob("images/store/images/".$row['GOODS_ID']."{*.gif,*.jpg,*.png}", GLOB_BRACE);
					if(empty($images))
					$images[0]="images/no.png";
					echo '<div class="inlineblock store_good">'.
					'<div class="whitebg" style="padding:5px">'.
						'<div class="store_good_bg corner">'.
							'<p class="store_good_name">'.$row['GOODS_NAME'].'</p>'.
							'<div class="floatL store_good_head whitebg corner" data-corner="TOP 5px">'.
								'<p>'.$special[$row['GOODS_SPECIAL']].'</p>'.
							'</div>'.
							'<div class="floatR store_good_times fullimg">'.
								'<img src="images/store/times/'.$row['TIMES'].'.png"/>'.
							'</div>'.
							'<div class="clearboth"></div>'.
							'<a style="text-decoration: none" href="store.php?goodid='.$row['GOODS_ID'].'">'.
							'<div class="store_good_container whitebg corner" data-corner="TR BR BL 5px">'.
								'<div class="store_good_img yellowbg fullimg">'.
								'<img src="'.$images[0].'"></div>'.
								'<div class="store_good_price right imgbottom">'.
									'<span>'.$row['CO_PRICE'].'</span>'.
									'<img src="images/co.png">'.
								'</div>'.
							'</div>'.
							'</a>'.
						'</div>'.
					'</div>'.
					'</div>';
					}
					?>
					<!-- good end -->
				</div>
				
				<div class="store_block_head">
					<div class="floatL store_sortby">
						<a>依時間排序</a>｜
						<a>依價錢排序</a>｜
						<a>依倍數排序</a>
					</div>
					<div class="floatR store_page">
						<label>正在第</label>
						<span>
						1
						</span>
						<label>頁</label>
					</div>
					<div class="clearboth"></div>
				</div>
				
			
			</div>
			<!-- block end -->
<?php
			}
		}   
	}    
}
else
{
	
	if($_GET['act']=='car') //購物車
	{
		if (!isset( $_SESSION['id']))
		{
			header("Location: login.php?next=http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
			die();
		}
		$sql="SELECT * FROM `shopping_car` WHERE `ID`='".$_SESSION['id']."'";
		$rows=mysql_query($sql,$link);
		if(!mysql_num_rows($rows))
		{
			$id=$_SESSION['id'];
			$sql="INSERT INTO `shopping_car` (`ID`) 
                           VALUES ('$id')";
			mysql_query($sql,$link);
			$sql="SELECT * FROM `shopping_car` WHERE `ID`='".$_SESSION['id']."'";
			$rows=mysql_query($sql,$link);
		}
		$row = mysql_fetch_assoc($rows);
		$good_token=explode("&",$row['GOODS_ID']);
		$good_token=array_filter($good_token);
		//var_dump(array_filter($good_token, 'is_numeric'));
		//var_dump($good_token);		
		if($good_token!=array_filter($good_token, 'is_numeric'))
		{
			$sql="UPDATE  `shopping_car` SET  `GOODS_ID` =''  WHERE `ID` = '".$_SESSION['id']."'";
			mysql_query($sql,$link);
			die('購物車數值錯誤，請重新整理');
		}
		//var_dump($good_token);
		$ids = join(',',$good_token); 
		if($ids=='')
		$ids='-1';
		//var_dump($ids);
	    $sql="SELECT *".
			 "FROM `store_good`".
			 "WHERE `store_good`.`GOODS_ID` IN ($ids)";
		//var_dump($sql);
		$rows=mysql_query($sql,$link);
?>
<script type="text/javascript">
$(document).ready(function() {
	$('.car_good_amount').change(function() 
	{
	//alert("123");
		var times=0;
		var sum= 0;
        $('.num option:selected').each(function() 
		{
			
			var price=$(this).attr('price');
			var num=$(this).attr('value');
			var time=$(this).attr('times');
			if(time>times&&num!=0)
			times=time;
			sum+=price*num;
			
        });
	$('.sum').text(sum);
	if(times!=0)
	$('.times').attr("src","images/store/times/"+times+".png").attr("style","display:block");
	else
	$('.times').attr("style","display:none");
	});
});
</script>
	 <!--text-->
	 <div class="text whitebg corner store_textbg" style="padding:15px"> 
		
		<div class="corner" style="padding:5px;padding-bottom:10px;background-color:#FCF0DC">
			<ul class="tableul store_ul_car">
				<li class="tableli store_li_car corner" data-corner="TOP 5px">我最近瀏覽紀錄</li>
				<li class="tableli store_li_car corner" data-corner="TOP 5px">我的追蹤清單</li>
				<li class="tableli store_li_car corner store_li_car_chose" data-corner="TOP 5px">我的購物車</li>
			</ul>
			<div class="whitebg corner store_car_container" data-corner="BOTTOM">
				<div class="right" style="margin-bottom:5px;">
					總共<span style="color:#A82828;font-size:20px;"><?php echo mysql_num_rows($rows);?></span>項。
				</div>
				<form action="store.php?act=checkout" method="post">
				<div class="car_good_container corner" data-corner="10px">
					<div class="car_good_head b">
						<label class="inlineblock" style="width:270px;">商品</label>
						<label class="inlineblock" style="width:100px;">規格</label>
						<label class="inlineblock" style="width:100px;">單價</label>
						<label class="inlineblock" style="width:70px;">數量</label>
						<label class="inlineblock" style="width:70px;">倍數</label>
					</div>
					
					<?php
					$sum=0;
					$times=0;
					if(mysql_num_rows($rows))
					{
				
						while($row = mysql_fetch_assoc($rows))
						{
							$images = glob("images/store/images/".$row['GOODS_ID']."{*.gif,*.jpg,*.png}", GLOB_BRACE);
							if (empty($images)) $images[0]='';
							echo '<div class="car_good whitebg corner">';
							echo '<input type="hidden" name="goodid[]" value="'.$row['GOODS_ID'].'" />';
							echo '	<div class="car_good_img fullimg imgmiddle"><img src="'.$images[0].'"/></div>';
							echo '	<div class="car_good_name b">'.$row['GOODS_NAME'].'</div>';
							echo '	<div class="car_good_separator"></div>';
							echo '	<div class="car_good_size"><select name="size[]" style="width:80px">';
							$size_token=explode("&",$row['GOODS_SIZE']);
							for($i=0;$i<count($size_token);$i++)
								echo '<option>'.$size_token[$i].'</option>';
							echo '</select></div>';
							echo '	<div class="car_good_separator"></div>';
							echo '	<div class="car_good_price b">'.$row['CO_PRICE'].'</div>';
							echo '	<div class="car_good_separator"></div>';
							echo '	<div class="car_good_amount" price="'.$row['CO_PRICE'].'"><select name="num[]" class="num">';
							for($i=0;$i<16;$i++)
							{
								if($i!=1)
									echo '<option value="'.$i.'" price="'.$row['CO_PRICE'].'" times="'.$row['TIMES'].'">'.$i.'</option>';
								else
									echo '<option value="'.$i.'" price="'.$row['CO_PRICE'].'" times="'.$row['TIMES'].'" selected>'.$i.'</option>';
							}
							echo '</select></div>';
							echo '	<div class="car_good_separator"></div>';
							echo '	<div class="car_good_times fullimg"><img src="images/store/times/'.$row['TIMES'].'.png"></div>';
							echo '</div>';
							$sum+=$row['CO_PRICE'];
							if($times<$row['TIMES'])
							$times=$row['TIMES'];
						}
						
					}
					?>
					
				</div>
				<div class="car_total corner left b">
				小&nbsp計&nbsp：
					<div class="car_total_text whitebg corner">
						<div class="car_total_left left">消費總額</div><div class="car_total_center center"><span class="sum"><?php echo $sum;?> </span></div><div class="car_total_right right"><img src="images/co.png"></div>
						<div class="car_total_underline"></div>
						<div class="car_total_left left">本次最高</div><div class="car_total_center center"><div class="car_good_times fullimg"><img class="times" src="images/store/times/<?php echo $times ?>.png"></div></div><div class="car_total_right right">倍數</div>
						<div class="car_total_underline"></div>
						<div class="car_total_left left">可得轉利基數</div><div class="car_total_center center"><span class="sum"><?php echo $sum;?></span></div><div class="car_total_right right">金</div>
					</div>
				</div>
				<?php
				if($ids!=-1)
				echo '<input type="image" style="margin-top:10px;" src="images/store/checkout.png"/>';
				?>
				</form>
			</div>
	
<?php
	}
	else if($_GET['act']=='checkout') //結帳
	{
		if(empty($_POST["goodid"])||empty($_POST["size"])||empty($_POST["num"])||empty($_SESSION["id"]))
		die();
		//var_dump($_POST);
		
		$ids = join(',',$_POST["goodid"]); 
		$sql="SELECT *".
			 "FROM `store_good`".
			 "WHERE `store_good`.`GOODS_ID` IN ($ids)";
		$rows=mysql_query($sql,$link);
		$good=array();
		$count=0;
		while($row = mysql_fetch_assoc($rows))
		{
			$key = array_search($row["GOODS_ID"], $_POST["goodid"]);
			$size=$_POST["size"][$key];
			$size = str_replace(" ", "",$size);
			$size_token=explode("&",$row['GOODS_SIZE']);
			for($i=0;$i<count($size_token);$i++)
				$size_token[$i] = str_replace(" ", "",$size_token[$i]);
			if(($_POST["num"][$key]!=0)&&(in_array($size,$size_token)))
			{
				$good[$count]["id"]=$row["GOODS_ID"];
				$good[$count]["name"]=$row["GOODS_NAME"];
				$good[$count]["co"]=$row["CO_PRICE"];
				$good[$count]["nt"]=$row["NT_PRICE"];
				$good[$count]["times"]=$row["TIMES"];
				$good[$count]["num"]=$_POST["num"][$key];
				$good[$count]["size"]=$size;
				
				$count++;
			}
		}
		$_SESSION['good']=$good;
		$sql="SELECT * FROM `data` WHERE `ID`='".$_SESSION['id']."'";
		$rows2=mysql_query($sql,$link);
		$row2 = mysql_fetch_assoc($rows2);
		$sql="SELECT * FROM `account` WHERE `ID`='".$_SESSION['id']."'";
		$rows3=mysql_query($sql,$link);
		$row3 = mysql_fetch_assoc($rows3);
		
		//var_dump($good);
?>
<script src="javascripts/twzipcode-1.4.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function() {

	$("#same").click(function() 
	{
	//alert(123);
		if($("#same").attr("checked"))
		{
			$(".issame").attr("style","display:block");
			$(".nosame").attr("style","display:none");
		}
		else
		{
	        $(".nosame").attr("style","display:block");
			$(".issame").attr("style","display:none");
		}
	});
	
	$('#container').twzipcode(
	{
		css: ['addr3-county', 'addr3-area', 'addr3-zip']
	});
	
	//確認寄件者資料確實填寫
	$("#form1").submit(function() {	
      if (checkfields()) {
	  var r=confirm("按下確定後，將完成交易並扣除金額");
        if(r==true)
		{
			$("input#formsubmit").before('<p>請稍候</p>');
			$("input#formsubmit").remove();
			return true;
		}
		else
			return false;
      }
	  else
	  {
	  $('.nosame').addClass('field_error');
	  $('#previous').addClass('field_error');
	  alert("請確認收件人資料及剩餘金額");
      return false;
	  }
    });
	
	
	function checkfields(){
	var same=$('#same').attr('checked');
	var remaining=$('#remaining').html();
		if(remaining>=0&&(same == "checked" ||($("#address").val()!=''&&$('.addr3-area').val()!=''&&$('#name').val()!=''&&$('#phone').val()!=''&&$('#fixphone').val()!='')))	
			return true;
		else 
			return false;
	
}
});
</script>

	<!--text-->
	 <div class="text whitebg corner store_textbg" style="padding:15px"> 
		
		<div class="corner" style="padding:5px;padding-bottom:10px;background-color:#FCF0DC">
			<ul class="tableul store_ul_car">
				<li class="tableli store_li_car corner" data-corner="TOP 5px">結帳櫃檯</li>
			</ul>
			<form id="form1" action="store.php?act=pay" method="post">
			<div class="whitebg corner store_car_container" data-corner="BOTTOM">
				<div class="car_total corner left">
				<span class="checkout_fontcolor">購&nbsp物&nbsp明&nbsp細&nbsp：</span>
					<div class="car_total_text whitebg corner" style="padding-bottom:50px;">
						<span class="b" style="color:#B2C6B2;"><div class="center" style="width:200px;">商&nbsp&nbsp品</div><div class="center" style="width:90px;">規&nbsp格</div><div class="center" style="width:90px;">數&nbsp量</div><div class="right" style="width:150px;">小&nbsp計</div></span>
						<div class="car_total_underline" style="width:550px;"></div>
						<?php
						$sum=0;
						for($i=0;$i<count($good);$i++)
						{
							echo '<div class="left" style="width:190px;padding-left:10px;">'.$good[$i]["name"].'</div>'.
							'<div class="center" style="width:90px;">'.$good[$i]["size"].'</div>'.
							'<div class="center" style="width:90px;">'.$good[$i]["num"].'</div>'.
							'<div class="right" style="width:150px;">'.$good[$i]["co"].'</div>'.
							'<div class="car_total_underline" style="width:550px;"></div>';
							$sum+=$good[$i]["co"]*$good[$i]["num"];
						}
						?>
						
						<div class="floatR right checkout_total"><?php echo $sum; ?></div><div class=" right floatR" style="padding-top:10px;color:#224722">消費總金額</div>
					</div>
				</div>
				<div class="car_total corner left">
					<span class="checkout_fontcolor">選&nbsp擇&nbsp附&nbsp款&nbsp方&nbsp式&nbsp：</span>
					<ul class="floatR tableul checkout_ul imgmiddle">
						<!--<li class="tableli checkout_li corner center" data-corner="TOP 5px">現金購買</li>-->
						<li class="tableli checkout_li corner store_li_car_chose center" data-corner="TOP 5px"><img src="images/co.png">幣兌換</li>	
					</ul>
					<div class="car_total_text whitebg corner" style="padding-top:10px;margin-top:15px;" data-corner="BOTTOM">
						<div class="car_total_left center">會員</div><div class="car_total_center center" style="color:#000000"><?php echo $row2["NAME"]; ?> </div><div class="car_total_right right">先生/小姐</div>
						<div class="car_total_underline"></div>
						<div class="car_total_left center">原有</div><div id="previous" class="car_total_center center"><?php echo $row3["CO"]; ?></div><div class="car_total_right right"><img src="images/co.png"></div>
						<div class="car_total_underline"></div>
						<div class="car_total_left center">使用</div><div class="car_total_center center"><?php echo $sum; ?></div><div class="car_total_right right"><img src="images/co.png"></div>
						<div class="car_total_underline"></div>
						<div class="car_total_left center">剩餘</div><div id="remaining" class="car_total_center center"><?php echo $row3["CO"]- $sum; ?></div><div class="car_total_right right"><img src="images/co.png"></div>
						<div class="car_total_underline"></div>
						<!--<div class="center" style="color:#E95513;font-size:25px;width:100%;padding:10px 0 10px 0;">成&nbsp功&nbsp兌&nbsp換</div>-->
					</div>
				</div>   																<!--h_代表hidden-->
				<div class="car_total corner left">
				<span class="checkout_fontcolor">資&nbsp料&nbsp確&nbsp認&nbsp：</span>
					<div class="car_total_text whitebg corner" style="padding-bottom:10px;">
						<span class="b" style="color:#B2C6B2;"><div class="left" style="width:200px;">付&nbsp&nbsp款&nbsp&nbsp人&nbsp&nbsp資&nbsp&nbsp料</div></span><br>
						<div class="checkout_field">姓名&nbsp <span style="padding-left:30px"> <?php echo $row2["NAME"]?> </span><input type="hidden"  name="h_name" value="<?php echo $row2["NAME"]?>" /></div><br>
						<div class="checkout_field">手機&nbsp <span style="padding-left:30px"> <?php echo $row2["PHONE"]?>  </span><input type="hidden"  name="h_phone" value="<?php echo $row2["PHONE"]?>" /></div><br>
						<div class="checkout_field">市話&nbsp <span style="padding-left:30px"> <?php echo $row2["FIXPHONE"]?>  </span><input type="hidden"  name="h_fixphone" value="<?php echo $row2["FIXPHONE"]?>" /></div><br>
						<div class="checkout_field">地址&nbsp <span style="padding-left:30px"> <?php echo $row2["COUNTY"].$row2["DISTRICT"].$row2["ADDRESS"]?></div><br>
						<input type="hidden"  name="h_county" value="<?php echo $row2["COUNTY"]?>" />
						<input type="hidden"  name="h_district" value="<?php echo $row2["DISTRICT"]?>" />
						<input type="hidden"  name="h_address" value="<?php echo $row2["ADDRESS"]?>" />
					</div>
					<div class="car_total_text whitebg corner" style="padding-bottom:10px;">
						<span class="b" style="color:#B2C6B2;"><div class="left" style="width:200px;">收&nbsp&nbsp件&nbsp&nbsp人&nbsp&nbsp資&nbsp&nbsp料</div></span>
						<span class="b" style="color:#B2C6B2;font-size:14px;"><input style="margin-top:5px;" id="same" name="same" type="checkbox" value="1">&nbsp&nbsp同付款人資料</span><br>
						<div class="issame" style="display:none">
						<div class="checkout_field">姓名&nbsp <span style="padding-left:30px"> <?php echo $row2["NAME"]?> </span></div><br>
						<div class="checkout_field">手機&nbsp <span style="padding-left:30px"> <?php echo $row2["PHONE"]?>  </span></div><br>
						<div class="checkout_field">市話&nbsp <span style="padding-left:30px"> <?php echo $row2["FIXPHONE"]?>  </span></div><br>
						<div class="checkout_field">地址&nbsp <span style="padding-left:30px"> <?php echo $row2["COUNTY"].$row2["DISTRICT"].$row2["ADDRESS"]?></div><br>
						</div>
						<div class="nosame">
						<div class="checkout_field">姓名&nbsp <input type="text" id="name"  name="name" maxlength="12" size="30"/></div><br>
						<div class="checkout_field">手機&nbsp <input type="text" id="phone"  name="phone" maxlength="12" size="30"/></div><br>
						<div class="checkout_field">市話&nbsp <input type="text" id="fixphone"   name="fixphone" maxlength="12" size="30"/></div><br>
						<div class="checkout_field">地址&nbsp <span id="container"></span><input type="text" id="address" name="address"  size="30"/></div><br>
						</div>
						<div class="checkout_field">備註&nbsp <input type="text" id="note" name="note"  size="30"/></div><br>
					</div>
					<div class="car_total_text whitebg corner" style="padding-bottom:10px;">
						<span class="b" style="color:#B2C6B2;"><div class="left" style="width:200px;">發&nbsp&nbsp票</div></span>
						<span class="b" style="color:#B2C6B2;font-size:14px;">若金額是co幣，則不具發票，請見購物需知。</span><br>
						<div style="padding-top:10px;"><input style="margin-left:10px;" type="radio" name="receipt" value="donate" checked />&nbsp捐贈<input style="margin-left:10px;" type="radio" name="receipt" value="e-receipt" />&nbsp開立電子發票</div>
					</div>
				</div>
				
				<div class="car_total corner left">
				<span class="checkout_fontcolor">注&nbsp意&nbsp事&nbsp項&nbsp：</span>
					<div class="car_total_text whitebg corner" style="padding:10px;line-height:20px;">
						當您按下結帳按鈕時，本次交易便已成功送出。若送出後，您需要取消交易，或更改收件人資料時，請聯絡<a href="http://www.zlf168.com/service.php?step=ask">客服人員</a>。
					</div>
				</div>
				
				<input id="formsubmit" type="image" style="margin-top:10px;" src="images/store/checkout.png"/>
				</form>
			</div>

<?php	
	}
	else if($_GET['act']=='pay')
	{
		if(empty($_SESSION['good']))
		{
			die();
		}
		//var_dump($_POST);
		include('include/check.php');
		$name=$phone=$fixphone=$zip=$county=$district=$address=$note=$receipt='';
		if(!empty($_POST['same']))
		{
			
			if(checkphone($_POST['h_phone'])&&checkfixphone($_POST['h_fixphone'])&&checkname($_POST['h_name'])&&
			!empty($_POST['h_address'])&&!empty($_POST['h_county'])&&!empty($_POST['h_district']))
			{
				
				$name=$_POST['h_name'];
				$phone=$_POST['h_phone'];
				$fixphone=$_POST['h_fixphone'];
				$county=$_POST['h_county'];
				$district=$_POST['h_district'];
				$address=$_POST['h_address'];;
				$receipt=$_POST['receipt'];
			}
		}
		else if(!empty($_POST['name'])&&!empty($_POST['phone'])&&!empty($_POST['address'])&&!empty($_POST['county'])&&!empty($_POST['district'])&&!empty($_POST['zipcode']))
		{
			if(!checkphone($_POST['phone'])||($_POST['fixphone']&&!checkfixphone($_POST['fixphone']))||!checkname($_POST['name']))
			{
				$name=$_POST['name'];
				$phone=$_POST['phone'];
				$fixphone=$_POST['fixphone'];
				$zip=$_POST['zipcode'];
				$county=$_POST['county'];
				$district=$_POST['district'];
				$address=$_POST['address'];
				$note=$_POST['note'];
				$receipt=$_POST['receipt'];
			}
		}
		else
		{
			die("資料錯誤");
		}
		if(!empty($_POST['note']))
		$note=$_POST['note'];
		
		
		
		
		$oldgood=$_SESSION['good'];
		unset($_SESSION['good']);
		//var_dump($oldgood);
		$ids=array();
		for($i=0;$i<count($oldgood);$i++)
		{
			array_push($ids,$oldgood[$i]['id']);
		}
		$ids = join(',',$ids); 
		
		 $sql="SELECT *".
			 "FROM `store_good`".
			 "WHERE `store_good`.`GOODS_ID` IN ($ids)";
		$rows=mysql_query($sql,$link);
		$good=array();
		$count=0;
		$sum=0;
		while($row = mysql_fetch_assoc($rows))
		{
			$key=-1;
			for($i=0;$i<count($oldgood);$i++) //找物品id相對於在變數oldgood裡面.
			{
				if($row["GOODS_ID"]==$oldgood[$i]['id'])
				$key=$i;
			}
			if($key == -1) continue; //未找到key時, 跳到下一個迴圈.
			//echo "<br>GOODS_ID=".$row["GOODS_ID"];
			//echo "<br>key=".$key;
			$size=$oldgood[$key]["size"];
			$size = str_replace(" ", "",$size); //移除空白
			$size_token=explode("&",$row['GOODS_SIZE']);
			for($i=0;$i<count($size_token);$i++)
				$size_token[$i] = str_replace(" ", "",$size_token[$i]);
			if(($oldgood[$key]["num"]!=0)&&(in_array($size,$size_token)))
			{
				$good[$count]["id"]=$row["GOODS_ID"];
				$good[$count]["name"]=$row["GOODS_NAME"];
				$good[$count]["co"]=$row["CO_PRICE"];
				$good[$count]["nt"]=$row["NT_PRICE"];
				$good[$count]["times"]=$row["TIMES"];
				$good[$count]["num"]=$oldgood[$key]["num"];
				$good[$count]["size"]=$size;
				$sum = $sum + $row["CO_PRICE"]*$oldgood[$key]["num"];
				$count++;
			}
			
		}
		$ENCRYPTED_ID=time();
		$ip=realip();
		//檢查餘額
		 $sql="SELECT `CO`".
			 "FROM `account`".
			 "WHERE `ID` = '".$_SESSION['id']."'";
		$rows3=mysql_query($sql,$link);
		$row3 = mysql_fetch_assoc($rows3);
		
		if($row3['CO']<$sum)
		{
			die("餘額不足");
		}
		else
		{
		//扣錢
			$CO=$row3['CO']-$sum;
			$sql="UPDATE  `account` SET  `CO` ='".$CO."'  WHERE `ID` = '".$_SESSION['id']."'";
			mysql_query($sql,$link);
			$time=date("Y-m-d H:i:s",time()+8*60*60);
			$sql = "INSERT INTO `order_log` (`USER_ID`, `ENCRYPTED_ID`, `PREVIOUS_CO`, `REMAINING_CO`, `CO_SPENT`,`TIME`,`IP`)
							VALUES ('".$_SESSION['id']."', '$ENCRYPTED_ID', '".$row3['CO']."','$CO', '-$sum','$time','$ip')";	
			mysql_query($sql,$link);							
		}
			
		
		// 建立訂單
		$_SESSION['paygood']=$good;
		$_SESSION['CO']=array('previous'=>$row3['CO'], 'used'=>$sum, 'remaining'=>$CO);
		$_SESSION['ORDERNUM']=$ENCRYPTED_ID; // 訂單號碼
		//var_dump($good);
		
		$time=date("Y-m-d H:i:s",time()+8*60*60);
		$mailtable='<table style="text-align: right"><thead><th>商品編號</th><th>商品名稱</th><th>商品規格</th><th>商品數量</th><th>商品單價</th></thead><tbody>';		
		$sql = "INSERT INTO `order` (`USER_ID`, `ENCRYPTED_ID`, `CO_TOTAL`, `DATE`,`NAME`,`PHONE`,`FIXPHONE`,`ZIP`,`COUNTY`,`DISTRICT`,`ADDRESS`,`NOTE`,`RECEIPT`)
							VALUES ('".$_SESSION['id']."', '$ENCRYPTED_ID', '$sum', '$time','$name','$phone','$fixphone','$zip','$county','$district','$address','$note','$receipt')";				
		mysql_query($sql,$link);	
		for($i=0;$i<count($good);$i++)
		{
		 $sql = "INSERT INTO `order_goods` (`ENCRYPTED_ID`,`GOODS_ID`,`GOODS_NAME`,`GOODS_NUM`,`CO_PRICE`,`NT_PRICE`,`GOODS_SIZE`,`TIMES`)
							VALUES ('$ENCRYPTED_ID','".$good[$i]['id']."','".$good[$i]['name']."','".$good[$i]['num']."','".$good[$i]['co']."','".$good[$i]['nt']."','".$good[$i]['size']."','".$good[$i]['times']."')";
		mysql_query($sql,$link);
		$mailtable=$mailtable."<tr><td>".$good[$i]['id']."</td><td>".$good[$i]['name']."</td><td>".$good[$i]['size']."</td><td>".$good[$i]['num']."</td><td>".$good[$i]['co']."</td><tr>";
		}
		$mailtable=$mailtable."</tbody></table>";
		
		//寄信
		$sql="SELECT * FROM `data` WHERE `ID`='".$_SESSION['id']."'";
		$rowsuser=mysql_query($sql,$link);
		$rowuser = mysql_fetch_assoc($rowsuser);
		
		error_reporting(E_STRICT);
		
		date_default_timezone_set('America/Toronto');
		include('include/setting.php');
		require_once('mail/class.phpmailer.php');
		//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

		$mail             = new PHPMailer();

		//$body             = file_get_contents('mail/contents.php');
		//$body             = eregi_replace("[\]",'',$body);

		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "smtp.gmail.com"; // SMTP server
		$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "gogeili.service@gmail.com";  // GMAIL username
		$mail->Password   = "29039291";            // GMAIL password
		$mail->CharSet    = 'utf-8';

		$mail->SetFrom($service_email, '客服 人員');

		//$mail->AddReplyTo("onininonwork@gmail.com","First Last");

		$mail->Subject    = "GO給利購物訂單信，編號:".$ENCRYPTED_ID;

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		//$mail->MsgHTML($body);
		$mail->Body=
		'<body>
		感謝'.$_SESSION['id'].'，在'.$time.'時訂單成立，編號:'.$ENCRYPTED_ID.'<br>
		總消費金額<b style="color:red">'.$sum.'</b>co<br>
		以下為詳細內容<br>
		'.$mailtable
		.'<br>收件者:'.$name
		.'<br>電話:'.$phone
		.'<br>市話:'.$fixphone
		.'<br>地址:'.$county.$district.$address
		.'</body>
		';

		//$address = "onininonwork@gmail.com";
		$mail->AddBCC($service_email, $rowuser['NAME']);
		$mail->AddAddress($rowuser['MAIL'], $rowuser['NAME']);

		//$mail->AddAttachment("/mail/images/phpmailer.gif");      // attachment
		//$mail->AddAttachment("/mail/images/phpmailer_mini.gif"); // attachment
		$mail->Send();
		
		//清除購物車
		$sql="UPDATE  `shopping_car` SET  `GOODS_ID` =''  WHERE `ID` = '".$_SESSION['id']."'";
		mysql_query($sql,$link);
		
		header("Location:store.php?act=payover");
							
	}
	else if($_GET['act']=='payover')
	{
		//var_dump($_POST);
		
		$good=$_SESSION['paygood'];
		
		
?>
	<!--text-->
	 <div class="text whitebg corner store_textbg" style="padding:15px"> 
		
		<div class="corner" style="padding:5px;padding-bottom:10px;background-color:#FCF0DC">
			<ul class="tableul store_ul_car">
				<li class="tableli store_li_car corner" data-corner="TOP 5px">結帳櫃檯</li>
			</ul>
			<div class="whitebg corner store_car_container" data-corner="BOTTOM">
			<span style="font-weight:bold;font-size:17;color:green">您的訂單號碼為：<?php echo $_SESSION["ORDERNUM"]; ?></span>
				<div class="car_total corner left">
				<span class="checkout_fontcolor">購&nbsp物&nbsp明&nbsp細&nbsp：</span>
					<div class="car_total_text whitebg corner" style="padding-bottom:50px;">
						<span class="b" style="color:#B2C6B2;"><div class="center" style="width:200px;">商&nbsp&nbsp品</div><div class="center" style="width:90px;">規&nbsp格</div><div class="center" style="width:90px;">數&nbsp量</div><div class="right" style="width:150px;">小&nbsp計</div></span>
						<div class="car_total_underline" style="width:550px;"></div>
						<?php
						$sum=0;
						for($i=0;$i<count($good);$i++)
						{
							echo '<div class="left" style="width:190px;padding-left:10px;">'.$good[$i]["name"].'</div>'.
							'<div class="center" style="width:90px;">'.$good[$i]["size"].'</div>'.
							'<div class="center" style="width:90px;">'.$good[$i]["num"].'</div>'.
							'<div class="right" style="width:150px;">'.$good[$i]["co"].'</div>'.
							'<div class="car_total_underline" style="width:550px;"></div>';
							$sum+=$good[$i]["co"]*$good[$i]["num"];
						}
						?>
						
						<div class="floatR right checkout_total"><?php echo $sum; ?></div><div class=" right floatR" style="padding-top:10px;color:#224722">消費總金額</div>
					</div>
					

					<div class="car_total_text whitebg corner" style="padding-top:10px;margin-top:15px;">
						<div class="car_total_left center">原有</div><div class="car_total_center center"><?php echo $_SESSION["CO"]['previous']; ?></div><div class="car_total_right right"><img src="images/co.png"></div>
						<div class="car_total_underline"></div>
						<div class="car_total_left center">使用</div><div class="car_total_center center"><?php echo $_SESSION["CO"]['used']; ?></div><div class="car_total_right right"><img src="images/co.png"></div>
						<div class="car_total_underline"></div>
						<div class="car_total_left center">剩餘</div><div class="car_total_center center"><?php echo $_SESSION["CO"]['remaining']; ?></div><div class="car_total_right right"><img src="images/co.png"></div>
						<div class="car_total_underline"></div>
						<div class="center" style="color:#E95513;font-size:25px;width:100%;padding:10px 0 10px 0;">成&nbsp功&nbsp兌&nbsp換</div>
					</div>
		
				</div>
			</div>


<?php
		
	}
}	
?>		
		</div>
      
      

    </div>
    <!--text end-->
    




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
</body>
</html>