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
<script type="text/javascript">
$(document).ready(function() {
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

var ext = $('#Faccount').val().split('.').pop().toLowerCase();
var ext2 = $('#Fcredit').val().split('.').pop().toLowerCase();
var f=true;


if(($('#Faccount').val()!=''&&$.inArray(ext, ['gif','png','jpg','jpeg']) == -1)||($('#Fcredit').val()!=''&&$.inArray(ext2, ['gif','png','jpg','jpeg']) == -1)) {
    alert('只允許上傳圖片( gif , png , jpg , jpeg )');
	f=false;
}

return flagsize&&f&&r&&((!$("#address").val().length)||checkaddress())&&((!$("#email").val().length)||checkemail())&&((!$("#phone").val().length)||checkphone())&&((!$("#fixphone").val().length)||checkfixphone());

});


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

alert("只需要填入要修改的欄位");



});
</script>
<script src="javascripts/checkid.js" type="text/javascript"></script>
<style type="text/css">
div.row span img {
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
    <div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:0px"><a href="userinfo.php"><img src="images/userinfo/userinfo.on.png" border="0"/></a></div>
    <div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:177.5px"><a href="account.php"><img src="images/userinfo/rg.png." border="0"/></a></div>
    <div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:355px"><a href="historyin.php"><img src="images/userinfo/thin.png" border="0"/></a></div>
    <div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:532.5px"><a href="historyout.php"><img src="images/userinfo/thout.png" border="0"/></a></div>
    <div class="corner info whitebg left" style="padding:40px;padding-bottom:20px" data-corner="bottom 20px">
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
        <label>
          <?php if($row["FULL"]){ echo $row["SID"][0]."********".$row["SID"][9];} ?>
        </label>
      </div>
      <div class="row">
        <label class="label"><span style="color:#EA5F20">*</span>出&nbsp生&nbsp日&nbsp期</label>
        <label><?php echo $row["BIRTHDAY"][0].$row["BIRTHDAY"][1].$row["BIRTHDAY"][2]."*/**/".$row["BIRTHDAY"][8]."*"; ?></label>
      </div>
      <form id="form1" name="form1" method="POST" enctype="multipart/form-data" action="/userinfoS2.php">
        <div class="row">
          <label class="label">詳&nbsp細&nbsp地&nbsp址</label>
          <span id="container"></span> <br/>
          <input style="margin-left:110px" class="message" title="選擇完縣市鄉鎮後，填入後續地址" id="address" type="text" name="address" size="30" onBlur="checkaddress();" />
          <span id="chkaddress"></span> </div>
        <div class="row">
          <label class="label">電&nbsp子&nbsp信&nbsp箱</label>
          <input id="email" class="message" title="若修改信箱，需重新認證，才可以登入。" type="text" name="mail" size="30" onBlur="checkemail();" />
          <span id="chkmail"></span> </div>
        <div class="row">
          <label class="label">手&nbsp機&nbsp號&nbsp碼</label>
          <input id="phone" class="message" title="手機號碼" type="text" name="phone" size="30"   onblur="checkphone();" />
          <span id="chkphone"></span> </div>
        <div class="row">
          <label class="label">&nbsp固&nbsp定&nbsp電&nbsp話</label>
          <input id="fixphone" class="message" title="市話8~10碼，選填欄位" type="text" name="fixphone" onBlur="checkfixphone();" size="30"/>
          <span id="chkfixphone"></span> </div>
        <div class="row">
          <label class="label">&nbsp匯&nbsp款&nbsp帳&nbsp戶</label>
		  <?php include('include/bank.php') ?><br>
          <input id="account" class="message" title="銀行帳戶" type="text" name="account" onBlur="checkaccount();" size="30"/>
          <input id="Faccount" name="Faccount" type="file" accept="image/*" value="上傳"/>
          <span id="chkfixphone"></span> </div>
        <div class="row">
          <label class="label">&nbsp信&nbsp用&nbsp卡&nbsp號</label>
          <input id="credit" class="message" title="信用卡卡號" type="text" name="credit"  size="30"/>
          <input id="Fcredit" name="Fcredit" type="file" accept="image/*" value="上傳"/>
          <span id="chkfixphone"></span> </div>
        <div class="center" style="padding-top:10px">
          <input id="formsubmit" type="image" src="images/userinfo/confirm.png" alt="Submit Form"/>
          <a href="javascript:history.back()"><img style="padding-left:20px" src="images/userinfo/cancel.png" border="0"/></a> </div>
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