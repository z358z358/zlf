<?php
session_start();
include('include/w3.html');
$title='給利客服';
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
<body class="service">
<div class="body center"> 
  
  <!--logo + menu-->
  <?php
include('include/logomenu.php');
?>
  <!--logo + menu end--> 
  
  <!--login + bigad-->
  <div>
    <div class="floatL login whitebg left loginblue">
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
	$('html,body').animate({scrollTop: $("#"+id).offset().top -24},'slow');
	if(id!=0)
	{
		var target='div #'+id;
		$(target).animate({marginBottom: "250px"}, 1000).animate({opacity:1,marginBottom: "250px"}, 5000).animate({marginBottom: "25px"}, 5000);
	}
}
$(document).ready(function() {	 
	$("#firstpane p.menu_head").click(function()
	{
   $(this).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("fast");
   //$(this).siblings().css({backgroundImage:"url(left.png)"});
	});

});
</script> 
    <!--step -->
    <div id="0" class="news" style="background-image:url('../images/service/head.png')"> </div>
    <!--step end--> 
    
    <!--text-->
    <div class="left text textservice whitebg corner">
      <div class="service_block service_head_block">
        <div class="service_head"> 項目
          <div class="floatR" style="padding-right:10px">點擊下列項目前往</div>
        </div>
        <div class="whitebg" style="padding:20px;">
          <div id="firstpane" class="menu_list">
            <p class="menu_head">帳戶及程序問題</p>
            <div class="menu_body"> <a href="javascript:goToByScroll('1')">>>&nbsp請問一定要先加入『Go給利』會員嗎？</a> <a href="javascript:goToByScroll('2')">>>&nbsp為什麼我的帳戶看不到我的co幣？</a> <a href="javascript:goToByScroll('3')">>>&nbsp可以更改登記的匯款帳戶或信用卡嗎？</a> </div>
            <div class="service_underline"></div>
            <p class="menu_head">購物商城問題</p>
            <div class="menu_body"> <a href="javascript:goToByScroll('4')">>>&nbsp何時拿到兌換的商品或購物的商品？</a> <a href="javascript:goToByScroll('5')">>>&nbsp我沒收到我所兌換或購物的商品。</a> <a href="javascript:goToByScroll('6')">>>&nbsp我收到的商品需要退(換)貨，該怎麼辦？</a> <a href="javascript:goToByScroll('7')">>>&nbsp兌換或購買的的商品退貨，我的co幣會退還嗎？</a> </div>
            <div class="service_underline"></div>
            <p class="menu_head">虛擬點數問題</p>
            <div class="menu_body"> <a href="javascript:goToByScroll('8')">>>&nbsp市面上的紅利積點都可以轉換成coco 幣嗎？</a> <a href="javascript:goToByScroll('9')">>>&nbsp給利金獎勵兌換如何辦理？</a> <a href="javascript:goToByScroll('10')">>>&nbsp我的co幣有期限嗎？</a> <a href="javascript:goToByScroll('11')">>>&nbsp我的給利金有使用期限嗎？</a> <a href="javascript:goToByScroll('12')">>>&nbsp給利金儲存上限？</a> <a href="javascript:goToByScroll('13')">>>&nbsp節省匯款手續費作法。</a> <a href="javascript:goToByScroll('14')">>>&nbsp給利金兌現後多久可以收到匯款？</a> <a href="javascript:goToByScroll('15')">>>&nbsp累積多少co幣才可以兌換現金呢？</a> </div>
            <div class="service_underline"></div>
            <div class="center" style="padding-top:15px"><a href="service.php?step=ask"><img src="images/service/ask.png" /></a></div>
          </div>
        </div>
      </div>
      <div id="1" class="service_block">
        <div class="service_head"> 請問一定要先加入『Go給利』會員嗎？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>『Go給利』提供你簡單又安全的紅利轉換平台，為提供你更多服務以及保障你的權益，在進行點數交換前請先加入會員，用您現有的Facebook、Google、或Yahoo帳號就可以馬上登入囉！</p>
        </div>
        <div class="service_text2">
          <p><b>『重要提醒』</b>當您需要於『Go給利』商品兌換，購物或現金兌換獎勵時需填寫相關正式資料，以確保您自身權益。</p>
        </div>
      </div>
      <div id="2" class="service_block">
        <div class="service_head"> 為什麼我的帳戶看不到我的co幣？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>1.是否已經成為『Go給利』正式會員，填好相關資料成為正式會員，您即可在個人帳戶上看到配合廠商所提供紅利與co幣兌換明細。</p>
          <p>2.是否已在指定的配合廠商或配合的線上遊戲中完成 coco 幣贈送條件呢？贈送條件活動每一配合的廠商和線上遊戲皆不相同，請洽該單位公布之條件或者洽詢該配合廠商或線上遊戲之客服人員。</p>
	  <p>3. 若您已經完成指定的配合廠商或配合的線上遊戲中完成 coco 幣贈送條件，也確定的確擁有 coco
幣，但是依然在您的帳戶系統介面還是沒有看到所增加的 coco 幣，麻煩請您聯絡本平台之<a style="text-decoration:none" href="service.php?step=ask">客服人員</a>，
我們會儘快為您處理。感謝您的配合。</p>
        </div>
        <div class="service_text2" style="padding:0"> </div>
      </div>
      <div id="3" class="service_block">
        <div class="service_head"> 可以更改登記的匯款帳戶或信用卡嗎？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>可以的！請由個人帳戶中直接點選『更改帳戶』，按照步驟操作即可，每次新的帳戶更改時必須通過7個工作天的身分審核，並扣除1000 co幣為更改手續費，若個人帳戶co幣不足則無法變更登陸帳戶。</p>
        </div>
        <div class="service_text2" style="padding:0"> </div>
      </div>
      <div id="4" class="service_block">
        <div class="service_head"> 何時拿到兌換的商品或購物的商品？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>當您完成兌換商品或購物成功之後，系統會於商品出貨發送簡訊或mail告知，商品會由廠商於5個工作天內寄達您所指定之地點。</p>
        </div>
        <div class="service_text2" style="padding:0"> </div>
      </div>
      <div id="5" class="service_block">
        <div class="service_head"> 我沒收到我所兌換或購物的商品。
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>您於成功完成商品兌換或購買之後，5個工作天內未收到任何告知訊息或商品，請務必直接來電客服中心02-12345678或留言於客服中心留言板，『Go給利』客服會於最快時間幫您查詢並主動協助相關辦理商品寄送問題。</p>
        </div>
        <div class="service_text2" style="padding:0"> </div>
      </div>
      <div id="6" class="service_block">
        <div class="service_head"> 我收到的商品需要退(換)貨，該怎麼辦？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>1. 在『Go 給利』平台中使用 coco 幣所兌換的商品，皆屬於『Go 給利』或與廠商所贈予的獎品，無 7 天鑑賞期...等退
換貨之條件，但所兌換之商品本身非因兌換者所造成人為因素之損傷，請務必於收到商品後七天內聯
絡『Go 給利』客服，超過七天之後請恕無法辦理，但限定於同款商品之換貨（非退貨）。</p>
	  <p>2. 您購物所得之商品，皆遵守中華民國消費者保護法相關法令之規範，商品於該產品販售網頁上皆
有相關退換貨規定，需以此頁面公告說明為退換貨為主要退換貨依據，若您於該公告下完成購物，視
同會員同意和遵守該公告內容。如需退換貨，請您於 7 天鑑賞期內，聯絡『Go 給利』客服 02‐12345678，
我們會於最快時間幫您查詢並主動協助相關辦理。</p>
        </div>
        <div class="service_text2">
          <p><b>『重要提醒』</b>請務必直接來電客服中心02-12345678或<a style="text-decoration:none" href="service.php?step=ask">留言於客服中心留言板</a>，『Go給利』客服會於最快時間幫您查詢並主動協助相關辦理商品問題。</p>
        </div>
      </div>
      <div id="7" class="service_block">
        <div class="service_head"> 兌換或購買的的商品退貨，我的co幣會退還嗎？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>如於正式退貨成功之後，您所使用的co幣會於3個工作天內退還至您的個人帳戶，如有相關問題，請務必直接來電客服中心02-12345678或留言於客服中心留言板，『Go給利』客服會於最快時間幫您查詢並主動協助相關辦理。</p>
        </div>
        <div class="service_text2" style="padding:0"> </div>
      </div>
      <div id="8" class="service_block">
        <div class="service_head"> 市面上的紅利積點都可以轉換成coco 幣嗎？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>您取得紅利積點的廠商必須和『Go 給利』有達成合作，您的紅利積點才可以換成 coco 幣，而每家廠
商一配合不同，兌換比例也不同喔！</p>
        </div>
        <div class="service_text2">
          <p>查詢：<a href="newhand.php?step=cooperation">合作廠商</a>。</p>
        </div>
      </div>
      <div id="9" class="service_block">
        <div class="service_head"> 給利金獎勵兌換如何辦理？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>請您參閱<a class="b" href="newhand.php?goto=8">現金獎勵兌換</a>。</p>
        </div>
        <div class="service_text2" style="padding:0"> </div>
      </div>
      <div id="10" class="service_block">
        <div class="service_head"> 我的co幣有期限嗎？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>是的！您原有之紅利積點，使用期限請洽原發放單位。co幣，為『Go給利』之通用獎勵虛擬單元，有使用之期限，使用期限會在您的個人帳戶之內顯示，若於期限到期未使用是同會員放棄，帳戶會清空歸零。</p>
        </div>
        <div class="service_text2" style="padding:0"> </div>
      </div>
      <div id="11" class="service_block">
        <div class="service_head"> 我的給利金有使用期限嗎？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>給利金有效期限至 2013 年 12 月 31 日（紅利金效期為 1 年），給利金為『Go 給利』平台所舉辦之贈
獎活動的獎勵，您必須規定時限內使用，若於期限到期未使用是同會員放棄，帳戶會清空歸零，請您
特別注意。</p>
        </div>
        <div class="service_text2" style="padding:0"> </div>
      </div>
      <div id="12" class="service_block">
        <div class="service_head"> 給利金儲存上限？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>因應風險考量，您的給利金帳戶上限為 200000 金（依當時兌換比例換算，累積至相當於新台幣 10000
元的給利金數量為最大存取量），當達到上限後，您必須領取後才會有儲存的額度。</p>
        </div>
        <div class="service_text2" style="padding:0"> </div>
      </div>
      <div id="13" class="service_block">
        <div class="service_head"> 節省匯款手續費作法。
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>由於Go給利匯款所使用的銀行是中國信託商業銀行，如果您提供的匯款銀行帳戶也是中國信託商業銀行的話，您就不需要被收取新台幣30元的手續費。</p>
	  <p>我們也不定時會增加配合的銀行，增加後會另行公布於官網。</p>
        </div>
        <div class="service_text2">
          <p><b>『重要提醒』</b>除此之外，只要是使用其他銀行或是郵局帳號匯款都要收取新台幣30元的手續費。</p>
        </div>
      </div>
      <div id="14" class="service_block">
        <div class="service_head"> 給利金兌現後多久可以收到匯款？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>您必須指定您個人帳戶（含信用卡帳戶）來接收匯款，Go給利會針對您所提供新的帳戶做嚴密的身分和資料審核，工作時間為 7 個工作天，期間您可能會接到確認電話，請您務必留下您正確可聯絡資訊，通過審核後，您第一次所申請的款項會在7個工作天內收到，第2次之後該帳戶所審請的退款會在3個工作天內收到，如超過時間，在您的指定帳戶仍未收到現金獎勵，請務必聯絡『Go 給利』客服中心 02‐12345678，
我們將盡快為您查詢辦理。</p>
        </div>
        <div class="service_text2">
          <p><b>『重要提醒』</b>：如果您提供錯誤的銀行資訊而導致匯款失敗，您將會被收取600 co幣的手續費，而因此造成匯款無法追回，『Go 給利』將不另行補發匯款金額，若因此造成『Go 給利』相關損
失或其他法律責任，『Go 給利』將保有一切責任追朔權。</p>
        </div>
      </div>
      <div id="15" class="service_block">
        <div class="service_head"> 累積多少co幣才可以兌換現金呢？
          <div class="service_top floatR"><a href="javascript:goToByScroll('0')">TOP</a></div>
        </div>
        <div class="service_text">
          <p>您只要累積滿 10000 個 coco 幣，
即可以申請兌換 500 元現金獎勵，期
限至 2113/12/31。</p>
        </div>
        <div class="service_text2" style="padding:0"> </div>
      </div>
    </div>
    <!--text end-->
    <?php
}
else if($_GET['step']=='ask')
{
?>
    <script type="text/javascript" src="javascripts/newhand.js"></script> 
    <!--step -->
    <div class="news" style="background-image:url('../images/service/head.png')"> </div>
    <!--step end--> 
    
    <!--text-->
    <div class="left text textservice whitebg corner">
      <form id="form1" name="form1" method="POST" action="service.php?step=ask_submit">
        <div class="service_block" style="padding:2px">
          <div class="service_head center" style="letter-spacing:10px;font-weight:bolder;color:#D4E0FF"> 請填妥下列表單 </div>
          <div class="service_text" style="padding-left:40px">
            <div style="font-size:12px;colr:#6A3906"> *為必填欄位 </div>
            <div class="service_underline"></div>
            <div class="row">
              <label class="service_label"><span style="color:#EA5F20">＊</span>問&nbsp題&nbsp類&nbsp型</label>
              <select size=1 name="kindof">
                <option value="1" selected>帳戶資料問題</option>
                <option value="2">商城購物問題</option>
                <option value="3">co幣轉換問題</option>
                <option value="4">轉利基數問題</option>
                <option value="5">給利遊戲問題</option>
                <option value="else">其他疑難雜症</option>
              </select>
            </div>
            <div class="row">
              <label class="service_label"><span style="color:#EA5F20">＊</span>如&nbsp何&nbsp稱&nbsp呼</label>
              <input id="Pname" class="message"  type="text" name="Pname"  size="30"/>
            </div>
            <div class="row">
              <label class="service_label"><span style="color:#EA5F20">＊</span>聯&nbsp絡&nbsp信&nbsp箱</label>
              <input id="Pemail" class="message"  type="text" name="Pemail"  size="30"/>
              <span style="font-size:12px;colr:#6A3906">（提醒您，客服回信可能會被歸類到垃圾信。）</span> </div>
            <div class="service_underline"></div>
            <div> <span style="color:#EA5F20">＊</span>請詳述問題： </div>
            <textarea style="width:80%;height:200px;margin-top:10px;margin-bottom:10px" name="introduce">
					</textarea>
            <div class="service_underline"></div>
            <div style="font-size:12px">
              <div class="left"> 感謝您！ </div>
              <div class="center"> 若需要客服及時為您處理，請撥：(02)123456，服務時間於每週一至週日，早上九點至晚上六點。 </div>
              <div class="right"> 其他時段，請使用此表單，我們會盡快與您聯繫。 </div>
            </div>
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
else if($_GET['step']=='ask_submit')
{
	//var_dump($_POST);
	include('include/check.php');
	$kind= array
	(
		"1" => "帳戶資料問題",
		"2" => "商城購物問題",
		"3" => "co幣轉換問題",
		"4" => "轉利基數問題",
		"5" => "給利遊戲問題",
		"else" => "其他疑難雜症",
	);
	$error=false;
	if(!checkStr($_POST['Pemail']))
		$error=true;
	if(empty($_POST['kindof'])||empty($_POST['Pname'])||empty($_POST['Pemail'])||empty($_POST['introduce'])||$error)
	{
		header("Location:service.php?step=ask");
		die();
	}
	else
	{
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

		$mail->Subject    = $_POST['Pname'].":".$kind[$_POST['kindof']];

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		//$mail->MsgHTML($body);
		$mail->Body="<body>
		問 題 類 型:".$kind[$_POST['kindof']]."<br>
		如 何 稱 呼:".$_POST['Pname']."<br>
		聯 絡 信 箱:".$_POST['Pemail']."<br>
		詳述問題：".$_POST['introduce']."<br>
		寄送日期:".$time."
		</body>";

		$mail->AddAddress($service_email, $_POST['Bname']);
		$mail->AddAddress($_POST['Pemail'], $_POST['Bname']);
		if($mail->Send())
		{
		
?>
    
    <!--step -->
    <div class="news" style="background-image:url('../images/service/head.png')"> </div>
    <!--step end--> 
    
    <!--text-->
    <div class="left text textservice whitebg corner">
      <div class="service_block" style="padding:2px">
        <div class="service_text" style="padding-left:40px">
          <div class="center">
            <p>感謝您！</p>
            <p>若需要客服及時為您處理，請撥：(02)123456。</p>
            <p>服務時間於每週一至週日，早上九點至晚上六點。</p>
          </div>
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