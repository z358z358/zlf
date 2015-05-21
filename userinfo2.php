<?php
include('include/session.php');
include('include/w3.html');
$title='會員中心';
include('include/header.php');
include('include/config.php');
$id=$_SESSION['id'];
$sql=	"SELECT * 
		FROM  `data`
		WHERE  `ID` =  '".$id."'";
$rows=mysql_query($sql,$link);
$row = mysql_fetch_assoc($rows);


?>
<script src="javascripts/twzipcode-1.4.js" type="text/javascript"></script>
<script src="javascripts/jquery.tipTip.minified.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/tipTip.css" />
<!--[if IE 6]>
     <link href="css/tipTip.ie6.css" media="screen" rel="stylesheet" type="text/css" />
 <![endif]-->
<script  type="text/javascript">
$(function(){
$(".row:odd").css("background-color", "#F7F7F7");
$(".row:even").css("background-color", "#D8EAEF");
$("label").css("color","#888888");
$(".label").css("font-weight","bold");
$(".label").css("color","#000000");
$("span").css("display","none");

});
</script>
<script src="javascripts/checkid.js" type="text/javascript"></script>
</header>
<body class="index">
<noscript> 
<div class="center"><b>此頁需要在所用瀏覽器上啟用 Javascript。</b></div>
</noscript>  
<div class="body center">
	<div class="logo floatL">
		<a href="http://www.zlf168.com/"><img src="images/logo.png" border="0"/></a>
	</div>
	<div class="clearboth"></div>
	<div class="floatL corner info whitebg left" style="padding:50px" data-corner="bottom TL 20px">
	
	
		<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>帳&nbsp號&nbsp名&nbsp稱</label>
		<label><?php echo $row["ID"]; ?></label>
		</div>

		<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>真&nbsp實&nbsp姓&nbsp名</label>
		<label><?php echo $row["NAME"]; ?></label>
		</div>
	
		<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>身分證字號</label>
		<label><?php if($row["FULL"]){ echo $row["SID"][0]."********".$row["SID"][9];} ?></label>
		</div>

		<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>出&nbsp生&nbsp日&nbsp期</label>
		<label><?php if($row["FULL"]){ echo $row["BIRTHDAY"][0].$row["BIRTHDAY"][1].$row["BIRTHDAY"][2]."*/**/".$row["BIRTHDAY"][8]."*";} ?></label>
		</div>
	
		<div class="row">
		<label class="label">詳&nbsp細&nbsp地&nbsp址</label>
		<label><?php if($row["FULL"]){ echo $row["COUNTY"].$row["DISTRICT"];for($j=0;$j<strlen($row["ADDRESS"]);$j++)echo "*";} ?></label>
		</div>
	
		<div class="row">
		<label class="label">電&nbsp子&nbsp信&nbsp箱</label>
		<label><?php echo $row["MAIL"];if($row["MAILACT"])echo " (已認證！)";else echo " (未認證！)"; ?></label>
		</div>
	
		<div class="row">
		<label class="label">手&nbsp機&nbsp號&nbsp碼</label>
		<label><?php if($row["FULL"]){ for($j=0;$j<4;$j++)echo $row["PHONE"][$j];echo "-***-*".$row["PHONE"][8].$row["PHONE"][9];} ?></label>
		</div>
	
		<div class="row">
		<label class="label">&nbsp固&nbsp定&nbsp電&nbsp話</label>
		<label>
		<?php
		if($row["FIXPHONE"]!=""&&$row["FULL"])
		{
			echo $row["FIXPHONE"][0].$row["FIXPHONE"][1].$row["FIXPHONE"][2]."****";
			for($i=7;$i<strlen($row["FIXPHONE"]);$i++)
			echo $row["FIXPHONE"][$i];
		}
		?>
		</label>
		</div>
	<div class="center" style="margin-top:20px">
	<a href="userinfoS1.php"><img src="images/eddit.png" border="0"/></a>
	</div>
	
	
	</div>
	<div class="left">
	<a href="userinfo.php"><img src="images/userinfo/userinfo.on.png" border="0"/></a>
	<a href="account.php"><img src="images/userinfo/rg.png." border="0"/></a>
	<a href="historyin.php"><img src="images/userinfo/thin.png" border="0"/></a>
	<a href="historyout.php"><img src="images/userinfo/thout.png" border="0"/></a>
	</div>
	<div class="clearboth">
	<?php 
	include('include/foot.html');
	?>
	</div>

</div>
</body>
</html>