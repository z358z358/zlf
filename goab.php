<?php
session_start();
include('include/w3.html');
$title='給利廣告';
include('include/header.php');
include('include/config.php');
?>
<script type="text/javascript" src="javascripts/jquery.tools.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		 
		 
	/*	$(".opacity").css("opacity","0.5");
		
		 $(".opacity").hover(
			function() {
                $(this).stop().animate({ opacity:1.0 }, 500);
            },
			function() {
               $(this).stop().animate({ opacity: 0.5 }, 500);
           });*/
	});
</script>
</header>
<body class="goab">
<div class="body center"> 
  
  <!--logo + menu-->
  <?php
include('include/logomenu.php');
?>
  <!--logo + menu end--> 
  
  <!--login + bigad-->
  <div>
    <div class="floatL login whitebg left" style="background-image:url('images/goab/loginbg.png')">
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
    <!--step -->
    <div class="news" style="background-image:url('images/goab/mainhead.png')"> </div>
    <!--step end-->
    
    <?php 
   //       goab的首頁
if(empty($_GET['step'])&&empty($_GET['abid']))
{
?>
    <!--text-->
    <div class="text whitebg corner goab_textbg" style="padding:10px"> 
      
      <!--menu -->
      <div class="goab_menu center" style=""> <a href="goab.php?step=1&menu=1"><img src="images/goab/menu1.png"/></a> <a href="goab.php?step=1&menu=2"><img src="images/goab/menu2.png"/></a> <a href="goab.php?step=1&menu=3"><img src="images/goab/menu3.png"/></a> <a href="goab.php?step=1&menu=4"><img src="images/goab/menu4.png"/></a> </div>
      <!--menu end --> 
      
      <!--menu1-->
      <div class="goab_menublock1 goab_menublock"> <a href="goab.php?step=1&menu=1"><img src="images/goab/block1.png"/></a> </div>
      <!--menu1 end--> 
      
      <!--menu2-->
      <div class="goab_menublock2 goab_menublock"> <a href="goab.php?step=1&menu=2"><img src="images/goab/block2.png"/></a> </div>
      <!--menu2 end--> 
      
      <!--menu3-->
      <div class="goab_menublock3 goab_menublock"> <a href="goab.php?step=1&menu=3"><img src="images/goab/block3.png"/></a> </div>
      <!--menu3 end--> 
      
      <!--menu4-->
      <div class="goab_menublock4 goab_menublock"> <a href="goab.php?step=1&menu=4"><img src="images/goab/block4.png"/></a> </div>
      <!--menu4 end--> 
      
    </div>
    <!--text end-->
    
    <?php
} // step1 選廣告or價錢
else if(empty($_GET['abid'])&&$_GET['step']==1)
{
?>
    
    <!--text-->
    <div class="text whitebg corner goab_textbg" style="padding:10px">
      <div class="left corner goab_step1bg" style="">
        <p class="imgmiddle"><b>您現在正在： <img src="images/goab/menu<?php echo $_GET['menu']; ?>on.png" style=""/> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp前往：
          <?php
for($i=1;$i<5;$i++)
{
if($i==$_GET['menu'])
continue;
?>
          <a href="goab.php?step=1&menu=<?php echo $i;?>"><img src="images/goab/menu<?php echo $i;?>off.png"/></a>
          <?php
}
?>
          </b></p>
        <div class="whitebg corner center" style="padding:5px;margin-top:10px"> <a href="goab.php?step=2&menu=<?php echo $_GET['menu'];?>&number=1">
		<a>
					<?php 
					$m_id =  $_GET['menu'];
					//大型廣告
					$search = "SELECT * FROM `go_ad` WHERE `SIZE` = 'L' AND `MENU_ID` = '$m_id'";
					$s_result=mysql_query($search,$link);
					while($s = mysql_fetch_assoc($s_result))
					{
						//$images = glob("images/goab/images/".$s['THUMB']."{*.gif,*.jpg,*.png}", GLOB_BRACE);
						echo '<p style="margin-bottom:10px"> <a href="goab.php?abid='.$s['SEQ'].'"> <img src="images/goab/images/'.$s['THUMB'].'" /> </a></p>';
					}	

					//中型廣告
					$search = "SELECT * FROM `go_ad` WHERE `SIZE` = 'M' AND `MENU_ID` = '$m_id'";
					$s_result=mysql_query($search,$link);
					while($s = mysql_fetch_assoc($s_result))
					{
						 //$images = glob("images/goab/images/".$s['THUMB']."{*.gif,*.jpg,*.png}", GLOB_BRACE);
						 echo '<p style="margin-bottom:10px"><a href="goab.php?abid='.$s['SEQ'].'"><img src="images/goab/images/'.$s['THUMB'].'" /> </a></p>';
					}
					
					//小型廣告
					$search = "SELECT * FROM `go_ad` WHERE `SIZE` = 'S' AND `MENU_ID` = '$m_id'";
					$s_result=mysql_query($search,$link);
					while($s = mysql_fetch_assoc($s_result))
					{
						// $images = glob("images/goab/images/".$s['THUMB']."{*.gif,*.jpg,*.png}", GLOB_BRACE);
						 echo '<p style="margin-bottom:10px"><a href="goab.php?abid='.$s['SEQ'].'"><img src="images/goab/images/'.$s['THUMB'].'" /> </a></p>';
						 
					}
					?>		
		</a> </div>
      </div>
    </div>
    <!--text end-->
    
    <?php
}
// step2 點廣告&等時間
else if(!empty($_GET['abid']))
{

if(isset($_SESSION['id']))
{
$temp=$_GET['abid'];
$_SESSION['ad'][$temp]=time();
//var_dump($_SESSION);
?>
    <script type="text/javascript">
$(document).ready(function() {

 setTimeout(function(){
        $('span#light').html('<img  src="images/goab/light2.png" style="margin-left:10px"/>');
    }, 1000);
	
 setTimeout(function(){
        $('span#light').html('<img  src="images/goab/light3.png" style="margin-left:10px"/>');
		<?php if(isset($_SESSION['id'])) echo 'transform();';?>
    }, 3000);	


function transform()
{
	$.ajax
	({
    url: 'include/getco.php',
    data: {number: <?php echo $temp; ?>},
    error: function(xhr) {},
	async:true,
    success: function(response) 
		{
		if(response==0)
		{
		//result=true;
		//alert(result);
		$('span#transform').html('<img src="images/goab/transformok.png" style="margin-left:20px"/>');
		}
		//else if(response==1)
		//{
		//$('#chkid').html('<img src="images/no.png">已被註冊');
		//}
		else if(response==1)
		{
		$('span#transform').html('<span style="margin-left:20px">已有轉利紀錄</span>');
		}
		else
		{
		alert("轉利失敗");
		}
		//alert(r);
		//alert(e);
		

		//$('#chkr').text(response);
		//alert($('#chkr').text());
		//alert(response.toSource());
		}
	})
}
	

});
</script>
    <?php
}
?>
    <!--text-->
    <div class="text whitebg corner goab_textbg" style="padding:30px;padding-bottom:10px">
      <div style="padding:15px;">
        <div style="min-height:30px">
		<div class="imgmiddle" style="width:633px;background-image:url('images/goab/step2blockbg.png');min-height:36px">
<?php
include('include/config.php');
$sql2="SELECT * FROM `go_ad` WHERE `SEQ`='$_GET[abid]'";
$rows2=mysql_query($sql2,$link);
if(!mysql_num_rows($rows2))
{
	die("找不到網頁");
	//header("Location:goab.php");
}
$row2 = mysql_fetch_assoc($rows2);
$sql="SELECT * FROM `gzinfo` WHERE `MENU`='".$row2['MENU_ID']."'";
$rows=mysql_query($sql,$link);
$row = mysql_fetch_assoc($rows);
$value=$row['VALUE'];
if(isset($_SESSION['id']))
{

?>
          <span id="light"><img  src="images/goab/light1.png" style="margin-left:10px"/></span> <span style="color:#E4CEBE;margin-left:280px;font-size:20px"><?php echo $value?>轉</span> <span id="transform"><img src="images/goab/transform.png" style="margin-left:20px"/></span>
    <?php
}
?>
		</div>
        </div>
        <div class="center goab_goods_background corner" data-corner="BOTTOM" > <img src="images/goab/images/<?php echo $row2['IMG_NAME'];?>" style=""/> </div>
      </div>
      <div class="center" style="letter-spacing:20px;"> <a href="javascript:history.back(-1);"><img src="images/goab/button_back.png"/></a> <a href="goab.php?step=1&menu=1"><img src="images/goab/button_print.png"/></a> <a href="goab.php?step=1&menu=1"><img src="images/goab/button_buy.png"/></a> </div>
    </div>
    <!--text end-->
    
    <?php
}
?>
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
<?php
//$path="C:\wamp\www\CutyCapt";
//chdir($path); 
//$args="--url=http://www.yahoo.co.jp --out=156.jpg";
//$exe="CutyCapt.exe";
//pclose(popen("start \"bla\" \"" . $exe . "\" " . escapeshellarg($args), "r"));
//exec($cmd);

/*
$cmd="cmd /C C:\\wamp\\www\\CutyCapt\\CutyCapt.exe --url=http://www.yahoo.co.jp --out=D:\\123456.jpg";
$WshShell = new COM("WScript.Shell"); 
$oExec = $WshShell->Run($cmd, 0, false); */
?>
</body>
</html>