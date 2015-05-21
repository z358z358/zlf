<?php
session_start();
include('include/w3.html');
$title='首頁';
include('include/header.php');
?>

<script type="text/javascript" src="javascripts/jquery.tools.min.js"></script>
<script type="text/javascript" src="javascripts/galleria/galleria-1.2.5.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		 Galleria.loadTheme('javascripts/galleria/themes/classic/galleria.classic.min.js');
		 $("#gallery").galleria({
			width: 700,
			height:300,
			debug:false,
			autoplay: true,
			queue: false,
			showInfo: false,
			showCounter: false
			});
		
		$("div.flashmenu").flashembed("/flash/left.swf");
		$("div.flashad").flashembed("/flash/test5.swf");
		
	/*	$(".opacity").css("opacity","0.5");
		
		 $(".opacity").hover(
			function() {
                $(this).stop().animate({ opacity:1.0 }, 500);
            },
			function() {
               $(this).stop().animate({ opacity: 0.5 }, 500);
           });*/
		   
		  $("#gallery").mouseover(
			function () {
				 $('#gallery').data('galleria').pause();
			}).mouseout(
			function () {
				 $('#gallery').data('galleria').play();
			});
			
			$("select#radio").change(function(){ //事件發生
			var val=$(this).val();
			switch(val)
			{
			case "0":
			$("iframe#radioframe",parent.document.body).attr("src","");
			break;
			default:
			$("iframe#radioframe",parent.document.body).attr("src","http://hichannel.hinet.net/player/radio/index.jsp?radio_id="+val);
			}
			
			
			
			});

	});
</script>
</header>


<script type="text/javascript"> 


</script>

<body class="index">
<div class="body center">
<noscript> 
<div class="center"><b>此頁需要在所用瀏覽器上啟用 Javascript。</b></div>
</noscript> 
	<!--logo + menu-->
	<div>
		<div class="logo floatL whitebg">
			<a href="index.php"><img src="images/logo.png" border="0" alt="首頁"/></a>
		</div>
	
		<div class="headmenu floatR  corner" data-corner="BL:60px cc:#FFFFFF">
			<div class="floatL">
			<select id="radio"><option value="210">亞洲電台</option><option value="0">關閉</option></select>
			</div>
			
			<div id="radiodiv" style="width:140px; height:38px; overflow:hidden; position:relative"> 
			<iframe src="http://hichannel.hinet.net/player/radio/index.jsp?radio_id=210"   height="180"  id="radioframe" style="position:absolute;top:-150px;left:-20px" scrolling="no"  marginwidth="0" marginheight="0" frameborder="0"></iframe> 
			</div>
		</div>
	</div>
	<!--logo + menu end-->
	
	<!--login + bigad-->
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
		<div class="headad floatR flashad"> <!--corner data-corner="right 83px" whitebg-->

		</div>
	</div>
	<!--login + bigad end-->
	
	<!--left menu-->
	<div  class="floatL" >
	<div class="leftmenu whitebg corner" data-corner="bottom 30px">
		<div class="flashmenu">
		</div>
		<br>
<?php
$date=date(" n月 j日 l ",time()+8*60*60);
echo $date;
?>
<br><br>
<table style="margin:auto" cellspacing="0" cellpadding="3" border="0"><tr><td rowspan="2">
<img height="31" src="http://udn.com/WEATHER/IMAGES/taipeiicon.gif" width="38"/></td><td colspan="3">
<a href="http://udn.com/WEATHER/taipei.htm" style="text-decoration: none"><b>台北</b></a></td></tr><tr><td>
<img height="13" src="http://udn.com/WEATHER/IMAGES/taipeilowtemp.gif" width="27"/></td><td>-</td> <td>
<img height="13" src="http://udn.com/WEATHER/IMAGES/taipeihightemp.gif" width="27"/></td></tr></table>
	</div>
	<div class="fullimg leftad" style="height:210px;width:250px"><img src="images/ad/left1.png"/></div>
	<div class="fullimg leftad" style="height:210px;width:250px"><img src="images/ad/left2.png"/></div>
	</div>
	
	<!--left menu end-->
	
	<!--right main-->
	<div class="rightmain floatR corner" data-corner="TL 60px cc:#FFFFFF">
		<!--news -->
		<div class="news corner left" data-corner="60px">
				<div class="newsmain">
					<div class="newstext">第一條
						<div class="underline"></div>
					</div>
					<div class="newstext">第二條
						<div class="underline"></div>
					</div>
				</div>
		</div>		
		<!--news end-->
		
		<!--ad-->
		<div class="ad whitebg corner">
			<!--big ad-->
			<div id="gallery" style="margin-bottom:15px">
			
			<img src='images/01.png' />
			<img src='images/02.png' />
			<img src='images/03.png' />
			<img src='images/04.png' />
			<img src='images/05.png' />
			<img src='images/06.png' />
			</div>
			<!--big ad end-->
			<div class="ectad left">
			
				<div class="actnews floatL">
				<p>活動消息</p>
				<div class="underline greenline" style="margin-bottom:10px;width:410px"></div>
					
					<div class="actblock">
						<div class="floatL"><img src='images/actnews1.png' /></div>
						<p style="margin-left: 125px;">123</p>
					</div>
					
					<div class="actblock">
					<div class="floatL"><img src='images/actnews1.png' /></div>
					<p>123</p>
					</div>
					
					<div class="actblock">
					<div class="floatL"><img src='images/actnews1.png' /></div>
					<p>123</p>
					</div>
					
					<div class="actblock">
					<div class="floatL"><img src='images/actnews1.png' /></div>
					<p>123</p>
					</div>
					
				</div>
				
				<div class="goodnews floatR">
				<p>好康情報</p>
				<div class="underline greenline" style="margin-bottom:10px;width:130px"></div>
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
	<div style="position:absolute;top:40px;left:0;z-index:100;width:100%;height:768px;overflow:hidden;visibility:hidden;"><div style="position:absolute;visibility:visible;left:50%;margin-left:-886px;margin-right:0;"><div class="fullimg" style="width:300px;height:600px"><img src="images/ad/indexleft.png"></div></div></div>
	<div style="position:absolute;top:40px;right:0;z-index:100;width:100%;height:768px;overflow:hidden;visibility:hidden;"><div style="position:absolute;visibility:visible;right:50%;margin-right:-886px;margin-left:0;"><div class="fullimg" style="width:300px;height:600px"><img src="images/ad/indexright.png"></div></div></div>
</div>



</body>
</html>