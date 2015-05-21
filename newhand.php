<?php
session_start();
include('include/w3.html');
$title='給利新手';
include('include/header.php');
?>
<script type="text/javascript" src="javascripts/jquery.lightbox-0.5.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		
	
  $('.lightbox').lightBox(); // Select all links with lightbox class
	/*	$(".opacity").css("opacity","0.5");
		
		 $(".opacity").hover(
			function() {
                $(this).stop().animate({ opacity:1.0 }, 500);
            },
			function() {
               $(this).stop().animate({ opacity: 0.5 }, 500);
           });*/
	   
	   <?php if(!empty($_GET['goto'])) echo 'goToByScroll('.$_GET['goto'].');'; ?>
	});
</script>
</header>
<body class="newhand">
<div class="body center"> 
  
  <!--logo + menu-->
  <?php
include('include/logomenu.php');
?>
  <!--logo + menu end--> 
  
  <!--login + bigad-->
  <div>
    <div class="floatL login whitebg left loginpurple">
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
?>
    <script type="text/javascript">
function goToByScroll(id)
{
	$('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');
}
</script> 
    <!--step -->
    <div id="0" class="news" style="background-image:url('../images/newhand/head.png')"> </div>
    <!--step end--> 
    
    <!--text-->
    <div class="left text textnewhand whitebg corner">
      <div class="newhand_block newhand_head_block">
        <div class="newhand_head"> 項目 </div>
        <div class="whitebg" style="padding:20px;">
          <table class="newhand_table b"  style="width:100%;font-size:21px">
            <tbody>
              <tr>
                <td><a href="javascript:goToByScroll('1')">>>&nbsp會員須知</a></td>
                <td><a href="javascript:goToByScroll('9')">>>&nbsp給利金</a></td>
                <td><a href="javascript:goToByScroll('8')">>>&nbsp現金獎勵</a></td>
              </tr>
              <tr>
                <td><a href="javascript:goToByScroll('2')">>>&nbsp新手資格</a></td>
                <td><a href="javascript:goToByScroll('4')">>>&nbsp轉利基數</a></td>
                <td><a href="javascript:goToByScroll('7')">>>&nbsp購物賺賺樂</a></td>
              </tr>
              <tr>
                <td><a href="javascript:goToByScroll('3')">>>&nbspco幣</a></td>
                <td><a href="javascript:goToByScroll('5')">>>&nbsp獲得轉利基數</a></td>
                <td><a href="javascript:goToByScroll('6')">>>&nbsp廣告點點樂</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div id="1" class="newhand_block">
        <div class="newhand_head"> <b>『GO 給利』</b>會員須知：會員資料必須正確和一致。
          <div class="newhand_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="newhand_text">
          <p style="font-size:15px">例如：</p>
          <p style="font-size:15px">申請紅利公司會員帳號之姓名為：李小龍；身分證：A123456789。</p>
          <p style="font-size:15px"><b>『GO 給利』</b>會員登記之姓名：李小龍；身分證：A123456789。</p>
          <p style="font-size:15px">指定兌現匯款帳號之戶名：李小龍；身分證：A123456789。</p>
          <p style="font-weight:bolder">以上身分資料和姓名皆需同一人。</p>
        </div>
        <div class="newhand_text2">
          <p><b>『重要提醒』</b>相關個人資料必須正確一致，會員如因資料有誤而導致兌現失敗或造成其他損失，會員必須承擔所有責任和所產生之利損或法律問題， <b>『GO 給利』</b>一律不擔負任何賠償責任，如造成<b>『GO 給利』</b>任何損失，<b>『GO 給利』</b>保有一切相關 法律追訴權，且保有損失賠償追償權益。</p>
		 
	   </div>
      </div>
      <div id="2" class="newhand_block">
        <div class="newhand_head"> 新手資格：
          <div class="newhand_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="newhand_text">
          <p>只要您手上擁有各企業商家、遊戲公司所贈送的紅利點數，並加入<b>『GO 給利』</b>會員。</p>
        </div>
        <div class="newhand_text2">
          <p class="b">圖示說明：<span style="font-size:10px;">點擊看大圖</span></p>
		  <div class="center font0" >
			  <a class="lightbox" href="images/newhand/新手加入01.png"><img src="images/newhand/s新手加入01.png" alt="" /></a>
			  <a class="lightbox" href="images/newhand/新手加入02.png"><img src="images/newhand/s新手加入02.png" alt="" /></a>
			  <a class="lightbox" href="images/newhand/新手加入03.png"><img src="images/newhand/s新手加入03.png" alt="" /></a>
		  </div>
        </div>
      </div>
       
      <div id="3" class="newhand_block">
        <div class="newhand_head imgbottom"> co幣（念法：coco幣）圖示：<img style="height:35px;width:35px;" src="images/co.png">
          <div class="newhand_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="newhand_text">
          <p>co幣為<b>『GO 給利』</b>平台流通之紅利點數名稱，於平台中兌換、換購商品，或者通過活動參與可轉成現金。<span class="floatR"><a href="game.php">立刻賺 co 幣去...</a></span></p>
        </div>
        <div class="newhand_text2" style="padding:0"> </div>
      </div>
      
      <div id="9" class="newhand_block">
        <div class="newhand_head imgbottom"> 什麼是『給利金』
          <div class="newhand_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="newhand_text">
          <p>給利金：為<b>『Go 給利』</b>平台的專屬活動獎勵，最大特色為蒐集一定數額給利金可換取新台幣獎勵，
給利金與新台幣有一定兌換比例，現在為 20：1 有效期限至 2013/12/31，但<b>『Go 給利』</b>保有活動變
更的權力，於特殊活動可能有不同兌換比例，請您隨時注意官網動態訊息。</p>
        </div>
        <div class="newhand_text2"> 
	<p>如何取得給利金：</p>
<p>① 您必須於配合的廠商或線上遊戲中完成指定活動，得到獎勵 coco 幣。</p>
<p>② 加入<b>『GO 給利』</b>會員，於平台內點選指定廣告、使用 coco 幣兌換獎品、或現金購物、參與指定
活動...取得『轉利基數』。</p>
<p>③ 1 個 coco 幣 + 1 個轉利基數 可獲得 1 個給利金，（單位為『金』）ex：500 個幣+1000 個轉利基
數 可的 500 個給利金。</p>
<p>④ 進入您的會員中心填妥帳戶資訊，等待專人審核（3～7 個工作天，只需辦理一次），辦理完成，
即可將給利金轉換成新台幣獎勵匯到您指定您的個人銀行帳戶。</p>
	</div>
      </div>
      
      
      <div id="4" class="newhand_block">
        <div class="newhand_head"> 轉利基數：
          <div class="newhand_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="newhand_text">
          <p>單位為『轉』，點選廣告、購買商品、參與活動即可獲得，可儲存累計，有效使用期限為7天，您可於您的個人帳戶所見。帳戶中所累計之轉利基數為『現金獎勵』的重要轉換元素，可將您所擁有的co幣兌換成現金領取。</p>
        </div>
        <div class="newhand_text2">
          <p class="b">圖示說明：<span style="font-size:10px;">點擊看大圖</span></p>
		  <div class="center font0" >
		  <a class="lightbox" href="images/newhand/轉利基數.png"><img src="images/newhand/s轉利基數.png" alt="" /></a>
		  </div>
        </div>
      </div>
      <div id="5" class="newhand_block">
        <div class="newhand_head"> 獲得轉利基數：
          <div class="newhand_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="newhand_text">
          <p>1. <a href="javascript:goToByScroll('6')" style="color: #756459;text-decoration: none;">廣告點點樂</a>。</p>
          <p>2. <a href="javascript:goToByScroll('7')" style="color: #756459;text-decoration: none;">購物賺賺樂</a>。</p>
        </div>
        <div class="newhand_text2" style="padding:0"> </div>
      </div>
      <div id="6" class="newhand_block">
        <div class="newhand_head"> 廣告點點樂：
          <div class="newhand_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="newhand_text">
          <p>隨意點選<b>『GO 給利』</b>網站內廣告，觀看廣告，即可獲得轉利基數。</p>
        </div>
        <div class="newhand_text2">
          <p class="b">圖示說明：<span style="font-size:10px;">點擊看大圖</span></p>
		  <div class="center font0" >
		  <a class="lightbox" href="images/newhand/給利廣告01.png"><img src="images/newhand/s給利廣告01.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/給利廣告02.png"><img src="images/newhand/s給利廣告02.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/給利廣告03.png"><img src="images/newhand/s給利廣告03.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/給利廣告04.png"><img src="images/newhand/s給利廣告04.png" alt="" /></a>
		  </div>
        </div>
      </div>
      <div id="7" class="newhand_block">
        <div class="newhand_head"> 購物賺賺樂：
          <div class="newhand_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="newhand_text">
          <p>前往<b>『GO 給利』</b>網站購物商城，利用co幣購物或現金購物，完成購物，您即可獲得該筆訂單總價格與該筆訂單中單品項之最多的『轉利基數倍數』相乘後的『轉利基數』，您可於您的個人帳戶查詢。</p>
        </div>
        <div class="newhand_text2">
          <p class="b">圖示說明：<span style="font-size:10px;">點擊看大圖</span></p>
		  <div class="center font0" >
		  <a class="lightbox" href="images/newhand/購物01.png"><img src="images/newhand/s購物01.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/購物02.png"><img src="images/newhand/s購物02.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/購物03.png"><img src="images/newhand/s購物03.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/購物05.png"><img src="images/newhand/s購物05.png" alt="" /></a>
		  </div>
        </div>
      </div>
      <div id="8" class="newhand_block">
        <div class="newhand_head"> 現金獎勵：
          <div class="newhand_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="newhand_text">
          <p>1. 必須為<b>『GO 給利』</b>正式會員。</p>
          <p>2. 帳戶中需要有足夠co幣和足夠的轉利基數。</p>
          <p>3. 您可以隨時在您個人帳戶中將co幣轉成『給利金』，並指定匯款會員本人帳戶。</p>
          <p>4. 20 給利金＝新台幣 1 元，給利金與新台幣兌換交換率<b>『GO 給利』</b>有權力做變更，變更前10天會於<b>『GO 給利』</b>官網公告之。</p>
          <p>5. 您必須滿500元新台幣，即可匯款到指定個人帳戶，每筆匯款會扣除新台幣30元手續費，例如匯款500元至個人帳戶，您的個人帳戶實收新台幣470元。</p>
        </div>
        <div class="newhand_text2">
          <p><b>『重要提醒』</b>根據國稅局規定，若該會員年度累積得獎金額超過新台幣1,000元時，<b>『GO 給利』</b>須在年底寄出扣繳憑單給該會員， 因此若您在註冊時必須填寫正確之相關個人資訊，在兌換獎金或獎品之前，<b>『GO 給利』</b>有可能先確認您的真實姓名，因此有權要求您提供您的身份證、駕照正面影本，以證明您提供的資料並非造假。
            若您收到身分驗證的要求時，您可將證件傳真到(02)12345678， 亦可將證件掃描或拍照寄到<a href="mailto:gogeili.service@gmail.com">gogeili.service@gmail.com</a>，可於證件上註明「僅供<b>『GO 給利』</b>資料證明使用」，請勿遮蓋住重要資訊， 我們保證您的資料將受到嚴密的保護，並且絕對不提供會員資料給任何第三方的需要。
            如有任何其他疑慮，可參考<a href="http://www.zlf168.com/privacymanifesto.php" target="_blank">隱私權聲明</a>。 </p>
        </div>
        <div class="newhand_text">
          <p>6.<b>『GO 給利』</b>會員隨時可以將給利金兌換成新台幣，申請兌換時須以當時兌換匯率規定為準。</p>
          <p>7.若因提供錯誤的銀行代號或帳號導致匯款失敗，您將會被扣取600 co幣為手續費。</p>
          <p>8.會員在<b>『GO 給利』</b>帳戶中的『給利金』保存期限永久有效。</p>
          <p>9.<b>『GO 給利』</b>並不提供會員帳號之間的轉帳服務，或其他形式買賣服務。</p>
          <p>10.<b>『GO 給利』</b>並不提供會員以新台幣購買co幣和給利金的方式。</p>
          <p>11.任何會員若有提供不實個人資料或任何作弊的行為，會員所賺取的co幣與紅利金將會被全部沒收並永久終止並拒絕會員服務。</p>
        </div>
		<div class="newhand_text2">
		<p class="b">圖示說明：<span style="font-size:10px;">點擊看大圖</span></p>
          <div class="center font0" >
		  <a class="lightbox" href="images/newhand/兌換01.png"><img src="images/newhand/s兌換01.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/兌換02.png"><img src="images/newhand/s兌換02.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/兌換03.png"><img src="images/newhand/s兌換03.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/兌換04.png"><img src="images/newhand/s兌換04.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/兌換05.png"><img src="images/newhand/s兌換05.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/兌換06.png"><img src="images/newhand/s兌換06.png" alt="" /></a>
		  <a class="lightbox" href="images/newhand/兌換07.png"><img src="images/newhand/s兌換07.png" alt="" /></a>
		  </div>
        </div>
		
      </div>
    </div>
    <!--text end-->
    <?php
}
else if($_GET['step']=='cooperation')	
{	
?>
    <!--step -->
    <div class="news" style="background-image:url('../images/newhand/head_cooperation.png')"> </div>
    <!--step end--> 
    
    <!--text-->
    <div class="left text textnewhand whitebg corner">
      <div class="newhand_block" style="padding:2px">
        <div class="newhand_head center" style="letter-spacing:10px;font-weight:bolder;color:#FFF599"> 合作廠商 </div>
        <div class="newhand_text">  </div>
      </div>
      <div class="center"> <a href="convert.php"><img style="margin-top:25px" src="images/newhand/convert.png"></a><br/>
        <a href="newhand.php?step=cooperate"><img style="margin-top:25px" src="images/newhand/cooperate.png"></a> </div>
    </div>
    <!--text end-->
    
    <?php
}
else if($_GET['step']=='cooperate')
{
?>
    <script type="text/javascript" src="javascripts/newhand.js"></script> 
    <!--step -->
    <div class="news" style="background-image:url('../images/newhand/head_cooperate.png')"> </div>
    <!--step end--> 
    
    <!--text-->
    <div class="left text textnewhand whitebg corner">
      <form id="form1" name="form1" method="POST" action="newhand.php?step=cooperate_submit">
        <div class="newhand_block" style="padding:2px">
          <div class="newhand_head center" style="letter-spacing:10px;font-weight:bolder;color:#FFF599"> 請寫下列資料 </div>
          <div class="newhand_text" style="padding-left:40px">
            <div style="font-size:12px;colr:#6A3906"> 請填寫公司資料(*為必填欄位) </div>
            <div class="newhand_underline"></div>
            <div class="row">
              <label class="newhand_label"><span style="color:#EA5F20">＊</span>公&nbsp司&nbsp統&nbsp編</label>
              <input id="BRN" class="message"  type="text" name="BRN"   size="30"/>
            </div>
            <div class="row">
              <label class="newhand_label"><span style="color:#EA5F20">＊</span>公&nbsp司&nbsp名&nbsp稱</label>
              <input id="Bname" class="message"  type="text" name="Bname"  size="30"/>
            </div>
            <div class="row">
              <label class="newhand_label"><span style="color:#EA5F20">＊</span>公&nbsp司&nbsp總&nbsp機</label>
              <input id="Bphone" class="message"  type="text" name="Bphone"  size="30"/>
            </div>
            <div class="row">
              <label class="newhand_label"><span style="color:#EA5F20">＊</span>公&nbsp司&nbsp地&nbsp址</label>
              <input id="address" class="message"  type="text" name="address"   size="30"/>
            </div>
            <div class="row">
              <label class="newhand_label">公&nbsp司&nbsp網&nbsp址</label>
              <input id="web" class="message"  type="text" name="web"   size="30"/>
            </div>
            <div class="newhand_underline"></div>
            <div class="row">
              <label class="newhand_label"><span style="color:#EA5F20">＊</span>聯絡人姓名</label>
              <input id="Pname" class="message"  type="text" name="Pname"   size="30"/>
            </div>
            <div class="row">
              <label class="newhand_label"><span style="color:#EA5F20">＊</span>聯絡人電話</label>
              <input id="Pphone" class="message"  type="text" name="Pphone"  size="30"/>
            </div>
            <div class="row">
              <label class="newhand_label"><span style="color:#EA5F20">＊</span>聯絡人Email</label>
              <input id="Pemail" class="message"  type="text" name="Pemail"   size="30"/>
            </div>
            <div class="newhand_underline"></div>
            <div> 簡述營業項目／形式： </div>
            <textarea style="width:80%;height:200px;margin-top:10px;margin-bottom:10px" name="introduce">
					</textarea>
            <div> 合作方式簡述： </div>
            <textarea style="width:80%;height:200px;margin-top:10px;margin-bottom:10px" name="cooperate">
					</textarea>
            <div class="newhand_underline"></div>
            <div class="center"> 謝謝您！我們確認貴公司資料無誤後，會在五個工作天之內與您連絡。 </div>
          </div>
        </div>
        <div class="center">
          <input id="formsubmit" type="image" src="images/newhand/submit.png" alt="Submit Form"/>
        </div>
      </form>
    </div>
    <!--text end-->
    
    <?php
}
else if($_GET['step']=='cooperate_submit')
{
	//var_dump($_POST);
	include('include/check.php');
	$error=false;
	if(!checkStr($_POST['Pemail']))
		$error=true;
	if(empty($_POST['BRN'])||empty($_POST['Bname'])||empty($_POST['Bphone'])||empty($_POST['address'])||empty($_POST['Pname'])||empty($_POST['Pphone'])||empty($_POST['Pemail'])||$error)
	{
		header("Location: newhand.php?step=cooperate");
		die();
	}
	else
	{
		$weblink=empty($_POST['web'])?"沒寫":$_POST['web'];
		$introduce=empty($_POST['introduce'])?"沒寫":$_POST['introduce'];
		$cooperate=empty($_POST['cooperate'])?"沒寫":$_POST['cooperate'];	
		
		
		$time=date("Y-m-d H:i:s",time()+8*60*60);
		//error_reporting(E_ALL);
		include('include/setting.php');
		error_reporting(E_STRICT);

		date_default_timezone_set('America/Toronto');

		require_once('mail/class.phpmailer.php');
		//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

		$mail             = new PHPMailer();

		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "smtp.gmail.com"; // SMTP server
		$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "gogeili.service@gmail.com";  // GMAIL username
		$mail->Password   = "29039291";            // GMAIL password
		$mail->CharSet    = 'utf-8';
	
		$mail->SetFrom('gogeili.service@gmail.com', '客服 人員');

		$mail->Subject    = $_POST['Bname'].":合作提案信";

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		//$mail->MsgHTML($body);
		$mail->Body=
		"<body>
		公司統編:".$_POST['BRN']."<br>
		公司名稱:".$_POST['Bname']."<br>
		公司總機:".$_POST['Bphone']."<br>
		公司地址:".$_POST['address']."<br>
		公司網址:".$weblink."<br>
		聯絡人姓名:".$_POST['Pname']."<br>
		聯絡人電話:".$_POST['Pphone']."<br>
		聯絡人Email:".$_POST['Pemail']."<br>
		簡述營業項目／形式：".$introduce."<br>
		合作方式簡述：".$cooperate."<br>
		寄送日期:".$time."
		</body>
		";

		$mail->AddAddress($service_email, $_POST['Bname']);
		$mail->AddAddress($_POST['Pemail'], $_POST['Bname']);
		if($mail->Send())
		{
		
?>
    
    <!--step -->
    <div class="news" style="background-image:url('../images/newhand/head_cooperate.png')"> </div>
    <!--step end--> 
    
    <!--text-->
    <div class="left text textnewhand whitebg corner">
      <div class="newhand_block" style="padding:2px">
        <div class="newhand_text" style="padding-left:40px">
          <div class="center"> 謝謝您！我們確認貴公司資料無誤後，會在五個工作天之內與您連絡。 </div>
        </div>
      </div>
      <div class="center"><a href="http://www.zlf168.com/"><img src="images/newhand/next.png" /></a></div>
    </div>
    <!--text end-->
    <?php
		};
	}

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
<map name="planetmap1">
  <area shape="rect" coords="265,760,520,775" href="http://www.icash.com.tw/howtouse.asp" target="_blank" />
</map>
</body>
</html>