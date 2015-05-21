<?php
include('include/session.php');
include('include/w3.html');
$title='紅利兌換';
include('include/header.php');
?>
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
<body class="convert">
<div class="body center">

<!--logo + menu-->
<?php
include('include/logomenu.php');
?>
<!--logo + menu end--> 

<!--login + bigad-->
<div>
  <div class="floatL login whitebg left loginred">
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
  <?php
if(empty($_GET['step']))
{
	if(empty($_SESSION['sid']))
	{
	header("Location:userinfo.php?error=1");
	die();
	}
	else if(!empty($_SESSION['pass'])&&$_SESSION['pass']==true)
	{
	header("Location:convert.php?step=2");
	die();	
	}
?>
  <script type="text/javascript">
function adsid(str)
{
    document.form1.passwordsid.value = document.form1.passwordsid.value + str;
}
function cleansid()
{
    document.form1.passwordsid.value = '';
}
function adbirthday(str)
{
    document.form1.passwordbirthday.value = document.form1.passwordbirthday.value + str;
}
function cleanbirthday()
{
    document.form1.passwordbirthday.value = '';
}
$(function(){{
$("#form1").submit(function() {
var check2=$("#passwordbirthday").val().length;
var check=$("#passwordsid").val().length;
      if (check2==8) {
        //$("span").text("Validated...").show();

       
      }
	  else
	  {
      alert("生日認證碼為8碼！");
      return false;
	  }

      if (check==4) {
        //$("span").text("Validated...").show();

        return true;
      }
	  else
	  {
      alert("身分證認證碼為4碼！");
      return false;
	  }
	  
    });
}});
</script > 
  
  <!--step -->
  <div class="news" style="background-image:url('../images/convert/convertS1.png')"> </div>
  <!--step end--> 
  
  <!--text-->
  <div class="text whitebg corner">
    <div style="margin-top:10px;margin-bottom:10px"> <img src="images/convert/S1.png"/> </div>
    <form id="form1" name="form1" method="POST" action="/convert.php?step=2">
      <div  style="height:393px;width:330px;margin-left:auto;margin-right:auto;background-image:url('images/convert/sidbirthdaybg.png');background-repeat:no-repeat;">
        <div style="height:67px"></div>
        <table  style="position:relative; margin-left:auto; margin-right:auto;">
          <tbody>
            <tr>
              <?php
$numbers=range(0,9);
shuffle($numbers);
	for ($i=0;$i<10;$i++)
	{
	echo "<td class='fontblack whitebg number'><a href=javascript:adsid('$numbers[$i]')>&nbsp$numbers[$i]&nbsp</a></td>";
		if($i==4)
		{
		echo "</tr><tr>";
		}
	}
?>
            </tr>
          </tbody>
        </table>
        <input style="margin-top:20px;" id="passwordsid" type="password" name="passwordsid" maxlength="4" readonly="readonly"/>
        <a href=javascript:cleansid()>清除</a>
        <table  style="position:relative; margin-left:auto; margin-right:auto;margin-top:90px">
          <tbody>
            <tr>
              <?php
$numbers=range(0,9);
shuffle($numbers);
	for ($i=0;$i<10;$i++)
	{
	echo "<td class='fontblack whitebg number'><a href=javascript:adbirthday('$numbers[$i]')>&nbsp$numbers[$i]&nbsp</a></td>";
		if($i==4)
		{
		echo "</tr><tr>";
		}
	}
?>
            </tr>
          </tbody>
        </table>
        <input style="margin-top:20px;" id="passwordbirthday" type="password" name="passwordbirthday" maxlength="8" readonly="readonly"/>
        <a href=javascript:cleanbirthday()>清除</a>
        <div style="margin-top:40px;">
          <input type="image" src="images/convert/agreeS1.png" alt="Submit Form"/>
        </div>
      </div>
    </form>
  </div>
  <!--text end-->
  <?php
}
else if($_GET['step']==2)
{
	if(empty($_SESSION['pass']))
	{
	if(empty($_POST['passwordbirthday'])&&empty($_POST['passwordsid'])&&!is_numeric($_POST['passwordbirthday'])&&!is_numeric($_POST['passwordsid']))
	{
	header("Location:convert.php");
	die();
	}
	
	if($_SESSION['birthday']!=$_POST['passwordbirthday']||$_SESSION['sid']!=$_POST['passwordsid'])
	{
?>
  <!--step -->
  <div class="news" style="background-image:url('../images/convert/convertS1fail.png')"> </div>
  <!--step end--> 
  
  <!--text-->
  <div class="corner whitebg">
    <div class="text whitebg corner">
      <div style="margin-top:10px;margin-bottom:10px"> <img src="images/convert/S1fail.png"/> </div>
      <div style="width:504px;height:301px;margin-left:auto;margin-right:auto;background-image:url('images/convert/S1failbg.png');background-repeat:no-repeat;">
        <div style="letter-spacing:20px;padding-top:85px"> <a href="javascript:history.back()"><img src="images/convert/S1failbutton1.png"/></a> <a href="convertS1.php"><img src="images/convert/S1failbutton2.png"/></a> </div>
        <div style="letter-spacing:10px;padding-top:80px"> <img src="images/convert/S1failbutton3.png"/> <img src="images/convert/S1failbutton4.png"/> </div>
      </div>
    </div>
  </div>
  <!--text end-->
  <?php
	}
	else if($_SESSION['birthday']==$_POST['passwordbirthday']&&$_SESSION['sid']==$_POST['passwordsid'])
	{
	$_SESSION['pass']=true;
	}
	}
	if(!empty($_SESSION['pass'])&&$_SESSION['pass'])
	{
	include('include/config.php');
	$id=$_SESSION['id'];
//if (empty($_GET['sortby'])) $sort="TIME";
//else $sort=$_GET['sortby'];
//"SELECT `gameinfo`.`COMPANY`,`bonus`.`GAME`,SUM(`bonus`.`VALUE`) AS 'VALUE'"
//"SELECT `gameinfo`.`COMPANY`,`bonus`.`GAME`,`gameinfo`.`GAMETYPE`,`bonus`.`VALUE`"
	$sql = "SELECT `co`.`FROM` AS '紅利商家',`co`.`RED` AS '紅利數量',`co`.`VALUE` AS '可換<img src=images/convert/co.png />幣',`co`.`NUMBER` AS ''"
	 	 . "FROM `co` "
	     . "WHERE `co`.`ID`='".$id."' AND `co`.`USED`=0";
//	. " GROUP BY `bonus`.`GAME`";
	$rows=mysql_query($sql,$link);
?>
  <script src="javascripts/jquery.tablesorter.min.js"></script> 
  <script type="text/javascript">
$(document).ready(function() 
    { 
        $("#bonus").tablesorter(); 
		
		$("#next").click(
		function(){
		var sum=$("#sum").html();
			if(sum!='0')
			{
				var r=confirm("總共"+sum+"co幣\n確定轉換？\n(提醒:轉換後就無法回復)");
				return r;
			}
			else
			return true;
		})
		/*$("#bonus thead tr th:last input:checkbox").click(function() {
        var checkedStatus = this.checked;
        $("#bonus tbody tr td:last-child input:checkbox").each(function() {
            this.checked = checkedStatus;
			hightlightTr(this);
			
        });
		sum();
		});
		
		$("#form1").submit(function() {
		var sum=$(".select").html();
		if(sum!="0")
		return true;
		else 
		{
		alert("未選取兌換項目！");
		return false;
		}
		
		});*/
	
	
		
		$("#bonus td").hover(
		function() 
		{  
		$(this).parent().children().css("background-color", "#E4FCCA");
		//$("input:checked").parent().parent().css("background-color", "#000000");
		},
		function() 
		{  
		$(this).parent().children().css("background-color", "");	
		//$("input:checked").parent().parent().css("background-color", "#000000");		
		});
    } 
); 

</script> 
  <script type="text/javascript">
                /*function hightlightTr(node){
                        if(node.checked){
                                node.parentNode.parentNode.className="checked";
                        }else{
                                node.parentNode.parentNode.className="";
                        }
						
                }
				function sum(){
				var sum=0;
				$("#bonus tbody tr.checked").each(function() {
				sum+= parseInt($(this).children(':nth-child(7)').html());
				})
				$(".select").html(sum);
				}*/
				
</script> 
  <!--step -->
  <div class="news" style="background-image:url('../images/convert/convertS2.png')"> </div>
  <!--step end--> 
  
  <!--text-->
  <div class="text whitebg corner" style="padding:15px">
    <div class="floatL"> <img src="images/convert/S2_1.png"/> </div>
    <div class="floatR" style="margin-bottom:10px"> <img src="images/convert/abbg.png"/> </div>
    <?php
		
		$colnum=mysql_num_fields($rows);
		$sum=0;
		//echo '<form id="form1" name="form1" method="POST" action="/convertS3confirm.php">';
		echo '<table id=bonus class="tablesorter center convert_table1">';
		echo '<thead>';
		echo "<tr>";
		//$field=mysql_fetch_field($rows);
	
			for($i=0;$i<$colnum-1;$i++)
			{
			$field=mysql_fetch_field($rows);
			echo '<th><b class="imgmiddle">'.$field->name.'</b></th>';
			}
	//echo "<th><input type=checkbox /></th>";
	
	//echo "<td><a href=bonusinfo.php?sortby=".$field->name.">".$field->name."</a></td>";
		echo "</tr></thead><tbody>";
		$j=0;
		unset($_SESSION['chose']);
		
			if(mysql_num_rows($rows))
			while($row = mysql_fetch_row($rows))
			{ 
			echo "<tr>";
    
				for($i=0;$i<$colnum-1;$i++)
				{
   // if($i==1)
   // echo "<td><a href=select_list.php?T1=".$ID."&T2=".$row[$i].">".$row[$i]."</td>"; 
   // else 
				echo "<td>".$row[$i]."</td>";
					if($i==2)
					{
					$sum+=$row[$i];
					}
				}
		// echo '<td><input type=checkbox class=checkbox name=chkbox[] onclick="hightlightTr(this);sum();" value='.$row[$i]."></td>";
			$_SESSION['chose'][$j]=$row[$i];
			$j++;
			echo "</tr>";
			}
	
	
?>
    </tbody>
    <tfoot>
      <tr>
        <td  colspan=2>總&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp計</td>
        <td><span id="sum"><?php echo $sum?></span></td>
      </tr>
    </tfoot>
    </table>
    
    <!--<p>選取<span class="select">0</span>點紅利金幣</p>--> 
    <a href="convert.php?step=3"><img id="next" style="margin-top:10px" src="images/convert/agreeS2.png"/></a> <a href="javascript:history.back()"><img style="padding-left:20px" src="images/convert/cancel.png" border="0"/></a> </div>
  <!--text end-->
  
  <?php
		
	mysql_close($link); 
	
	}
}
else if($_GET['step']==3&&!empty($_SESSION['pass'])&&$_SESSION['pass'])
{
	if(!empty($_SESSION['chose']))
	{
		include('include/config.php');
		$ids = join(',',$_SESSION['chose']);  
		//var_dump($ids);

		$sql="SELECT SUM(`co`.`USED`) AS 'check',SUM(`co`.`VALUE`) AS 'sum'".
			 "FROM `co`".
			 "WHERE `co`.`ID`='".$_SESSION['id']."' AND `co`.`NUMBER` IN ($ids)";
	
		$sql5="SELECT *".
			  "FROM `colog`".
			  "WHERE `colog`.`NUMBER` IN ($ids) AND `colog`.`ACT`='in'";	
		$rows5=mysql_query($sql5,$link);
		$rows=mysql_query($sql,$link);
		if(!mysql_num_rows($rows)||mysql_num_rows($rows5))
		{
			header("Location:http://www.zlf168.com");
			//echo "無資料index1";
		}
		else
		{
			$row = mysql_fetch_assoc($rows);
			//var_dump($row);
			if($row['check'])
			{
				header("Location:http://www.zlf168.com/");
				//echo "index2";
			}
			else
			{
				$date=date("Y-m-d",time()+8*60*60);
				$time=date("H:i:s",time()+8*60*60);
				$sum=0;
				$chose=$_SESSION['chose'];
				//var_dump($chose);
				for($i=0;$i<count($chose);$i++)
				{
					$number=$chose[$i];
					$sql3="SELECT `co`.`VALUE`".
					"FROM `co`".
					"WHERE `co`.`NUMBER` ='".$number."' AND `co`.`ID`='".$_SESSION['id']."'";
					$rows2=mysql_query($sql3,$link);
					$row2 = mysql_fetch_assoc($rows2);
					$sum+=$row2['VALUE'];
				}
				if($sum!=$row['sum'])
				{
					header("Location:http://www.zlf168.com/");
					//echo "index3";
				}
				else
				{
					for($i=0;$i<count($chose);$i++)
					{
						$number=$chose[$i];
						$sql="INSERT INTO `colog` (`NUMBER`,`DATE`,`TIME`,`ACT`) ".
										  "VALUES ('$number','$date','$time','in')";				 
						mysql_query($sql,$link);
	
						$sql2="UPDATE `co` SET `USED`=1 WHERE `co`.`NUMBER`='".$number."' AND `co`.`ID`='".$_SESSION['id']."'";				 
						mysql_query($sql2,$link);
					}
					$sql4="UPDATE `account` SET `CO`=`CO`+'".$sum."' WHERE `account`.`ID`='".$_SESSION['id']."'";	
					mysql_query($sql4,$link);
				//echo "ok";
				}
			}

		}
		unset($_SESSION['chose']);
		mysql_close($link); 
	}
	if(empty($_GET['menu']))
	{
		include('include/config.php');
		$date=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-7,date("Y")));
		
		$id=$_SESSION['id'];
		//if (empty($_GET['sortby'])) $sort="TIME";
		//else $sort=$_GET['sortby'];
		//"SELECT `gameinfo`.`COMPANY`,`bonus`.`GAME`,SUM(`bonus`.`VALUE`) AS 'VALUE'"
		//"SELECT `gameinfo`.`COMPANY`,`bonus`.`GAME`,`gameinfo`.`GAMETYPE`,`bonus`.`VALUE`"
		$sql = "SELECT `gz`.`TIME` AS '日期',`gz`.`FROM` AS '廣告名稱',`gz`.`VALUE` AS '轉利基數'"
			 . "FROM `gz` "
			 . "WHERE `gz`.`ID`='".$id."' AND `gz`.`USED`=0 AND `gz`.`TIME`>'$date'";
//	. " GROUP BY `bonus`.`GAME`";
		$rows=mysql_query($sql,$link);
?>
  <script src="javascripts/jquery.tablesorter.min.js"></script> 
  <script type="text/javascript">
$(document).ready(function() 
    { 
        $("#bonus").tablesorter(); 
    } 
); 

</script> 
  <!--step -->
  <div class="news" style="background-image:url('../images/convert/convertS3.png')"> </div>
  <!--step end--> 
  
  <!--text-->
  <div class="text whitebg corner" style="padding:15px">
    <div class="floatL"> <img src="images/convert/S3_1.png"/> </div>
    <div class="floatR" style="margin-bottom:10px"> <img src="images/convert/abbg.png"/> </div>
    <?php
			$colnum=mysql_num_fields($rows);
			$sum=0;
			//echo '<form id="form1" name="form1" method="POST" action="/convertS3confirm.php">';
			echo '<table id=bonus class="tablesorter center convert_table1">';
			echo "<thead>";
			echo "<tr>";
		//$field=mysql_fetch_field($rows);
	
			for($i=0;$i<$colnum;$i++)
			{
				$field=mysql_fetch_field($rows);
				echo '<th><b>'.$field->name.'</b></th>';
			}
			
			echo '<th><b>剩餘天數</b></th>';
			
	//echo "<th><input type=checkbox /></th>";
	
	//echo "<td><a href=bonusinfo.php?sortby=".$field->name.">".$field->name."</a></td>";
			echo "</tr></thead><tbody>";
			$j=0;
			if(mysql_num_rows($rows))
			while($row = mysql_fetch_row($rows))
			{ 
				echo "<tr>";
    
				for($i=0;$i<$colnum;$i++)
				{
   // if($i==1)
   // echo "<td><a href=select_list.php?T1=".$ID."&T2=".$row[$i].">".$row[$i]."</td>"; 
   // else 
					echo "<td>".$row[$i]."</td>";
					if($i==2)
					{
						$sum+=$row[$i];
					}
				}
				$day_token=explode("-",$row[0]);
				$day=date("d",mktime(0,0,0,date("m")-$day_token[1],date("d")-$day_token[2],date("Y")-$day_token[0]));
				echo "<td>".(7-(int)$day[1])."</td>";
		// echo '<td><input type=checkbox class=checkbox name=chkbox[] onclick="hightlightTr(this);sum();" value='.$row[$i]."></td>";
			//$_SESSION['chose'][$j]=$row[$i];
			//$j++;
				echo "</tr>";
			}
	
	
?>
    </tbody>
    <tfoot>
      <tr>
        <td  colspan=4>總共可轉：<span id="sum"><?php echo $sum?></span>金</td>
      </tr>
    </tfoot>
    </table>
    
    <!--<p>選取<span class="select">0</span>點紅利金幣</p>--> 
    <a href="convert.php?step=3&menu=1"><img id="next" style="margin-top:10px" src="images/convert/agreeS3.png"/></a> <a href="javascript:history.back()"><img style="padding-left:20px" src="images/convert/S3back.png" border="0"/></a> <a href="convert.php?step=3&menu=2"><img style="padding-left:20px" src="images/convert/S3final.png" border="0"/></a> </div>
  <!--text end-->
  <?php
		
	mysql_close($link); 
	}
	else if($_GET['menu']==1)
	{
		include('include/config.php');
		$date=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-7,date("Y")));
		
		$id=$_SESSION['id'];
		//if (empty($_GET['sortby'])) $sort="TIME";
		//else $sort=$_GET['sortby'];
		//"SELECT `gameinfo`.`COMPANY`,`bonus`.`GAME`,SUM(`bonus`.`VALUE`) AS 'VALUE'"
		//"SELECT `gameinfo`.`COMPANY`,`bonus`.`GAME`,`gameinfo`.`GAMETYPE`,`bonus`.`VALUE`"
		$sql = "SELECT `gz`.`TIME` AS '日期',`gz`.`FROM` AS '商品項目',`gz`.`VALUE` AS '轉利基數'"
			 . "FROM `gz` "
			 . "WHERE `gz`.`ID`='".$id."' AND `gz`.`USED`=0 AND `gz`.`TIME`>'$date'";
//	. " GROUP BY `bonus`.`GAME`";
		$rows=mysql_query($sql,$link);
?>
  <script src="javascripts/jquery.tablesorter.min.js"></script> 
  <script type="text/javascript">
$(document).ready(function() 
    { 
        $("#bonus").tablesorter(); 
    } 
); 

</script> 
  <!--step -->
  <div class="news" style="background-image:url('../images/convert/convertS3.png')"> </div>
  <!--step end--> 
  
  <!--text-->
  <div class="text whitebg corner" style="padding:15px">
    <div class="floatL"> <img src="images/convert/S3_2.png"/> </div>
    <div class="floatR" style="margin-bottom:10px"> <img src="images/convert/abbg.png"/> </div>
    <?php
			$colnum=mysql_num_fields($rows);
			$sum=0;
			//echo '<form id="form1" name="form1" method="POST" action="/convertS3confirm.php">';
			echo '<table id=bonus class="tablesorter center convert_table1">';
			echo "<thead>";
			echo "<tr>";
		//$field=mysql_fetch_field($rows);
	
			for($i=0;$i<$colnum;$i++)
			{
				$field=mysql_fetch_field($rows);
				echo '<th><b>'.$field->name.'</b></th>';
			}
			
			echo '<th><b>剩餘天數</b></th>';
			
	//echo "<th><input type=checkbox /></th>";
	
	//echo "<td><a href=bonusinfo.php?sortby=".$field->name.">".$field->name."</a></td>";
			echo "</tr></thead><tbody>";
			$j=0;
			/*if(mysql_num_rows($rows))
			while($row = mysql_fetch_row($rows))
			{ 
				echo "<tr>";
    
				for($i=0;$i<$colnum;$i++)
				{
   // if($i==1)
   // echo "<td><a href=select_list.php?T1=".$ID."&T2=".$row[$i].">".$row[$i]."</td>"; 
   // else 
					echo "<td>".$row[$i]."</td>";
					if($i==2)
					{
						$sum+=$row[$i];
					}
				}
				$day_token=explode("-",$row[0]);
				$day=date("d",mktime(0,0,0,date("m")-$day_token[1],date("d")-$day_token[2],date("Y")-$day_token[0]));
				echo "<td>".(7-(int)$day[1])."</td>";
		// echo '<td><input type=checkbox class=checkbox name=chkbox[] onclick="hightlightTr(this);sum();" value='.$row[$i]."></td>";
			//$_SESSION['chose'][$j]=$row[$i];
			//$j++;
				echo "</tr>";
			}*/
	
	
?>
    </tbody>
    <tfoot>
      <tr>
        <td  colspan=4>總共可轉：<span id="sum"><?php echo $sum?></span>金</td>
      </tr>
    </tfoot>
    </table>
    
    <!--<p>選取<span class="select">0</span>點紅利金幣</p>--> 
    <a href="convert.php?step=3&menu=2"><img id="next" style="margin-top:10px" src="images/convert/agreeS3.png"/></a> <a href="javascript:history.back()"><img style="padding-left:20px" src="images/convert/S3back.png" border="0"/></a> <a href="convert.php?step=3&menu=2"><img style="padding-left:20px" src="images/convert/S3final.png" border="0"/></a> </div>
  <!--text end-->
  <?php
		
	mysql_close($link); 
	}
	else if($_GET['menu']==2)
	{
		include('include/config.php');
		$id=$_SESSION['id'];
		$sql = "SELECT `account`.`CO` AS '<img src=images/convert/co.png style=margin-right:10px />幣總數'"
			 . "FROM `account` "
			 . "WHERE `account`.`ID`='".$id."'";
		$rows=mysql_query($sql,$link);
?>
  <script src="javascripts/jquery.tablesorter.min.js"></script> 
  <script type="text/javascript">
$(document).ready(function() 
    { 
        //$("#bonus").tablesorter(); 

		
    } 
); 

</script> 
  <!--step -->
  <div class="news" style="background-image:url('../images/convert/convertS3.png')"> </div>
  <!--step end--> 
  
  <!--text-->
  <div class="text whitebg corner" style="padding:15px">
    <div class="floatL"> <img src="images/convert/S3_3.png"/> </div>
    <div class="floatR" style="margin-bottom:10px"> <img src="images/convert/abbg.png"/> </div>
    <?php
			$colnum=mysql_num_fields($rows);
			$sum=0;

			echo '<table  class="tablesorter center convert_table2 imgmiddle" style="margin:0;padding:0">';
			echo "<thead>";
			echo "<tr>";
			for($i=0;$i<$colnum;$i++)
			{
				$field=mysql_fetch_field($rows);
				echo '<th style="margin:0;padding:0">'.$field->name.'</th>';
			}
			echo "</tr></thead><tbody>";
			if(mysql_num_rows($rows))
			while($row = mysql_fetch_row($rows))
			{ 
				echo "<tr>";
				for($i=0;$i<$colnum;$i++)
				{
					echo '<td style="font-size:36px;height:70px;line-height:70px;margin:0;padding:0">'.$row[$i].'</td>';
					
				}
				echo "</tr>";
			}
			echo "</tbody>";
			$date=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-7,date("Y")));
			$sql = "SELECT SUM(`gz`.`VALUE`) AS '可轉金總數'"
			     . "FROM `gz` "
				 . "WHERE `gz`.`ID`='".$id."' AND `gz`.`USED`=0 AND `gz`.`TIME`>'$date'";
			$rows=mysql_query($sql,$link);
			$colnum=mysql_num_fields($rows);


			echo "<thead>";
			echo "<tr>";
			for($i=0;$i<$colnum;$i++)
			{
				$field=mysql_fetch_field($rows);
				echo '<th style="margin:0;padding:0">'.$field->name.'</th>';
			}
			echo "</tr></thead><tbody>";
			if(mysql_num_rows($rows))
			while($row = mysql_fetch_row($rows))
			{ 
				echo "<tr>";
				for($i=0;$i<$colnum;$i++)
				{
					if($row[$i]==null)
					$row[$i]=0;
					echo '<td style="font-size:36px;height:70px;line-height:70px;margin:0;padding:0">'.$row[$i].'</td>';
					
				}
				echo "</tr>";
			}
			echo "</tbody></table>";
?>
    
    <!--<p>選取<span class="select">0</span>點紅利金幣</p>--> 
    <a href="convert.php?step=4"><img id="next" style="margin-top:25px" src="images/convert/agreeS3.png"/></a> <a href="http://www.zlf168.com/"><img style="padding-left:25px" src="images/convert/cancel.png" border="0"/></a>
    <div style="margin-top:65px;margin-bottom:15px"> <a href=""><img style="padding-left:25px" src="images/convert/S3_3more.png" border="0"/></a> <a href=""><img style="padding-left:25px" src="images/convert/S3_3most.png" border="0"/></a> <a href=""><img style="padding-left:25px" src="images/convert/S3_3member.png" border="0"/></a> </div>
  </div>
  <!--text end-->
  <?php
		
	mysql_close($link); 
	}
}
else if($_GET['step']==4&&!empty($_SESSION['pass'])&&$_SESSION['pass'])
{		

?>
  <script type="text/javascript">
$(document).ready(function() 
    { 
		$(".tablesorter tr:even td").css("background-color", "#FFD6C9");
    } 
); 
</script> 
  <!--step -->
  <div class="news" style="background-image:url('../images/convert/convertS4.png')"> </div>
  <!--step end--> 
  
  <!--text-->
  <div class="text whitebg corner" style="padding:15px">
    <div class="floatL"> <img src="images/convert/S4.png"/> </div>
    <div class="floatR" style="margin-bottom:10px"> <img src="images/convert/abbg.png"/> </div>
    <table id="text" class="tablesorter center convert_table1 convert_table3 imgmiddle b" style="margin:0;padding:0;letter-spacing:5px;">
      <thead>
        <tr>
          <th colspan=3>確認資料</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan=3><div class="left floatL convert_S4">戶名</div>
            <div class="convert_S4_right">xxx</div>
            <div class="left floatL convert_S4">
              <input type="radio" name="to" value="0" checked />
              匯款帳戶</div>
            <div class="convert_S4_right">1234567890123456</div>
            <div class="left floatL convert_S4">
              <input type="radio" name="to" value="1"/>
              信用卡帳戶</div>
            <div class="convert_S4_right">1234567890123456</div></td>
        </tr>
        <tr>
          <td class="left imgmiddle" style="padding-left:40px;line-height:25px;"><img src="images/convert/co.png">幣總數</td>
          <td style="line-height:25px;" colspan=2>1000
            <div class="floatR convert_unit"><img src="images/convert/co.png"></div></td>
        </tr>
        <tr>
          <td class="left" style="padding-left:40px;">可轉金總數</td>
          <td style="line-height:25px;" colspan=2>1020
            <div class="floatR convert_unit">金</div></td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <th colspan=3>兌換結果</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="left" style="padding-left:40px">可得給利金</td>
          <td colspan=2>1000
            <div class="floatR convert_unit">金</div></td>
        </tr>
        <tr>
          <td class="left" style="padding-left:40px">剩餘轉利金</td>
          <td colspan=2>20
            <div class="floatR convert_unit">金</div></td>
        </tr>
      </tbody>
      <thead>
        <tr>
          <th colspan=3>20給利金＝1元新台幣</th>
        </tr>
      </thead>
      <tbody>
        <tr></tr>
        <tr>
          <td class="left" style="padding-left:40px">可換得新台幣</td>
          <td colspan=2>500
            <div class="floatR convert_unit">元</div></td>
        </tr>
        <tr>
          <td class="left" style="padding-left:40px">匯款手續費</td>
          <td colspan=2>30
            <div class="floatR convert_unit">元</div></td>
        </tr>
        <tr>
          <td class="left" style="padding-left:40px">實際換得新台幣</td>
          <td colspan=2 style="font-size:21px">470
            <div class="floatR convert_unit">元</div></td>
        </tr>
        <tr>
          <td colspan=3><img src="images/convert/agreeS3.png"></td>
        </tr>
      </tbody>
      <thead>
        <tr></tr>
        <tr>
          <th colspan=3>注意事項</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="left" style="line-height:150%"						colspan=3><p>注意事項：</p>
            <p>1. 請仔細核對並確認匯款帳戶正確資料。</p>
            <p>2. 現金獎勵與會員相關權益和規定，請務必詳閱『Go 給利服務條款』。</p>
            <p>3. 『Go 給利』雖提供現金獎勵及獎品兌換，但請勿將此視為可一夜致富的網站。</p></td>
        </tr>
      </tbody>
    </table>
    <img style="margin-top:25px" src="images/convert/print.png"/>
	</div>
    <?php
}
else
{
header("Location:convert.php");
die();
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
</body>
</html>