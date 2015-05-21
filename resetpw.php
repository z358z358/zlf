<?php
if (empty($_GET['account'])||empty($_GET['act'])) 
{
header("Location: index.php");
die();
}
else
{
	$id=$_GET['account'];
	
	include('include/w3.html');
	include('include/config.php');
	$title="重設密碼";
	include('include/header.php');
	
	$sql="SELECT * FROM `data` WHERE `ID`='$id'";
	$rows=mysql_query($sql,$link);
	
	if(!mysql_num_rows($rows))
	{	
		echo "</header><body>";
		mysql_close($link); 
		echo "連結有誤";
	}
	else
	{
		$row = mysql_fetch_assoc($rows);
		if(!$row['MAILACT'])
		{
			echo "</header><body>";
			echo "此信箱未認證 無法修改密碼";
		}
		else if($_GET['act']==sha1($row['PASSWORD']))
		{
		?>
		
		<script type="text/javascript">
function checkpassword()
{
if($("#password").val()=='') return false;
if($("#password").val().search(/[^a-z^A-Z^0-9]/)==0)
{
alert("密碼必須為英文或數字");  
return false;
}
else if($("#password").val().length>=6&&$("#password").val().length<=12)
{
return true;
}
else
{
alert("密碼長度6~12字元");
return false;
}
}

function checkemail() {

if($("#email").val()=='') return false;
if($("#email").val().search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)==0)
{
return true;
}
else
{
alert("信箱格式錯誤"); 
return false;
}
}

function checkrpassword()
{

//alert(x.value);
//alert(id);
if($('#rpassword').val()=='')return false;
if($('#password').val()==$('#rpassword').val())
{
return true;
}
else 
{
alert("兩次填寫的密碼不一致"); 
return false;
}
}

$(document).ready(function(){
  $("#form1").submit(function() {
      if (checkrpassword()&&checkpassword()&&checkemail()) {
        //$("span").text("Validated...").show();
        return true;
      }
	  else
	  {
      return false;
	  }
    });
});
</script>

</header>


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

<form id="form1" name="form1" method="POST" action="/resetpw2.php">
	<p style="font-size: 150%;margin-bottom:30px;margin-right:100px">重設密碼，請輸入以下資訊：</p>
		
	<div class="row">
		<label class="label"><span style="color:#EA5F20">*</span>電&nbsp子&nbsp信&nbsp箱</label>
		<input id="email" type="text" name="mail" size="30"  />
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
	
	<input type="hidden" name="account" value="<?php echo $id;?>"/>
	<input type="hidden" name="act" value="<?php echo $_GET['act'];?>"/>
	
	</b>
	
	<input id="submit" style="margin-top:30px;" type="image" src="images/ect/submit.png" ALT="Submit Form">
<?php
if (isset($_GET['error']))
{
if($_GET['error']==1)
echo "E-mail錯誤";
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

<?php
			mysql_close($link);
		}
		else 
		{
			mysql_close($link); 
			echo "連結已失效，請重新申請";
		}
	
	}
}

?>
</body>
</html>