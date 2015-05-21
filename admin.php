<?php //科科
session_start();
include('include/w3.html');
?>
<header>
<title>後台</title>
<meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
</header>
<?php
if(empty($_GET['act'])) //首頁
{ 
	
	if(!empty($_SESSION['admin']))
	{
		echo '<b><p style="font-size:40px;">所有功能都沒做防護，請照規則使用，看不懂請說！<br>檔名別用中文和空白和符號！<br>檔名純英文或數字或底線！</p></b><br><br><br>';
		echo '<a href="admin.php?act=logout">登出</a><br><br><br>';
		echo '<a href="admin.php?act=newgood">新增商品</a><br><br><br>';
		echo '<a href="admin.php?act=getnewgoodsession">取得新增商品的權限(如果無法新增再按)</a><br><br><br>';
		echo '<a href="admin.php?act=deletegood">刪除空白無效商品(無名字的商品)</a><br><br><br>';
		echo '<a href="admin.php?act=updategood">修改商品</a><br><br><br>';
		echo '<a href="admin.php?act=offgood">下架商品</a><br><br><br>';
		echo '<a href="admin.php?act=onlinegood">上架商品</a><br><br><br>';
		echo '<a href="admin.php?act=addkind">新增分類</a><br><br><br>';
		echo '<a href="admin.php?act=addadlink">新增廣告連結(首頁，購物)</a><br><br><br>';
		echo '<a href="admin.php?act=edditadlink">修改廣告連結(首頁，購物)</a><br><br><br>';
		echo '<a href="admin.php?act=addstoreindexad">新增商城首頁廣告連結</a><br><br><br>';
		echo '<a href="admin.php?act=deletestoreindexad">刪除商城首頁廣告連結</a><br><br><br>';
		echo '<a href="admin.php?act=addgoad">新增給利廣告連結</a><br><br><br>';
		echo '<a href="admin.php?act=edditgoad">修改給利廣告連結</a><br><br><br>';
		echo '<a href="admin.php?act=unsetsessionurl">伺服器回到購物商城的目錄</a><br><br><br>';
		echo '<textarea name="info1"></textarea><br><br>';
		include_once "ck/ckeditor/ckeditor.php";
		//$_SESSION['ckeditor_baseUrl']='/images/goab/';
		$CKEditor = new CKEditor();
		$CKEditor->basePath = 'ck/ckeditor/';
		$CKEditor->replace("info1");
		
		
	}
	else
	{
		echo '<a href="admin.php?act=getsession">取得權限</a><br><br><br>';
	}

}
else if($_GET['act']=='logout')
{
	session_destroy();
	header("Location:admin.php");
	die();
}
else if($_GET['act']=='getsession')
{
	include('include/adminpw.php');
	if(empty($_GET['act2']))
	echo '<form method="POST" action="admin.php?act=getsession&act2=submit">'.
		 '<input type="password" name="password" value="' . $pw . '" />'.
		 '<input type="submit" name="Submit" value="Submit" />'.
		 '</form>';
	else if(!empty($_POST['password'])&&$_GET['act2']=='submit')
	{		
		if($_POST['password']==$pw)
		$_SESSION['admin']=true;
		header("Location:admin.php");
		die();
	}
	
}
else if($_GET['act']=='newgood'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2'])&&empty($_SESSION['goodid']))
	{
		include('include/config.php');
		$sql="SELECT MAX(`GOODS_ID`) AS 'max' FROM `store_good`";
		$rows=mysql_query($sql,$link);
		$row = mysql_fetch_assoc($rows);
		$goodid=$row['max']+1;
		$goodid = str_pad($goodid,8,'0',STR_PAD_LEFT);
		$sql="INSERT INTO `store_good` (`GOODS_ID`) 
								   VALUES ('$goodid')";
		$rows=mysql_query($sql,$link);
		$_SESSION['goodid']=$goodid;
		$sql="SELECT *  FROM `timesinfo`";
		$rows=mysql_query($sql,$link);
		
		

?>

	<form method="POST" action="admin.php?act=newgood&act2=submit">
	<p style="font-size:80px">此商品的編號為：<?php echo $goodid; ?></p>
	商品名稱<input name="name" />換行加&lt;br&gt <br><br>
	商品屬於哪一類<input name="kind" /><br><br>
	商品有什麼規格，<b style="font-size:40px">用&區隔 ex:L&XL&M</b><input name="size" /><br><br>
	商品多少CO<input name="co" /><br><br>
	商品倍數多少<input name="times" /><br><br>
	<?php
	while($row = mysql_fetch_assoc($rows))
	{
		echo '<p style="font-size:40px"><img src="images/store/times/'.$row['MENU'].'.png">輸入'.$row['MENU'].'</p>';
	}
	?>	
	商品特點<input name="special" /><br><br>
	<?php
	$sql2="SELECT *  FROM `specialinfo`";
	$rows2=mysql_query($sql2,$link);
	while($row2 = mysql_fetch_assoc($rows2))
	{
		echo '<p style="font-size:40px">'.$row2['VALUE'].'輸入'.$row2['MENU'].'</p>';
	}
	?>
	

		商品敘述：<textarea  name="desc"></textarea>
		<p style="font-size:40px">商品屬性</p> 
		特色
		<textarea name="info1"></textarea><br><br>
		規格
		<textarea name="info2"></textarea><br><br>
		運送
		<textarea name="info3"><p>
	&nbsp;</p>
<p>
	商品配送皆由廠商直接寄出，完成購物或成功兌換商品，Go給利完成核對相關資料會通知出貨廠商，會於3個工作天完成出貨，請您保持聯絡電話暢通，以便送貨人員通知運送或確認資料。</p>
<p>
	&nbsp;</p>
<p>
	運送範圍：限台灣本島與離島地區。<span style="color:#800000;">注意！收件地址請勿為郵政信箱。</span></p>
<p>
	&nbsp;</p>
<p>
	其他問題：請即時反應Go給利客服中心（02）12345678，感謝您。</p>
</textarea><br><br>
		保證
		<textarea name="info4"><p>
	&nbsp;</p>
<p>
	您所購買之商品皆屬新品，您所兌換的商品皆屬新品。</p>
<p>
	您所兌換或購買之商品皆享有廠商所提供之商品保固服務，各家之保固服務不同，購買或兌換前，請詳閱相關商品說明。</p>
</textarea><br><br>
		服務說明
		<textarea name="info5"><p>
	&nbsp;</p>
<p>
	<strong><span style="color:#660000;">co幣換貨說明：</span></strong></p>
<p>
	凡會員以co幣全額兌換之Go給利網站內的商品皆屬贈品，並且，在收到贈品的一星期內，贈品本身有故障或損壞Go給利將樂意的為您換取新貨，非故障損壞原因，贈品不能退還/退co幣，關於退換贈品，請Go給利客服（02）12345678解釋故障損壞之處，Go給利客服將會安排為您換取新貨。</p>
<p>
	GO給利提供正式會員獎品兌換，在收到您的兌換申請，GO給利會做嚴密的身分和資料審核，通過審核後您的獎品會在三個工作天寄出。</p>
<p>
	如果您提供錯誤的資訊而導致郵寄失敗要補寄，您將會被收取1000co幣的手續費。&nbsp;</p>
<p>
	co幣兌換之商品為贈品，所以您不會收到有關於商品之發票或收據，但您所兌換之獎品仍會於該商品廠商之承諾之相關保固服務。</p>
<p>
	&nbsp;</p>
<p>
	詳情見<a href="shopfaq.php">購物須知</a></p>
</textarea>
		<p style="font-size:40px">圖片上傳按上面的影像，圖片檔名需改成商品編號_數字：</p> 
		<p style="font-size:40px">ex:<?php echo $goodid; ?>_1.jpg</p> 
		<p style="font-size:40px">ex:<?php echo $goodid; ?>_2.png</p> 
		<input type="submit" value="新增" />
		
	</form>
<?php
		include_once "ck/ckeditor/ckeditor.php";
		$CKEditor = new CKEditor();
		$CKEditor->basePath = 'ck/ckeditor/';
		$CKEditor->replace("info1");
		$CKEditor->replace("info2");
		$CKEditor->replace("info3");
		$CKEditor->replace("info4");
		$CKEditor->replace("info5");
		$CKEditor->replace("desc");
	}
	else if(!empty($_POST['name'])&&!empty($_POST['kind'])&&!empty($_POST['size'])&&!empty($_POST['co'])&&!empty($_POST['desc'])&&!empty($_POST['info1'])&&!empty($_POST['info2'])&&!empty($_POST['info3'])&&!empty($_POST['info4'])&&!empty($_POST['info5'])&&!empty($_POST['times'])&&$_GET['act2']=='submit'&&!empty($_SESSION['goodid']))
	{
		include('include/config.php');
		$s="&Separated";
		$info=$_POST['info1'].$s.$_POST['info2'].$s.$_POST['info3'].$s.$_POST['info4'].$s.$_POST['info5'];
		$sql="UPDATE `store_good` SET `GOODS_NAME`='".$_POST['name']."',`KIND_ID`='".$_POST['kind']."',`GOODS_SIZE`='".$_POST['size']."',`CO_PRICE`='".$_POST['co']."',`GOODS_DESC`='".$_POST['desc']."',`GOODS_INFO`='".$info."',`TIMES`='".$_POST['times']."',`GOODS_SPECIAL`='".$_POST['special']."' WHERE `store_good`.`GOODS_ID`='".$_SESSION['goodid']."'";
		if(mysql_query($sql,$link))
		echo 'ok了，<a href="admin.php">回首頁</a>';
		
	}
	else
	{
		echo "有少輸入欄位或沒權限";
		var_dump($_REQUEST);
		var_dump($_SESSION);
	}
}
else if($_GET['act']=='getnewgoodsession'&&!empty($_SESSION['admin']))
{
	unset($_SESSION['goodid']);
	header("Location:admin.php");
	die();
}
else if($_GET['act']=='updategood'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2']))
	{
	echo '<form method="POST" action="admin.php?act=updategood&act2=submit">'.
		 '<input type="text" name="goodid"  />'.
		 '<input type="submit" name="Submit" value="Submit" />'.
		 '</form>';
		 if(!empty($_GET['error']))
		 echo $_GET['error'];
	}
	else if(!empty($_POST['goodid'])&&$_GET['act2']=='submit')
	{
		include('include/config.php');
		$sql="SELECT * FROM `store_good` WHERE `GOODS_ID`='".$_POST['goodid']."'";
		$rows=mysql_query($sql,$link);
		$row = mysql_fetch_assoc($rows);
		if(!mysql_num_rows($rows))
		{
			header("Location:admin.php?act=updategood&error=找不到商品");
			die();
		}
		else
		{
			$sql2="SELECT *  FROM `timesinfo`";
			$rows2=mysql_query($sql2,$link);
			$_SESSION['goodid']=$_POST['goodid'];
			
?>

	<form method="POST" action="admin.php?act=updategood&act2=update">
	<p style="font-size:80px">此商品的編號為：<?php echo $_POST['goodid']; ?></p>
	商品名稱<input name="name" value="<?php echo $row['GOODS_NAME']; ?>" />換行加&lt;br&gt <br><br>
	商品屬於哪一類<input name="kind" value="<?php echo $row['KIND_ID']; ?>" /><br><br>
	商品有什麼規格，<b style="font-size:40px">用&區隔 ex:L&XL&M</b><input name="size" value="<?php echo $row['GOODS_SIZE']; ?>" /><br><br>
	商品多少CO<input name="co" value="<?php echo $row['CO_PRICE']; ?>" /><br><br>
	商品倍數多少<input name="times" value="<?php echo $row['TIMES']; ?>" /><br><br>
	<?php
	while($row2 = mysql_fetch_assoc($rows2))
	{
		echo '<p style="font-size:40px"><img src="images/store/times/'.$row2['MENU'].'.png">輸入'.$row2['MENU'].'</p>';
	}
	//var_dump($row);
	$info_token=explode("&Separated",$row['GOODS_INFO']);
	?>	
	
	商品特點<input name="special"  value="<?php echo $row['GOODS_SPECIAL']; ?>" /><br><br>
	<?php
	$sql2="SELECT *  FROM `specialinfo`";
	$rows2=mysql_query($sql2,$link);
	while($row2 = mysql_fetch_assoc($rows2))
	{
		echo '<p style="font-size:40px">'.$row2['VALUE'].'輸入'.$row2['MENU'].'</p>';
	}
	?>
	

		商品敘述：<textarea  name="desc"><?php echo $row['GOODS_DESC']; ?></textarea>
		<p style="font-size:40px">商品屬性</p> 
		特色
		<textarea name="info1"><?php echo $info_token[0]; ?></textarea><br><br>
		規格
		<textarea name="info2"><?php echo $info_token[1]; ?></textarea><br><br>
		運送
		<textarea name="info3"><?php echo $info_token[2]; ?></textarea><br><br>
		保證
		<textarea name="info4"><?php echo $info_token[3]; ?></textarea><br><br>
		服務說明
		<textarea name="info5"><?php echo $info_token[4]; ?></textarea>
		<p style="font-size:40px">圖片上傳按上面的影像，圖片檔名需改成商品編號_數字：</p> 
		<p style="font-size:40px">ex:<?php echo $goodid; ?>_1.jpg</p> 
		<p style="font-size:40px">ex:<?php echo $goodid; ?>_2.png</p> 
		<input type="submit" value="修改" />
		
	</form>
<?php
		include_once "ck/ckeditor/ckeditor.php";
		$CKEditor = new CKEditor();
		$CKEditor->basePath = 'ck/ckeditor/';
		$CKEditor->replace("info1");
		$CKEditor->replace("info2");
		$CKEditor->replace("info3");
		$CKEditor->replace("info4");
		$CKEditor->replace("info5");
		$CKEditor->replace("desc");
		}
	}
	else if($_GET['act2']=='update')
	{
		include('include/config.php');
		$s="&Separated";
		$info=$_POST['info1'].$s.$_POST['info2'].$s.$_POST['info3'].$s.$_POST['info4'].$s.$_POST['info5'];
		$sql="UPDATE `store_good` SET `GOODS_NAME`='".$_POST['name']."',`KIND_ID`='".$_POST['kind']."',`GOODS_SIZE`='".$_POST['size']."',`CO_PRICE`='".$_POST['co']."',`GOODS_DESC`='".$_POST['desc']."',`GOODS_INFO`='".$info."',`TIMES`='".$_POST['times']."',`GOODS_SPECIAL`='".$_POST['special']."' WHERE `store_good`.`GOODS_ID`='".$_SESSION['goodid']."'";
		if(mysql_query($sql,$link))
		echo 'ok了，<a href="admin.php">回首頁</a>';
		else echo $sql;
	}
}
else if($_GET['act']=='offgood'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2']))
	{
	echo '<form method="POST" action="admin.php?act=offgood&act2=submit">'.
		 '<input type="text" name="goodid"  />'.
		 '<input type="submit" name="Submit" value="Submit" />'.
		 '</form>';
		 if(!empty($_GET['error']))
		 echo $_GET['error'];
	}
	else if(!empty($_POST['goodid'])&&$_GET['act2']=='submit')
	{
		include('include/config.php');
		$sql="UPDATE  `store_good` SET  `ONLINE` =b'0'  WHERE  `store_good`.`GOODS_ID` ='".$_POST['goodid']."'";
		if(mysql_query($sql,$link))
		echo 'ok了，<a href="admin.php">回首頁</a>';
		else echo $sql;
	
	}
}
else if($_GET['act']=='onlinegood'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2']))
	{
		include('include/show_array.php');
		include('include/config.php');
		echo '<form method="POST" action="admin.php?act=onlinegood&act2=submit">'.
			 '<input type="text" name="goodid"  />'.
			 '<input type="submit" name="Submit" value="Submit" />'.
			 '</form>';
			 if(!empty($_GET['error']))
			 echo $_GET['error'];
		$sql="SELECT `GOODS_ID` AS '商品編號' , `GOODS_NAME` AS '商品名稱' FROM `store_good` WHERE `ONLINE`=0";
		$rows=mysql_query($sql,$link);
		$all=array();
		while($row= mysql_fetch_assoc($rows))
		{
			array_push($all,$row);
		}
		echo "<br><br>目前所有已下架的商品：<br>";
		html_show_array($all);
	
	}
	else if(!empty($_POST['goodid'])&&$_GET['act2']=='submit')
	{
		include('include/config.php');
		$sql="UPDATE  `store_good` SET  `ONLINE` =b'1'  WHERE  `store_good`.`GOODS_ID` ='".$_POST['goodid']."'";
		if(mysql_query($sql,$link))
		echo 'ok了，<a href="admin.php">回首頁</a>';
		else echo $sql;
	
	}
}
else if($_GET['act']=='addkind'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2']))
	{
	echo '<form method="POST" action="admin.php?act=addkind&act2=submit">'.
		 '上層分類的id<input type="text" name="parentid"  /><br><br>'.
		 '增加的分類，&做區隔，ex:電腦&平板電腦<input type="text" name="newkind" size="150" /><br><br>'.
		 '<input type="submit" name="Submit" value="Submit" />'.
		 '</form>';
		 if(!empty($_GET['error']))
		 echo $_GET['error'];
	}
	else if(!empty($_POST['newkind'])&&!empty($_POST['parentid'])&&$_GET['act2']=='submit')
	{	
		$kind_token=explode("&",$_POST['newkind']);
		$parentid=$_POST['parentid'];
		//var_dump($kind_token);
		
		include('include/config.php');
		for($i=0;$i<count($kind_token);$i++)
		{
			$name=$kind_token[$i];
			$sql="INSERT INTO `store_kind` (`PARENT_ID`,`NAME`) ".
										  "VALUES ('$parentid','$name')";
			if(mysql_query($sql,$link))
			echo 'ok了，<a href="admin.php">回首頁</a><br>';
			else echo $sql.'<br>';
		}
	
	}
}
else if($_GET['act']=='addadlink'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2']))
	{
	echo '<form method="POST" action="admin.php?act=addadlink&act2=submit">'.
		 '圖片的路徑和檔名 <br>ex1:購物商城首頁輪播廣告 就填store_big/檔名.png<br>ex2:首頁輪播廣告 就填index/檔名.png<br><input type="text" name="targetid" size="150" /><br><br>'.
		 '連結 <br>ex1:連到商品頁面，編號00000026 就填store.php?goodid=00000026<br>ex2:如果是http://www.zlf168.com/news.php?event=1 只需要輸入news.php?event=1<br>否則，輸入完整網址 ex:http://www.google.com.tw/<br><input type="text" name="adlink" size="150" /><br><br>'.
		 '<input type="submit" name="Submit" value="Submit" />'.
		 '</form>';
		 if(!empty($_GET['error']))
		 echo $_GET['error'];
	}
	else if(!empty($_POST['targetid'])&&!empty($_POST['adlink'])&&$_GET['act2']=='submit')
	{	
		include('include/config.php');
		$sql="INSERT INTO `ad_link` (`TARGET`,`LINK`) ".
									  "VALUES ('".$_POST['targetid']."','".$_POST['adlink']."')";
		if(mysql_query($sql,$link))
		echo 'ok了，<a href="admin.php">回首頁</a><br>';
		else echo $sql.'<br>錯誤';		
	}
}
else if($_GET['act']=='edditadlink'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2']))
	{
		include('include/config.php');
		include('include/show_array.php');
		echo '<form method="POST" action="admin.php?act=edditadlink&act2=submit">'.
			 '要改的圖片的路徑和檔名<input type="text" name="targetid" size="150" /><br><br>'.
			 '新的連結 <input type="text" name="adlink" size="150" /><br><br>'.
			 '<input type="submit" name="Submit" value="Submit" />'.
			 '</form>';
		$sql="SELECT `TARGET` AS '圖片的路徑和檔名' , `LINK` AS '連結' FROM `ad_link`";
		$rows=mysql_query($sql,$link);
		$all=array();
		while($row= mysql_fetch_assoc($rows))
		{
			array_push($all,$row);
		}
		echo "<br><br>目前所有的：<br>";
		html_show_array($all);
		if(!empty($_GET['error']))
		echo $_GET['error'];
	}
	else if(!empty($_POST['targetid'])&&!empty($_POST['adlink'])&&$_GET['act2']=='submit')
	{	
		include('include/config.php');
		$sql="UPDATE  `ad_link` SET  `LINK` ='".$_POST['adlink']."'  WHERE  `TARGET` ='".$_POST['targetid']."'";
		if(mysql_query($sql,$link))
		echo 'ok了，<a href="admin.php">回首頁</a><br>';
		else echo $sql.'<br>錯誤';		
	}
}
else if($_GET['act']=='addstoreindexad'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2']))
	{
	echo '<form method="POST" action="admin.php?act=addstoreindexad&act2=submit">'.
		 '商品的ID，八位數 <br>ex1:00000084 <input type="text" name="targetid" size="150" /><br><br>'.
		 'tiptip要跳出的文字title，不知道要放什麼就放商品名稱 <br>ex1:Kensington PowerLift 備用電池和底座<input type="text" name="adname" size="150" /><br><br>'.
		 '屬於哪類，遊戲娛樂是1，美食餐飲是2，品味生活是3，時尚精品是4，溫馨居家是5，旅遊住宿是6，3C科技是7<input type="text" name="type" size="150" /><br><br>'.
		 '屬於哪類，最新精選是1，熱銷商品是2，倍數最多是3，以上皆是是0<input type="text" name="type2" size="150" /><br><br>'.
		 '<input type="submit" name="Submit" value="Submit" />'.
		 '</form>';
		 if(!empty($_GET['error']))
		 echo $_GET['error'];
	}
	else if(!empty($_POST['targetid'])&&!empty($_POST['adname'])&&!empty($_POST['type'])&&!empty($_POST['type2'])&&$_GET['act2']=='submit')
	{	
		include('include/config.php');
		$sql="INSERT INTO `store_index_ad` (`GOODS_ID`,`GOODS_NAME`,`TYPE`,`TYPE2`) ".
									  "VALUES ('".$_POST['targetid']."','".$_POST['adname']."','".$_POST['type']."','".$_POST['type2']."')";
		if(mysql_query($sql,$link))
		echo 'ok了，<a href="admin.php">回首頁</a><br>';
		else echo $sql.'<br>錯誤';		
	}
}
else if($_GET['act']=='deletestoreindexad'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2']))
	{
		include('include/show_array.php');
		include('include/config.php');
		echo '<form method="POST" action="admin.php?act=deletestoreindexad&act2=submit">'.
			 '輸入編號:(不是商品編號)<br><input type="text" name="seq"  />'.
			 '<input type="submit" name="Submit" value="Submit" />'.
			 '</form>';
			 if(!empty($_GET['error']))
			 echo $_GET['error'];
		$sql="SELECT `SEQ` AS '編號' , `GOODS_ID` AS '商品編號' , `GOODS_NAME` AS '商品名稱' , `TYPE` , `TYPE2` FROM `store_index_ad`";
		$rows=mysql_query($sql,$link);
		$all=array();
		while($row= mysql_fetch_assoc($rows))
		{
			array_push($all,$row);
		}
		echo "<br><br>目前所有廣告：<br>";
		html_show_array($all);
	}
	else if(!empty($_POST['seq'])&&$_GET['act2']=='submit')
	{	
		include('include/config.php');
		$sql="DELETE FROM `store_index_ad` WHERE `seq`='".$_POST['seq']."'";
		if(mysql_query($sql,$link))
		echo 'ok了，<a href="admin.php">回首頁</a><br>';
		else echo $sql.'<br>錯誤';		
	}
}
else if($_GET['act']=='deletegood'&&!empty($_SESSION['admin']))
{
	include('include/config.php');
	$sql="DELETE FROM `store_good` WHERE `GOODS_NAME`=''";
	if(mysql_query($sql,$link))
	echo 'ok了，<a href="admin.php">回首頁</a><br>';
	else echo $sql.'<br>錯誤';		

}
else if($_GET['act']=='addgoad'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2']))
	{
		include('include/config.php');
		echo '<form method="POST" action="admin.php?act=addgoad&act2=submit">'.
			 '輸入小圖檔名(包含副檔名):(e.g. 00000021.png)<br><input type="text" name="thumb"  /><br>'.
			 '輸入大圖檔名(包含副檔名):(e.g. 00000021.png)<br><input type="text" name="img_name"  /><br>'.
			 '輸入menu ID:<br><input type="text" name="m_id"  /><br>';
		$sql2="SELECT *  FROM `gzinfo`";
		$rows2=mysql_query($sql2,$link);
		while($row2 = mysql_fetch_assoc($rows2))
		{
			echo '<p style="font-size:40px">'.$row2['VALUE'].'轉輸入'.$row2['MENU'].'</p>';
		}
			 
		echo '輸入廣告尺寸:(L or M or S)<br><input type="text" name="size"  /><br>'.
			 '<input type="submit" name="Submit" value="Submit" />'.
			 '</form>';
			 
		echo '<textarea name="info1"></textarea><br><br>';
		include_once "ck/ckeditor/ckeditor.php";
		$_SESSION['ckeditor_baseUrl']='/images/goab/';
		$CKEditor = new CKEditor();
		$CKEditor->basePath = 'ck/ckeditor/';
		$CKEditor->replace("info1");
			 
		
	}
	else if(!empty($_POST['thumb'])&&!empty($_POST['m_id'])&&!empty($_POST['img_name'])&&!empty($_POST['size'])&&$_GET['act2']=='submit')
	{
		include('include/config.php');
		$sql="INSERT INTO `go_ad` (`MENU_ID`, `THUMB`, `SIZE`, `IMG_NAME`) VALUES ('".$_POST['m_id']."', '".$_POST['thumb']."', '".$_POST['size']."', '".$_POST['img_name']."')";
		if(mysql_query($sql,$link))
		echo 'ok了，<a href="admin.php">回首頁</a><br>';
		else echo $sql.'<br>錯誤';		
	}
}
else if($_GET['act']=='edditgoad'&&!empty($_SESSION['admin']))
{
	if(empty($_GET['act2']))
	{
		include('include/config.php');
		include('include/show_array.php');
		echo '<form method="POST" action="admin.php?act=edditgoad&act2=submitid">';		 
		echo '輸入abid or seq:(abid=17 輸入17)<br><input type="text" name="abid"  /><br>'.
			 '<input type="submit" name="Submit" value="Submit" />'.
			 '</form>';
		$all=array(); 
		$sql="SELECT *  FROM `go_ad` WHERE `ONLINE`=0";
		$rows=mysql_query($sql,$link);
		while($row= mysql_fetch_assoc($rows))
		{
			array_push($all,$row);
		}
		echo "<br><br>目前所有已下架的商品：<br>";
		html_show_array($all);
	}
	else if($_GET['act2']=='submitid'&&!empty($_POST['abid']))
	{
		include('include/config.php');
		$sql="SELECT *  FROM `go_ad` WHERE `SEQ`='".$_POST['abid']."'";
		$rows=mysql_query($sql,$link);
		$row = mysql_fetch_assoc($rows);
		echo '<form method="POST" action="admin.php?act=edditgoad&act2=submit">'.
			 '輸入小圖檔名(包含副檔名):(e.g. 00000021.png)<br><input type="text" name="thumb" value="'.$row['THUMB'].'"  /><br>'.
			 '輸入大圖檔名(包含副檔名):(e.g. 00000021.png)<br><input type="text" name="img_name" value="'.$row['IMG_NAME'].'"  /><br>'.
			 '<input type="hidden" name="abid" value="'.$_POST['abid'].'"  />'.
			 '輸入menu ID:<br><input type="text" name="m_id" value="'.$row['MENU_ID'].'"  /><br>';
		$sql2="SELECT *  FROM `gzinfo`";
		$rows2=mysql_query($sql2,$link);
		while($row2 = mysql_fetch_assoc($rows2))
		{
			echo '<p style="font-size:40px">'.$row2['VALUE'].'轉輸入'.$row2['MENU'].'</p>';
		}
			 
		echo '輸入廣告尺寸:(L or M or S)<br><input type="text" name="size" value="'.$row['SIZE'].'"  /><br>'.
			 '狀態:1為上架 0為下架<br><input type="text" name="online" value="'.$row['ONLINE'].'"  /><br>'.
		
			 '<input type="submit" name="Submit" value="Submit" />'.
			 '</form>';
			 
		echo '<textarea name="info1"></textarea><br><br>';
		include_once "ck/ckeditor/ckeditor.php";
		$_SESSION['ckeditor_baseUrl']='/images/goab/';
		$CKEditor = new CKEditor();
		$CKEditor->basePath = 'ck/ckeditor/';
		$CKEditor->replace("info1");
			 
		
	}
	else if(!empty($_POST['thumb'])&&!empty($_POST['m_id'])&&!empty($_POST['img_name'])&&!empty($_POST['size'])&&$_GET['act2']=='submit')
	{
		include('include/config.php');
		$sql="UPDATE `go_ad` SET `THUMB`='".$_POST['thumb']."',`MENU_ID`='".$_POST['m_id']."',`SIZE`='".$_POST['size']."',`IMG_NAME`='".$_POST['img_name']."',`ONLINE`='".$_POST['online']."' ".
		     "WHERE `SEQ`='".$_POST['abid']."'";
		if(mysql_query($sql,$link))
		echo 'ok了，<a href="admin.php">回首頁</a><br>';
		else echo $sql.'<br>錯誤';		
	}
	
}
else if($_GET['act']=='unsetsessionurl'&&!empty($_SESSION['admin']))
{
	unset($_SESSION['ckeditor_baseUrl']);
	echo 'ok了，<a href="admin.php">回首頁</a><br>';
}
else
{
	header("Location:admin.php");
	die();
}
?>