<?php
session_start();
include('include/w3.html');
$title='給利情報';
include('include/header.php');
?>

<script type="text/javascript" src="javascripts/galleria/galleria-1.2.5.min.js"></script>
<script type="text/javascript" src="javascripts/jquery.slidingGallery-1.2.min.js"></script>
<script type="text/javascript" src="javascripts/jquery.tools.min.js"></script>
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

	/*$('div.gallery2 img').slidingGallery
	({
		defaultLayout:'portrait',
		Pheight:100,
		Pwidth:150,
		Pzoom:zoomFunc,
		Lzoom:zoomFunc,
		gutterWidth:10,
		useCaptions:true,
		container: $('div.gallery2')
	});*/
	
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
<body class="gradiant_bg">
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
    <div class="floatL login whitebg left loginorange">
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
    <img src='images/news/banner_ad.png' style="margin:auto">
	  </img>
    </div>
    <!--news end--> 
    
<?php
if(empty($_GET['event']))
{	
?>
	<!--情報首頁-->
	<div class="rightmain floatR rightmain_bg">
	  
	  <!--event 1-->
	   <div> <a href="news.php?event=1"><img src="images/news/freecarS.png"/></a> </div>
	  <!--event 1 end-->
	  
	  <!--evemt 2-->
		<div> <a href="news.php?event=2"><img src="images/news/ipadeventS.png"/></a> </div>
	  <!--event 2 end-->
	  
	  
	  	<div style="clear:both; padding:20px">
		<a href="userinfo.php?act=rank"><img src="images/news/hitlist.png"/></a>
		</div>
	</div>

<?php
}
else if($_GET['event']==1)
{
?> 
	<!--活動1-->
	<div class="rightmain floatR rightmain_bg">
		<img src="images/news/freecar.png"/>
		<div style="clear:both; padding:20px">
		<a href="userinfo.php?act=rank"><img src="images/news/hitlist.png"/></a>
		</div>
	</div>
<?php
}
else if($_GET['event']==2)
{
?> 
	<!--活動2-->
	<div class="rightmain floatR rightmain_bg">
		<img src="images/news/ipadevent.png"/>
		<div style="clear:both; padding:20px">
		<a href="userinfo.php?act=rank"><img src="images/news/hitlist.png"/></a>
		</div>
	</div>
<?php
}
?> 


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