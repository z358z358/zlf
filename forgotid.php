<?php
include('include/w3.html');
$title='查詢帳號';
include('include/header.php');
?>
<script>
$(document).ready(function() {

	$("#form1").submit(function() {
      
        //$("span").text("Validated...").show();
		//$("#chkr6").html('<img src="images/ok.png">');
		$("input#submit").before('<p style="font-size: 150%">請稍候</p>');
		$("input#submit").remove();
        return true;
      
    });

});
</script>
</header>
<body>
<div class="body center">
	<div class="logo floatL">
		<a href="http://www.zlf168.com/"><img src="images/logo.png" border="0" alt="首頁"></a>
	</div>
	<div class="clearboth" style="height:240px;width:1000px;background-color:#CDEAF7;background-image:url('images/certifybg.png');background-position:50% 50%;background-repeat:no-repeat;padding-top:50px">

	<b>

<form id="form1" name="form1" method="POST" action="/forgotidcheck.php">
	<p style="font-size: 150%;margin-bottom:30px;margin-right:100px">查詢帳號，請輸入以下資訊：</p>
	
	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>身分證字號</label>
		<input id="sid"  type="text" name="sid" maxlength="10"  size="30"/>
	</div>
	
	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>電&nbsp子&nbsp信&nbsp箱</label>
		<input id="email" type="text" name="mail" size="30"  />
		<span id="chkmail"></span> 
	</div>
	</b>
	
	<input id="submit" style="margin-top:30px;" type="image" src="images/ect/submit.png" ALT="Submit Form">
<?php
if (isset($_GET['error']))
{
if($_GET['error']==1)
echo "身分證字號或E-mail錯誤";
else if($_GET['error']==2)
echo "E-mail尚未認證 無法申請";
}
?>
	
</form>
	</div>
	<div class="clearboth">
	<?php 
	include('include/foot.html');
	?>
	</div>
</div>
</body>
</html>