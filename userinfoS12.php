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
$('#container').twzipcode({
	css: ['addr3-county', 'addr3-area', 'addr3-zip']
  
  });
$('.message').tipTip({activation:"focus",maxWidth: "auto"});
  
$("#form1").submit(function(){
var r=true;
if($("#email").val().length)
{
r=confirm("修改E-mail欄位，需要重新認證，才可以登入。\n確定修改E-mail?");
}
return r&&((!$("#address").val().length)||checkaddress())&&((!$("#email").val().length)||checkemail())&&((!$("#phone").val().length)||checkphone())&&((!$("#fixphone").val().length)||checkfixphone());
});

alert("只需要填入要修改的欄位");

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
		<label><?php echo $row["SID"][0]."********".$row["SID"][9]; ?></label>
		</div>

		<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>出&nbsp生&nbsp日&nbsp期</label>
		<label><?php echo $row["BIRTHDAY"][0].$row["BIRTHDAY"][1].$row["BIRTHDAY"][2]."*/**/".$row["BIRTHDAY"][8]."*"; ?></label>
		</div>
		
		
		<form id="form1" name="form1" method="POST" action="/userinfoS2.php">
		<div class="row">
		<label class="label">詳&nbsp細&nbsp地&nbsp址</label>
		<span id="container"></span>
		<input style="margin-left:110px" class="message" title="選擇完縣市鄉鎮後，填入後續地址" id="address" type="text" name="address" size="30" onblur="checkaddress();" />
		<span id="chkaddress"></span> 
		</div>
	
		<div class="row">
		<label class="label">電&nbsp子&nbsp信&nbsp箱</label>
		<input id="email" class="message" title="若修改信箱，需重新認證，才可以登入。" type="text" name="mail" size="30" onblur="checkemail();" />
		<span id="chkmail"></span> 
		</div>
	
		<div class="row">
		<label class="label">手&nbsp機&nbsp號&nbsp碼</label>
		<input id="phone" class="message" title="手機號碼" type="text" name="phone" size="30"   onblur="checkphone();" />
		<span id="chkphone"></span>
		</div>
	
		<div class="row">
		<label class="label">&nbsp固&nbsp定&nbsp電&nbsp話</label>
		<input id="fixphone" class="message" title="市話8~10碼，選填欄位" type="text" name="fixphone" onblur="checkfixphone();" size="30"/>
		<span id="chkfixphone"></span>
		</div>
	<div class="center" style="margin-top:20px">
	<input style="height:39px;width:135px;background: url(images/userinfo/confirm.png) no-repeat;border:0 none;vertical-align: top;" type="submit" name="Submit" value="" />
	<a href="javascript:history.back()"><img style="padding-left:20px" src="images/userinfo/cancel.png" border="0"/></a>
	</div>

	

	</form>
	
	
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