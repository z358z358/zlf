<?php
include('include/session.php');
include('include/w3.html');
$title='註冊';
include('include/header.php');
include('include/config.php');
$sql="SELECT * FROM `data` WHERE `ID`='$_SESSION[id]'";
$rows=mysql_query($sql,$link);
$row = mysql_fetch_assoc($rows);
if($row['FULL'])
{
header("Location: userinfo.php");
die();
}
?>
<script type="text/javascript" src="javascripts/jquery.tools.min.js"></script>
<script src="javascripts/twzipcode-1.4.js" type="text/javascript"></script>
<script src="javascripts/jquery.tipTip.minified.js" type="text/javascript"></script>
<script src="javascripts/checkidfull.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/tipTip.css" />
<!--[if IE 6]>
     <link href="css/tipTip.ie6.css" media="screen" rel="stylesheet" type="text/css" />
 <![endif]-->
<script type="text/javascript">
	$(document).ready(function() {
		 
		 
		$('#container').twzipcode({
		css: ['addr3-county', 'addr3-area', 'addr3-zip']
		});
		$('.message').tipTip({activation:"focus",maxWidth: "auto"});
		


var flagsize=true;
var maxsize=100000;
$('#Faccount').bind('change', function() {

  //this.files[0].size gets the size of your file.
  
  if(this.files[0].size>maxsize)
  {
	flagsize=false;
	alert("檔案需小於100kb");
  }
  else
  {
	flagsize=true;
  }

});


$('#Fcredit').bind('change', function() {

  //this.files[0].size gets the size of your file.
  
  if(this.files[0].size>maxsize)
  {
	flagsize=false;
	alert("檔案需小於100kb");
  }
  else
  {
	flagsize=true;
  }

});
		
	});
</script>
<style type="text/css">
div.row span img{
vertical-align:middle;
}
</style>
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
	<div class="corner whitebg" style="width:710px;height:750px" data-corner="40px">
	<img style="margin-top:20px" src="images/registerhead.png" border="0">
	<p style="margin-bottom:15px"><span style="color:#EA5F20">*</span><small><b>為必填資訊</b></small></p>

	
	<form id="form1" name="form1" method="POST" action="/userfullS2.php">
	<b>
	<div class="left" style="padding-left:170px">

	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>真&nbsp實&nbsp姓&nbsp名</label>
		<input type="text" class="message" title="中文字，2~6個字，建立後不可線上修改" id="name" name="name" maxlength="12" onblur="checkname();" size="30"/>
		<span id="chkname"></span> 
	</div>
	
	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>身分證字號</label>
		<input id="sid" class="message" title="中華民國身分證字號，建立後不可線上修改" type="text" name="sid" maxlength="10" onblur="checksid();" size="30"/>
		<span id="chksid"></span> 
	</div>

	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>出&nbsp生&nbsp日&nbsp期</label>
		西元<input type="text"  id="year" class="message" title="西元年，民國年+1911" name="year" size="4" maxlength="4" onblur="checkdate();"/>年
		<select id="month" name="month" ><option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select>月
		<input id="day" class="message" title="出生日期，建立後不可線上修改" type="text" name="day" onblur="checkdate();" size="1" maxlength="2"/>日
    <span id="chkdate"></span> 
	</div>
	
	  <div class="row">
          <label class="label">&nbsp匯&nbsp款&nbsp帳&nbsp戶</label>
		  <?php include('include/bank.php') ?><br>
          <input id="account" class="message" title="銀行帳戶" type="text" name="account" onBlur="checkaccount();" size="15"/>
          <input id="Faccount" name="Faccount" type="file" accept="image/*" value="上傳"/>
          <span id="chkfixphone"></span> </div>
        <div class="row">
          <label class="label">&nbsp信&nbsp用&nbsp卡&nbsp號</label>
          <input id="credit" class="message" title="信用卡卡號" type="text" name="credit"  size="25"/>
          <input id="Fcredit" name="Fcredit" type="file" accept="image/*" value="上傳"/>
          <span id="chkfixphone"></span> </div>
		  
	<div class="row">
	<p style="padding-left:20px">註：為了您日後可以順利轉換給利金。<br><span style="color:#EA5F20">匯款帳戶與信用卡號可填寫並附妥證明。</span><br>待認證成功後，即可使用。
	</div>
	
	<div style="padding-left:25px;margin-bottom:15px"><a href="#" onclick="document.getElementById('captcha').src =document.getElementById('captcha').src + '?' + (new Date ()).getMilliseconds();document.form1.word.value = '';checkcaptcha();"><img src="/captcha/code.php" id="captcha"></a></div>
	
	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>輸入驗證碼</label>
		<input id="word" class="message" title="輸入上方圖案內的數字" type="text" name="captcha" size="30"   onblur="checkcaptcha();" />
		<span id="chkcaptcha"></span>
	</div>
	
	
	<div style="padding-left:20px;margin-bottom:30px">
	<input name="agree" id="agree" value="1" type="checkbox" onclick="checkagree();"/><label style="font-size:13px">我已仔細閱讀並同意服務條款及隱私權聲明</label><span id="chkagree"></span>
	</div>
	
	</b>
	
	<div style="padding-left:75px">
	<input style="height:38px;width:210px;background: url(images/registbuttom.png) no-repeat;border:0 none;" type="submit" name="Submit" value="" /><span id="chkr6"></span> 
	</div>
	
	</div>
	
	</form>
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

</body>
</html>