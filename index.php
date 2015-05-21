<?php
session_start();
include('include/w3.html');
$title='首頁';
include('include/header.php');
include('include/config.php');
?>
<script type="text/javascript" src="javascripts/galleria/galleria-1.2.5.min.js"></script>
<script type="text/javascript" src="javascripts/jquery.slidingGallery-1.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	Galleria.loadTheme('javascripts/galleria/themes/classic/galleria.classic.min.js');
	$("#gallery").galleria
	({
		width: 700,
		height:300,
		debug:false,
		autoplay: true,
		queue: false,
		showInfo: false,
		showCounter: false
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
	$("#gallery").mouseover(function () 
	{
		$('#gallery').data('galleria').pause();
	}).mouseout(function () 
	{
		$('#gallery').data('galleria').play();
	});
	
	var pad=5;	
	$("div.newstext").each(function()
	{
		$(this).css("margin-top",pad+"px");
		pad=pad+25;
	})	
	
	$(".none").removeClass("none");
});
</script>
</header>
<body class="index">
<div class="body center">
  <noscript>
  <div class="center"><b>此頁需要在所用瀏覽器上啟用 Javascript。</b></div>
  </noscript>
  <!--logo + menu-->
  <?php
include('include/logomenu.php');
?>
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
      <div id="flashab" class="headab flashab" style=""></div>
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
    <!--news -->
    <div class="news">
      <div class="newsmain gallery2 none">
	   <?php
		$images = glob("images/store/images/index/focus{*.gif,*.jpg,*.png}", GLOB_BRACE);
		shuffle($images);
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
    <!--news end--> 
    
    <!--ad-->
    <div class="ad whitebg corner"> 
      <!--big ad-->
      <div id="gallery" style="margin-bottom:15px;min-height:300px"> 
	  <?php
		$images = glob("images/store/images/index/index{*.gif,*.jpg,*.png}", GLOB_BRACE);
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
		echo '<img src="'.$images[$i].'" longdesc="'.$adlink[$i].'" >'
	  ?>  
	  </div>
      <!--big ad end-->
		<div class="ectad left">
        <div class="actnews inlineblock shadow">
          <img src='images/index/head1.png' />
		  <?php
		 
			$images = glob("images/store/images/index/actnews{*.gif,*.jpg,*.png}", GLOB_BRACE);
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
				echo '<div class="actblock"><div class="fullimg" style="width:270px;height:105px">';
				if(empty($adlink[$i]))
					echo '<img src='.$images[$i].' />';
				else
					echo '<a href="'.$adlink[$i].'"><img src='.$images[$i].' /></a>';
				echo'</div></div>';
					
			}
		  ?>  
        </div>
		
		<div class="actnews inlineblock shadow">
          <img src='images/index/head2.png' />
          <?php
			$images = glob("images/store/images/index/store{*.gif,*.jpg,*.png}", GLOB_BRACE);
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
				echo '<div class="actblock"><div class="fullimg" style="width:270px;height:105px">';
				if(empty($adlink[$i]))
					echo '<img src='.$images[$i].' />';
				else
					echo '<a href="'.$adlink[$i].'"><img src='.$images[$i].' /></a>';
				echo'</div></div>';
					
			}
		  ?>  
        </div>
		
        <div class="goodnews inlineblock shadow">
          <img src='images/index/head3.png' />
          <div class="goodnews_img">
		  <?php
			$images = glob("images/store/images/index/good{*.gif,*.jpg,*.png}", GLOB_BRACE);
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
				if(empty($adlink[$i]))
					echo '<img src='.$images[$i].' />';
				else
					echo '<a href="'.$adlink[$i].'"><img src='.$images[$i].' /></a>';		
			}
		  ?>  
		  </div>
		</div>
      </div>
	 
    </div>
    <!--ad end--> 
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