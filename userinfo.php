<?php
include('include/session.php');
include('include/w3.html');
$title='會員中心';
include('include/header.php');
include('include/config.php');
$id=$_SESSION['id'];
?>
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="javascripts/twzipcode-1.4.js" type="text/javascript"></script>
<script src="javascripts/checkid.js" type="text/javascript"></script>
<script src="javascripts/jquery.tipTip.minified.js" type="text/javascript"></script>
<script src="javascripts/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="javascripts/jquery.tablesorter.pager.js"></script>
<link rel="stylesheet" type="text/css" href="css/tipTip.css" />
<script type="text/javascript" src="javascripts/jquery.prettyPhoto.js"></script>
<script type="text/javascript">
      $.extend({
        getUrlVars: function(){
          var vars = [], hash;
          var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
          for(var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
          }
          return vars;
        },
        getUrlVar: function(name){
          return $.getUrlVars()[name];
        }
      });
</script>
<script type="text/javascript">
$(document).ready(function() {
var target11='#chose1';
var act2=$.getUrlVar("act2");

if(act2=='shopping')
target11='#chose2';
else if(act2=='rank')
target11='#chose3';

$(target11).removeClass('opacity');
//alert(act2);
	});
</script>
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
}
else 
{
	include('include/out.php');
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
	
	<?php //首頁 會員資料
	include('include/leftmenu.php');
	?>
	<!--left menu end-->

	
	<!--right main-->
	<?php	
if(empty($_GET['act']))
{
?>
<div class="rightmain floatR corner" data-corner="TL 60px cc:#FFFFFF">
		

	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:0px"><a href="userinfo.php"><img src="images/userinfo/userinfo.on.png" border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:177.5px"><a href="userinfo.php?act=account"><img src="images/userinfo/rg.png." border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:355px"><a href="userinfo.php?act=transaction"><img src="images/userinfo/thin.png" border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:532.5px"><a href="userinfo.php?act=rank"><img src="images/userinfo/thout.png" border="0"/></a></div>


	<div class="corner info whitebg left" data-corner="bottom 20px">
			

<?php
	if(empty($_GET['act2']))
	{
		$sql=	"SELECT * 
				FROM  `data`
				WHERE  `ID` =  '".$id."'";
		$rows=mysql_query($sql,$link);
		$row = mysql_fetch_assoc($rows);
		$sql2=	"SELECT * 
				FROM  `realaccount`
				WHERE  `ID` =  '".$id."'";
		$rows2=mysql_query($sql2,$link);
		$row2 = mysql_fetch_assoc($rows2);
		?>
		<script type="text/javascript">
		$(document).ready(function() {
			 
			 
	$(".row:odd").css("background-color", "#F7F7F7");
	$(".row:even").css("background-color", "#D8EAEF");
	$("label").css("color","#888888");
	$(".label").css("font-weight","bold");
	$(".label").css("color","#000000");
	$("span").css("display","none");
	var target11='#chose1';
	if($.getUrlVar('act2')=='shopping')
	target11='#chose2';
	else if($.getUrlVar('act2')=='rank')
	target11='#chose3';

	$(target11).removeClass('opacity');
		});
	</script>
		<div style="padding:40px;padding-bottom:20px">
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
			<label><?php if($row["FULL"]&&$row["PHONE"]!=""){ for($j=0;$j<4;$j++)echo $row["PHONE"][$j];echo "-***-*".$row["PHONE"][8].$row["PHONE"][9];} ?></label>
			</div>
		
			<div class="row">
			<label class="label">&nbsp固&nbsp定&nbsp電&nbsp話</label>
			<label>
		<?php
		if($row["FULL"]&&$row["FIXPHONE"]!="")
		{
			echo $row["FIXPHONE"][0].$row["FIXPHONE"][1].$row["FIXPHONE"][2]."****";
			for($i=7;$i<strlen($row["FIXPHONE"]);$i++)
			echo $row["FIXPHONE"][$i];
		}
		?>
			</label>
			</div>
			
			<div class="row">
			<label class="label">&nbsp匯&nbsp款&nbsp帳&nbsp戶</label>
			<label>
		<?php
		if($row2["NUMBER"]!="")
		{
			echo $row2["BANK"]."-".$row2["NUMBER"];
			if($row2["ACT"]==0)
			echo "(未認證)";
		}
		?>
			</label>
			</div>
			
			<div class="row">
			<label class="label">&nbsp信&nbsp用&nbsp卡&nbsp號</label>
			<label>
		<?php
		if($row2["CREDIT"]!="")
		{
			echo $row2["CREDIT"];
			if($row2["ACT2"]==0)
			echo "(未認證)";
		}
		?>
			</label>
			</div>
			
			</div>
		<div class="center">
		<?php
		if($row["FULL"])
		{
		?>
		<a href="userinfo.php?act2=edit"><img src="images/eddit.png" border="0"/></a>
		<?php
		}
		else
		{
			if(isset($_GET['error']))
				echo '<script type="text/javascript">$(document).ready(function() {alert("此項動作需成為正式會員！");});</script >';
		echo '<a href="userfullS1.php"><img src="images/userinfo/full.png" border="0"/></a>';
		}
		?>
		</div>
		
	<?php
	}
	else if($_GET['act2']=='edit')
	{
	
		$id=$_SESSION['id'];
		$sql=	"SELECT * 
		FROM  `data`
		WHERE  `ID` =  '".$id."'";
		$rows=mysql_query($sql,$link);
		$row = mysql_fetch_assoc($rows);
	?>
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
<style type="text/css">
div.row span img {
	vertical-align:middle;
}
</style>
	<div style="padding:40px;padding-bottom:20px">
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
      <form id="form1" name="form1" method="POST" enctype="multipart/form-data" action="/userinfo.php?act2=editconfirm">
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
          <input id="account" style="margin-left:108px" class="message" title="銀行帳戶" type="text" name="account" onBlur="checkaccount();" size="30"/>
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
		  
	</div>
	
	<?php
	}
	else if($_GET['act2']=='editconfirm')
	{
		include('include/userinfoS2.php');
	}
	?>
	</div>
		
		
</div>	
	
<?php	
}
else if($_GET['act']=='transaction')
{
?>
<div class="rightmain floatR corner" data-corner="TL 60px cc:#FFFFFF">
	<div class="fullimg absolute" style="z-index:9;height:40px;width:177.5px;margin-left:0px"><a href="userinfo.php"><img src="images/userinfo/userinfo.png" border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:9;height:40px;width:177.5px;margin-left:177.5px"><a href="userinfo.php?act=account"><img src="images/userinfo/rg.png." border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:9;height:40px;width:177.5px;margin-left:355px"><a href="userinfo.php?act=transaction"><img src="images/userinfo/thin.on.png" border="0"/></a></div>
	<div class="fullimg absolute" style="z-index:9;height:40px;width:177.5px;margin-left:532.5px"><a href="userinfo.php?act=rank"><img src="images/userinfo/thout.png" border="0"/></a></div>
	
	<div class="corner info whitebg left"  data-corner="bottom 20px">
		<div style="padding:20px">
		<div id="chose1" class="fullimg absolute opacity" style="z-index:9;margin-left:0px"><a href="userinfo.php?act=transaction"><img src="images/userinfo/chose1.png" border="0"/></a></div>
		<div id="chose2" class="fullimg absolute opacity" style="z-index:9;margin-left:223px"><a href="userinfo.php?act=transaction&act2=shopping"><img src="images/userinfo/chose2.png." border="0"/></a></div>
		<div id="chose3" class="fullimg absolute opacity" style="z-index:9;margin-left:446px"><a href="userinfo.php?act=transaction&act2=rank"><img src="images/userinfo/chose3.png" border="0"/></a></div>
		<div style="height:29px"></div>


<?php
	if(empty($_GET['act2']))
	{
		$sql = "SELECT `TIME` AS '日期  |  時間',  `CO_SPENT` AS '數  量' , `ENCRYPTED_ID` AS '項  目' , `REMAINING_CO` AS '餘額小計'"
		." FROM `order_log`"
		." WHERE `USER_ID`='".$id."'"
		." ORDER BY `TIME` DESC";
		/*$sql = "SELECT `bonuslog`.`DATE` AS '日  期',`bonuslog`.`TIME` AS '時間',`bonus`.`GAME` AS '遊戲名稱',`gamex`.`ACTIVITY` AS '活動項目',CONCAT(`gamex`.`TYPE`,`gamex`.`RATIO`) AS '兌換種類',`bonus`.`VALUE` AS '存入金幣'"
		. "	FROM `bonus` LEFT JOIN `gameinfo` ON(`bonus`.`GAME`=`gameinfo`.`GAME`) "
		. "              LEFT JOIN `gamex` ON(`bonus`.`GAME`=`gamex`.`GAME` AND `bonus`.`FROM`=`gamex`.`TYPE`)"
		. "              LEFT JOIN `bonuslog` ON(`bonus`.`NUMBER`=`bonuslog`.`NUMBER`)"
		. "	WHERE `bonus`.`ID`='".$id."' AND `bonus`.`USED`=1"
		. " ORDER BY  `bonuslog`.`DATE` DESC ,`bonuslog`.`TIME` DESC ";*/
		//	. " GROUP BY `bonus`.`GAME`";
		$rows=mysql_query($sql,$link);
?>
<style type="text/css">
table.tablesorter thead tr .headerSortUp {
	background-image:none;
}
table.tablesorter thead tr .headerSortDown {
	background-image:none;
}
table.tablesorter thead tr .header {
	background-image:none;
}
</style>
<script  type="text/javascript">
$(function(){
//$('.lightbox').lightBox();
$("a[rel^='prettyPhoto']").prettyPhoto();
$('td').each(function()
{
	if($(this).html()<0)
	$(this).attr('style','color:red');
});

$(".tablesorter th").css("background-color","#996600");
$(".tablesorter th").css("border","0.1em solid #996600");
$(".tablesorter td").css("border","0.1em solid #996600");
$(".tablesorter td").css("font-weight","bold");
$(".tablesorter td").addClass("center");
$(".tablesorter td:nth-child(2)").addClass("right");
$(".tablesorter td:nth-child(4)").addClass("right");
$(".tablesorter").css("margin","0");
$("table.tablesorter thead tr th, table.tablesorter tfoot tr th").css("padding","5px 0 5px 0");
$("table.tablesorter tbody td").css("padding","5px 0 5px 0");
$(".tablesorter td:nth-child(2)").css({"padding-right" : "5px" , "letter-spacing" : "3px"});
$(".tablesorter td:nth-child(4)").css({"padding-right" : "5px" , "letter-spacing" : "3px"});
//$(".tablesorter td:nth-child(4) a").css({"color" : "black"});
$(".tablesorter td").hover(
		function() 
		{  
		$(this).parent().children().css("background-color", "#FFFFCC");
		//$("input:checked").parent().parent().css("background-color", "#000000");
		},
		function() 
		{  
		$(this).parent().children().css("background-color", "");	
		//$("input:checked").parent().parent().css("background-color", "#000000");		
		});
$("#bonus").tablesorter().tablesorterPager({container: $("#pager")}); 
});
</script>
		<?php
		if(!mysql_num_rows($rows))
		{
			echo '<div class="center b" style="font-size:30px">您尚無購物紀錄</div>';
		}
		else
		{
			echo '<table id="bonus" class="tablesorter">';
			echo "<thead>";
			echo "<tr>";
			//$field=mysql_fetch_field($rows);
			
			$width=array(70,60,110,50,40);
			
			$j=0;
			while($field=mysql_fetch_field($rows))
			{
				echo '<th class="center" width="'.$width[$j].'"><b>'.$field->name."</b></th>";
				$j++;
			}
			
			//echo "<th><input type=checkbox /></th>";
			
			//echo "<td><a href=bonusinfo.php?sortby=".$field->name.">".$field->name."</a></td>";
			echo "</tr></thead><tbody>";

			while($row = mysql_fetch_row($rows))
			{ 

			
				for($i=0;$i<count($row);$i++)
				{
					if($i==2)
						echo '<td>兌換商品(訂單編號:<a href="onclick.php?id='.$row[$i].'&iframe=true&width=80%" rel="prettyPhoto[iframes]" title="訂單編號為:'.$row[$i].'">'.$row[$i].'</a>)</td>'; 
					else if($i==1&&$row[$i]>=0)
						echo "<td>+".$row[$i]."</td>";	
					else
						echo "<td>".$row[$i]."</td>";	
				}
				//echo '<td style="vertical-align: text-bottom;"><span class="" style="hight:20px;width:20px"><img src="images/smallco.png"></span>幣兌換</td>';	
				// echo '<td><input type=checkbox class=checkbox name=chkbox[] onclick="hightlightTr(this);sum();" value='.$row[$i]."></td>";
				echo "</tr>";
			}
			echo "</tbody></table>";
		?>
<div id="pager" class="center" style="margin-top:20px">
		        <label class="first">最前頁</label>
		        <label class="prev">前一頁</label>
		        <input type="text" size="1" readonly="readonly" class="pagedisplay"/>
		        <label class="next">下一頁</label>
		        <label class="last">最末頁</label>
		        <select style="display:none" class="pagesize">
			        <option selected="selected" value="10">10</option>
		        </select>
		    </div>		
		<?php
		}	
	}
	else if($_GET['act2']=='shopping')
	{
		$sql = "SELECT `DATE` AS '日期  |  時間',  `ENCRYPTED_ID` AS '項  目(訂單編號)' , `CO_TOTAL` AS '售價' , `SEQ` AS '付費方式'"
		." FROM `order`"
		." WHERE `USER_ID`='".$id."'"
		." ORDER BY `DATE` DESC";
		/*$sql = "SELECT `bonuslog`.`DATE` AS '日  期',`bonuslog`.`TIME` AS '時間',`bonus`.`GAME` AS '遊戲名稱',`gamex`.`ACTIVITY` AS '活動項目',CONCAT(`gamex`.`TYPE`,`gamex`.`RATIO`) AS '兌換種類',`bonus`.`VALUE` AS '存入金幣'"
		. "	FROM `bonus` LEFT JOIN `gameinfo` ON(`bonus`.`GAME`=`gameinfo`.`GAME`) "
		. "              LEFT JOIN `gamex` ON(`bonus`.`GAME`=`gamex`.`GAME` AND `bonus`.`FROM`=`gamex`.`TYPE`)"
		. "              LEFT JOIN `bonuslog` ON(`bonus`.`NUMBER`=`bonuslog`.`NUMBER`)"
		. "	WHERE `bonus`.`ID`='".$id."' AND `bonus`.`USED`=1"
		. " ORDER BY  `bonuslog`.`DATE` DESC ,`bonuslog`.`TIME` DESC ";*/
		//	. " GROUP BY `bonus`.`GAME`";
		$rows=mysql_query($sql,$link);
?>
<style type="text/css">
table.tablesorter thead tr .headerSortUp {
	background-image:none;
}
table.tablesorter thead tr .headerSortDown {
	background-image:none;
}
table.tablesorter thead tr .header {
	background-image:none;
}
</style>

<script  type="text/javascript">
$(function(){
//$('.lightbox').lightBox();
$("a[rel^='prettyPhoto']").prettyPhoto();
/*$('td').each(function()
{
	if($(this).html()<0)
	$(this).attr('style','color:red');
});*/

$(".tablesorter th").css("background-color","#996600");
$(".tablesorter th").css("border","0.1em solid #996600");
$(".tablesorter td").css("border","0.1em solid #996600");
$(".tablesorter td").css("font-weight","bold");
$(".tablesorter td").addClass("center");
$(".tablesorter td:nth-child(3)").addClass("right");
$(".tablesorter").css("margin","0");
$("table.tablesorter thead tr th, table.tablesorter tfoot tr th").css("padding","5px 0 5px 0");
$("table.tablesorter tbody td").css("padding","5px 0 5px 0");
$(".tablesorter td:nth-child(3)").css({"padding-right" : "5px" , "letter-spacing" : "3px"});
$(".tablesorter td:nth-child(4) a").css({"color" : "black"});
$(".tablesorter td").hover(
		function() 
		{  
		$(this).parent().children().css("background-color", "#FFFFCC");
		//$("input:checked").parent().parent().css("background-color", "#000000");
		},
		function() 
		{  
		$(this).parent().children().css("background-color", "");	
		//$("input:checked").parent().parent().css("background-color", "#000000");		
		});
$("#bonus").tablesorter().tablesorterPager({container: $("#pager")}); 
});
</script>
		<?php
		if(!mysql_num_rows($rows))
		{
			echo '<div class="center b" style="font-size:30px">您尚無購物紀錄</div>';
		}
		else
		{
			echo '<table id="bonus" class="tablesorter">';
			echo "<thead>";
			echo "<tr>";
			//$field=mysql_fetch_field($rows);
			
			$width=array(70,70,100,50,40);
			
			$j=0;
			while($field=mysql_fetch_field($rows))
			{
				echo '<th class="center" width="'.$width[$j].'"><b>'.$field->name."</b></th>";
				$j++;
			}
			
			//echo "<th><input type=checkbox /></th>";
			
			//echo "<td><a href=bonusinfo.php?sortby=".$field->name.">".$field->name."</a></td>";
			echo "</tr></thead><tbody>";

			while($row = mysql_fetch_row($rows))
			{ 

			
				for($i=0;$i<count($row)-1;$i++)
				{
					if($i==1)
						echo '<td><a href="onclick.php?id='.$row[$i].'&iframe=true&width=80%" rel="prettyPhoto[iframes]" title="訂單編號為:'.$row[$i].'">'.$row[$i].'</a></td>'; 
					/*else if($i==2&&$row[$i]>=0)
						echo "<td>+".$row[$i]."</td>";	*/
					else
						echo "<td>".$row[$i]."</td>";	
				}
				echo '<td style="vertical-align: text-bottom;"><span class="" style="hight:20px;width:20px"><img src="images/smallco.png"></span>幣兌換</td>';	
				// echo '<td><input type=checkbox class=checkbox name=chkbox[] onclick="hightlightTr(this);sum();" value='.$row[$i]."></td>";
				echo "</tr>";
			}
			echo "</tbody></table>";
		?>
<div id="pager" class="center" style="margin-top:20px">
		        <label class="first">最前頁</label>
		        <label class="prev">前一頁</label>
		        <input type="text" size="1" readonly="readonly" class="pagedisplay"/>
		        <label class="next">下一頁</label>
		        <label class="last">最末頁</label>
		        <select style="display:none" class="pagesize">
			        <option selected="selected" value="10">10</option>
		        </select>
		    </div>		
		<?php
		}
	}
	else
	{
	
	}
		?>	
		</div>
		</div>
	
	
	</div>
	
<?php
}
else if($_GET['act']=='account')
{
	$id=$_SESSION['id'];
	$sql=	"SELECT * 
			FROM  `account`
			WHERE  `ID` =  '".$id."'";
	$rows=mysql_query($sql,$link);
	$row = mysql_fetch_assoc($rows);
	
	$date=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-7,date("Y")));
		
		//if (empty($_GET['sortby'])) $sort="TIME";
		//else $sort=$_GET['sortby'];
		//"SELECT `gameinfo`.`COMPANY`,`bonus`.`GAME`,SUM(`bonus`.`VALUE`) AS 'VALUE'"
		//"SELECT `gameinfo`.`COMPANY`,`bonus`.`GAME`,`gameinfo`.`GAMETYPE`,`bonus`.`VALUE`"
	$sql2 = "SELECT SUM(`gz`.`VALUE`) AS '轉利基數'"
		 . "FROM `gz` "
		 . "WHERE `gz`.`ID`='".$id."' AND `gz`.`USED`=0 AND `gz`.`TIME`>'$date'";
//	. " GROUP BY `bonus`.`GAME`";
	$rows2=mysql_query($sql2,$link);
	$row2 = mysql_fetch_assoc($rows2);
	
	//$sql2 = "SELECT SUM(`order`.`GZ`) AS '轉利基數'"
	//	 . "FROM `order` "
	//	 . "WHERE `order`.`USER_ID`='".$id."'";
//	. " GROUP BY `bonus`.`GAME`";
	//$rows_order=mysql_query($sql2,$link);
	//$row_order = mysql_fetch_assoc($rows_order);
	?>
	<script type="text/javascript">
	$(document).ready(function() {
	});
</script>
	<div class="rightmain floatR corner" data-corner="TL 60px cc:#FFFFFF">
	

		<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:0px"><a href="userinfo.php"><img src="images/userinfo/userinfo.png" border="0"/></a></div>
		<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:177.5px"><a href="userinfo.php?act=account"><img src="images/userinfo/rg.on.png." border="0"/></a></div>
		<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:355px"><a href="userinfo.php?act=transaction"><img src="images/userinfo/thin.png" border="0"/></a></div>
		<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:532.5px"><a href="userinfo.php?act=rank"><img src="images/userinfo/thout.png" border="0"/></a></div>


		<div class="corner info whitebg left" data-corner="bottom 20px">
			<div style="padding:30px;padding-bottom:20px">
			
				
				<div  style="height:200px;width:610px;margin:auto;margin-bottom:20px;background:url('images/userinfo/head.png') no-repeat;">
				<p class="right" style="padding:68px 280px 0 0;font-size:25px"><?php echo number_format($row["CO"], 0, '.' ,','); ?></p>
				<p class="right" style="padding:26px 280px 0 0;font-size:25px"><?php echo number_format($row2["轉利基數"], 0, '.' ,','); ?></p>
				</b></div>
				<a href="convert.php"><img style="margin-left:0px" src="images/userinfo/convert.png" border="0" /></a>
				<a href="store.php"><img style="margin-left:15px" src="images/userinfo/store.png" border="0"/></a>
				<a href="goab.php"><img style="margin-left:15px" src="images/userinfo/ab.png" border="0" /></a>
		
			</div>
		</div>
	</div>
<?php
}
else if($_GET['act']=='rank')
{
	
	?>
	<script type="text/javascript">
	$(document).ready(function() {
	});
</script>
	<div class="rightmain floatR corner" data-corner="TL 60px cc:#FFFFFF">
	

		<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:0px"><a href="userinfo.php"><img src="images/userinfo/userinfo.png" border="0"/></a></div>
		<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:177.5px"><a href="userinfo.php?act=account"><img src="images/userinfo/rg.png." border="0"/></a></div>
		<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:355px"><a href="userinfo.php?act=transaction"><img src="images/userinfo/thin.png" border="0"/></a></div>
		<div class="fullimg absolute" style="z-index:999;height:40px;width:177.5px;margin-left:532.5px"><a href="userinfo.php?act=rank"><img src="images/userinfo/thout.on.png" border="0"/></a></div>


		<div class="corner info whitebg left" data-corner="bottom 20px">
			<div style="padding:40px;padding-bottom:20px">

			
			</div>
		</div>
	</div>
<?php
}
?>
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