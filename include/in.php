<?php
if(isset($_SESSION['sex'])&&$_SESSION['sex']==1)
{
?>
<div class="floatL center fullimg" style="height:88px;width:88px;padding-right:5px;font-size:13px"><img src="images/photo/b.png" border="0"/>

<?php 
}
else if(isset($_SESSION['sex'])&&$_SESSION['sex']==2)
{
?>
<div class="floatL center fullimg" style="height:88px;width:88px;padding-right:5px;font-size:13px"><img src="images/photo/g.png" border="0"/>
<?php
}
else 
{
?>
<div class="floatL center fullimg" style="height:88px;width:88px;padding-right:5px;font-size:13px"><img src="images/photo/b.png" border="0"/>
<?php
}
?>


</div>
<div style="line-height:15px">
<?php
echo $_SESSION['name']." 　你好！";
?>
<a href=/userinfo.php><img style="margin-top:6.5px" src="images/membercenter.png" border="0"/></a>

<a href=/logout.php><img style="margin-top:6.5px" src="images/memberlogout.png" border="0"/></a>
</div>