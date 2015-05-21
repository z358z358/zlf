<?php
include('include/session.php');
include('include/w3.html');
$title='會員中心';
include('include/header.php');
include('include/config.php');
$id=$_SESSION['id'];
$sql=	"SELECT * 
		FROM  `account`
		WHERE  `ID` =  '".$id."'";
$rows=mysql_query($sql,$link);
$row = mysql_fetch_assoc($rows);

?>
<script type="text/javascript">
	$(document).ready(function() {
		 
		 
$(".row:odd").css("background-color", "#F7F7F7");
$(".row:even").css("background-color", "#D8EAEF");
$("label").css("color","#888888");
$(".label").css("font-weight","bold");
$(".label").css("color","#000000");
$("span").css("display","none");
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
	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:177.5px"><a href="account.php"><img src="images/userinfo/rg.on.png." border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:355px"><a href="historyin.php"><img src="images/userinfo/thin.png" border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:532.5px"><a href="historyout.php"><img src="images/userinfo/thout.png" border="0"/></a></div>


		<div class="corner info whitebg left"  data-corner="bottom 20px">
		<div style="padding:15px">
		<div  style="height:200px;width:610px;margin:auto;margin-bottom:20px;background:url('images/userinfo/head.png') no-repeat;">
		<p class="right" style="padding:77px 290px 0 0;font-size:25px"><?php echo $row["MONEY"] ?></p>
		</b></div>
		<img style="margin-left:15px" src="images/userinfo/icash.png" border="0" usemap="#planetmap1"/>
		<img style="margin-left:25px" src="images/userinfo/credit.png" border="0" usemap="#planetmap2"/>
		<img style="margin-left:25px" src="images/userinfo/stores.png" border="0" usemap="#planetmap3"/>
	
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