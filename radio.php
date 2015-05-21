<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>i Love Asia Fm ♥ 亞洲廣播網 ♥ www.asiafm.com.tw</title>
<script type="text/javascript" src="javascripts/jquery.cookie.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	if($.cookie("radio")=="0")
		{
		$("iframe#radioframe",parent.document.body).attr("src","");
		$("iframe#radioframe").css("display","none");
		$("select#radio").val($.cookie("radio"));
		$.cookie("radio","0");
		}
		else if($.cookie("radio"))
		{
		$("iframe#radioframe",parent.document.body).attr("src","http://hichannel.hinet.net/player/radio/index.jsp?radio_id="+$.cookie("radio"));
		$("iframe#radioframe").css("display","block");
		$("select#radio").val($.cookie("radio"));
		$.cookie("radio",val);
		}
		
		$("select#radio").change(function(){ //事件發生
			var val=$(this).val();
			switch(val)
			{
			case "0":
			$("iframe#radioframe",parent.document.body).attr("src","");
			$("iframe#radioframe").css("display","none");
			$.cookie("radio","0");
			break;
			default:
			$("iframe#radioframe",parent.document.body).attr("src","http://hichannel.hinet.net/player/radio/index.jsp?radio_id="+val);
			$("iframe#radioframe").css("display","block");
			$.cookie("radio",val);
			}
			
			});
		});
</script>
</head>
<body>
<div class="floatL">
			<select id="radio"><option value="210">亞洲電台</option><option value="0">關閉</option></select>
			</div>
			
			<div id="radiodiv" style="width:140px; height:38px; overflow:hidden; position:relative"> 
			<iframe src="http://hichannel.hinet.net/player/radio/index.jsp?radio_id=210"   height="180"  id="radioframe" style="position:absolute;top:-150px;left:-20px" scrolling="no"  marginwidth="0" marginheight="0" frameborder="0"></iframe> 
			</div>
</body>
</html>