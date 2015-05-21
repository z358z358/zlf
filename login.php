<?php
include('include/sessionno.php');
include('include/w3.html');
$title='登入';
include('include/header.php');
?>
<script type="text/javascript">
function ad(str)
{
    document.form1.password2.value = document.form1.password2.value + str;
}
function clean()
{
    document.form1.password2.value = '';
}

</script >
</header>
<body>

<div class="body center">
	<div class="logo floatL">
		<a href="/"><img src="images/logo.png" border="0" alt="首頁"></a>
	</div>
	
	<div class="clearboth" style="height:500px;width:1000px;background-color:#CDEAF7">
		<div class="floatL" style="margin:30px 100px 30px 100px">
			<img src="images/loginpage.png" border="0" alt="首頁"/>
		</div>
	
		<div class="floatR" style="height:450px;width:300px;background-image:url('images/loginblock.png');background-repeat: no-repeat;margin:20px 100px 20px 0;padding:90px 0 0 0">
			<form id="form1" name="form1" method="POST" action="/logincheck.php">
<?php 
if(isset($_GET['next']))
{

echo '<input type="hidden" name="next" value='.urlencode($_GET['next']).' />';
}
			
?>
			<div style="line-height:30px">
				<p><b>帳號&nbsp</b>
				<input type='text' name='id' 
<?php
if(isset($_COOKIE['cookieid'])&&$_COOKIE['cookieid']!='')
echo "value=$_COOKIE[cookieid]";
?>
				/></p>
				<p><b>密碼&nbsp</b>
				<input type="password" name="password"  />
				</p>
				<input name="saveAccounts" id="saveAccounts" value="1" type="checkbox"
<?php
if(isset($_COOKIE['cookieid'])&&$_COOKIE['cookieid']!='')
echo "checked=checked";
?>
				/><small>記住帳號</small>
			</div>
			<input style="height:42px;width:110px;background: url(images/loginbutton.png) no-repeat;border:0 none;" type="submit" name="Submit" value="" />
			</form>
			<p style="color:#3300FF; margin:5px 0 20px 0"><small><a href="forgotid.php" style="text-decoration: none">忘記帳號</a> <a href="forgot.php" style="text-decoration: none">忘記密碼</a></small><p>
			<b>或是使用下列帳號登入：</b>
			<div style="line-height:30px;letter-spacing:50px;padding-top:10px">
			<a href="openid/facebook.php" target="_top"><img src="images/linkfacebook.png" border="0"/></a>
			<a href="https://www.google.com/accounts/o8/ud?
openid.ns=http://specs.openid.net/auth/2.0
&openid.claimed_id=http://specs.openid.net/auth/2.0/identifier_select
&openid.identity=http://specs.openid.net/auth/2.0/identifier_select
&openid.return_to=http://www.zlf168.com/openid/google.php
&openid.realm=http://www.zlf168.com/
&openid.assoc_handle=ABSmpf6DNMw
&openid.mode=checkid_setup
&openid.ui.ns=http://specs.openid.net/extensions/ui/1.0
&openid.ui.mode=popup
&openid.ui.icon=true
&openid.ns.ax=http://openid.net/srv/ax/1.0
&openid.ax.mode=fetch_request
&openid.ax.type.email=http://axschema.org/contact/email
&openid.ax.required=email" target="_top"><img style="margin-top:10px" src="images/linkgoogle.png" border="0"/></a>
			<a href="https://open.login.yahooapis.com/openid/op/auth?
openid.claimed_id=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select
&openid.identity=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select
&openid.mode=checkid_setup
&openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0
&openid.realm=http://www.zlf168.com/
&openid.return_to=http://www.zlf168.com/openid/yahoo.php
&openid.ns.oauth=http%3A%2F%2Fspecs.openid.net%2Fextensions%2Foauth%2F1.0
&openid.oauth.consumer=dj0yJmk9TTVVS1Y1U0ZZdmFBJmQ9WVdrOVQzRm5WVXBzTjJzbWNHbzlNVFV4TURNMk1qSTJNZy0tJnM9Y29uc3VtZXJzZWNyZXQmeD05NA--
&openid.ns.ax=http://openid.net/srv/ax/1.0
&openid.ax.mode=fetch_request
&openid.ax.type.email=http://axschema.org/contact/email
&openid.ax.required=email" target="_top"><img style="margin-top:10px" src="images/linkyahoo.png" border="0"/></a>

			<!--<a href="google/example.google.oauth2.php?signin" target="_blank"></a>-->
			</div>
		</div>
	</div>
	<div class="clearboth">
	<?php 
	include('include/foot.html');
	?>
	</div>
</div>
</body>
</html>