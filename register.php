<?php
include('include/sessionno.php');
include('include/w3.html');
$title='註冊';
include('include/header.php');
?>
<script src="javascripts/twzipcode-1.4.js" type="text/javascript"></script>
<script src="javascripts/jquery.tipTip.minified.js" type="text/javascript"></script>
<script src="javascripts/checkid.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/tipTip.css" />
<!--[if IE 6]>
     <link href="css/tipTip.ie6.css" media="screen" rel="stylesheet" type="text/css" />
 <![endif]-->
<script type="text/javascript">
	$(document).ready(function() {
		 
		 
		$('#container').twzipcode({
		css: ['addr3-county', 'addr3-area', 'addr3-zip']
		});
		$('.message').tipTip({activation:"focus",maxWidth: "auto",defaultPosition:"top"});
		
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
	<div class="corner whitebg" style="width:710px;min-height:750px;padding-bottom:20px;" data-corner="40px">
	<img style="margin-top:20px" src="images/registerhead.png" border="0">
	<p style="margin-bottom:15px"><span style="color:#EA5F20">*</span><small><b>為必填資訊</b></small></p>

	
	<form id="form1" name="form1" method="POST" action="/new.php">
	<b>
	<div class="left" style="padding-left:170px">
	
	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>帳&nbsp號&nbsp名&nbsp稱</label>
		<input id="id" class="message" title="數字或英文，6~12個字，其中要包含一個英文字，建立後不可修改" type="text" name="id" maxlength="10" onblur="checkid();" size="30"/>
		<span id="chkid"></span> 
	</div>

	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>密&nbsp碼&nbsp設&nbsp定</label>
		<input id="password" class="message" title="數字或英文，6~12個字" type="password" name="password" onblur="checkpassword();" maxlength="12" size="30"/>
		<span id="chkpw"></span>
	</div>

	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>確&nbsp認&nbsp密&nbsp碼</label>
		<input id="rpassword" class="message" title="請輸入與密碼攔相同值，確定密碼無誤" type="password" name="repassword" maxlength="12" onblur="checkrpassword();" size="30"/>
		<span id="chkrpw"></span>
	</div>


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
		<label class="label"><span style="color:#EA5F20">*</span>詳&nbsp細&nbsp地&nbsp址</label>
		<span id="container"></span>
		<br/><input style="margin-left:110px" class="message" title="選擇完縣市鄉鎮後，填入後續地址" id="address" type="text" name="address" size="30" onblur="checkaddress();" />
		<span id="chkaddress"></span> 
	</div>
	
	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>電&nbsp子&nbsp信&nbsp箱</label>
		<input id="email" class="message" title="請確定信箱地址，可接收到認證信" type="text" name="mail" size="30" onblur="checkemail();" />
		<span id="chkmail"></span> 
	</div>
	
	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>手&nbsp機&nbsp號&nbsp碼</label>
		<input id="phone" class="message" title="手機號碼" type="text" name="phone" size="30"   onblur="checkphone();" />
		<span id="chkphone"></span>
	</div>
	
	<div class="row">
		<label class="label">&nbsp固&nbsp定&nbsp電&nbsp話</label>
		<input id="fixphone" class="message" title="市話8~10碼，選填欄位" type="text" name="fixphone" onblur="checkfixphone();" size="30"/>
		<span id="chkfixphone"></span>
	</div>
	
	<div class="row">
          <label class="label">&nbsp匯&nbsp款&nbsp帳&nbsp戶</label>
		  <?php include('include/bank.php') ?><br>
          <input id="account" class="message" style="margin-left:110px" title="銀行帳戶" type="text" name="account" onBlur="checkaccount();" size="25"/>
          <input id="Faccount" name="Faccount" type="file" accept="image/*" value="上傳"/>
          <span id="chkfixphone"></span> </div>
        <div class="row">
          <label class="label">&nbsp信&nbsp用&nbsp卡&nbsp號</label>
          <input id="credit" class="message" title="信用卡卡號" type="text" name="credit"  size="25"/>
          <input id="Fcredit" name="Fcredit" type="file" accept="image/*" value="上傳"/>
          <span id="chkfixphone"></span> </div>
		  
	<div class="row">
	<p style="padding-left:20px">註：為了您日後可以順利轉換給利金。<br><span style="color:#EA5F20">匯款帳戶與信用卡號可擇一填寫並附妥證明</span>，亦可兩者皆填寫。<br>待認證成功後，即可使用。
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
	<input style="height:38px;width:210px;background: url(images/registbuttom.png) no-repeat;border:0 none;" id="formsubmit" type="submit" name="Submit" value="" /><span id="chkr6"></span> 
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