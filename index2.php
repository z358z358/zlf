<?php
include('include/w3.html');
$title='Go給利：真正夠給力';
include('include/header.php');
?>
<script src="javascripts/jquery.iframe-auto-height.plugin.1.7.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
if (window.location.hash == '#_=_')document.location.href="http://www.zlf168.com/";
</script>

<script type="text/javascript">
	$(document).ready(function() {
	/*if(!$.cookie("zlf")||parseInt($.cookie("zlf"))<1)
	$.cookie("zlf","1",{expires: 365});
	else
	$.cookie("zlf",(parseInt($.cookie("zlf"))+1).toString(),{expires: 365});
	if(!$.cookie("zlf")||parseInt($.cookie("zlf"))<1)
	$.cookie("zlf","1");
	else
	$.cookie("zlf",(parseInt($.cookie("zlf"))+1).toString());*/
	

	
	if(!$.cookie("radio"))
		{
		//$("iframe#radioframe",parent.document.body).attr("src","http://hichannel.hinet.net/player/radio/index.jsp?radio_id="+$.cookie("radio"));
		//$("iframe#radioframe").css("display","none");
		//$("select#radio").val($.cookie("radio"));
		$.cookie("radio","210",{expires: 365});
		
		}
		else if($.cookie("radio"))
		{
		$("iframe#radioframe",parent.document.body).attr("src","http://hichannel.hinet.net/player/radio/index.jsp?radio_id="+$.cookie("radio"));
		//$("iframe#radioframe").css("display","block");
		//$("select#radio").val($.cookie("radio"));
		$.cookie("radio",$.cookie("radio"),{expires: 365});
		}
		
		
	
	
	
	$("#on").click(function(){
	if($("#on").hasClass('on'))
	{
	$("iframe#radioframe",parent.document.body).attr("src","");
	$.cookie("radio",$.cookie("radio"),{expires: 365});
	$("#on").removeClass('on');
	$("#on").addClass('off');
	$("#on").attr("src","images/radio.png");
	}
	else
	{
	$("iframe#radioframe",parent.document.body).attr("src","http://hichannel.hinet.net/player/radio/index.jsp?radio_id="+$.cookie("radio"));
	//$("iframe#radioframe").css("display","block");
	//$("select#radio").val($.cookie("radio"));
	$.cookie("radio",$.cookie("radio"),{expires: 365});
	$("#on").removeClass('off');
	$("#on").addClass('on');
	$("#on").attr("src","images/radio.on.png");
	}
	
	});
	
	/*	$("select#radio").change(function(){ //事件發生
			var val=$(this).val();
			switch(val)
			{
			case "0":
			$("iframe#radioframe",parent.document.body).attr("src","");
			$("iframe#radioframe").css("display","none");
			$.cookie("radio","0",{expires: 365});
			
			break;
			default:
			$("iframe#radioframe",parent.document.body).attr("src","http://hichannel.hinet.net/player/radio/index.jsp?radio_id="+val);
			$("iframe#radioframe").css("display","block");
			$.cookie("radio",val,{expires: 365});
			
			}
			
			});*/
			$('iframe#main').iframeAutoHeight();
		});
		
	/*$(window).unload( function () { 
	if($.cookie("zlf")=="1")
	{
	$.ajax("logout.php");
	}
	$.cookie("zlf",(parseInt($.cookie("zlf"))-1).toString());

	});

	$(window).unload( function () { 
	$.cookie("zlf",(parseInt($.cookie("zlf"))-1).toString(),{expires: 365});
	if($.cookie("zlf")=="0")
	{
	$.ajax
	({
    url: 'logout.php',
    error: function(xhr) {},
    success: function(response) 
		{
		}
	})
	}
	});*/
	
		function change(val)
		{
		$("iframe#radioframe",parent.document.body).attr("src","http://hichannel.hinet.net/player/radio/index.jsp?radio_id="+val);
		$.cookie("radio",val,{expires: 365});
		$("#on").removeClass('off');
		$("#on").addClass('on');
		$("#on").attr("src","images/radio.on.png");
		};
</script>
</head>
<body><script></script><div style="position: relative"><div style="min-height:980px"><iframe src="index.php"  id="main" width="100%"  scrolling="no"  marginwidth="0" marginheight="0" frameborder="0" style="min-height:980px"></iframe></div><map name="planetmap1"><area shape="rect" coords="20,30,85,70" href="javascript:change('210')" /><area shape="rect" coords="86,30,150,70" href="javascript:change('295')" /><area shape="rect" coords="151,30,220,70" href="javascript:change('357')" /><area shape="rect" coords="221,30,300,70" href="javascript:change('321')" /></map><div id="radioDiv" class="absolute" style="left:40%;bottom:0"><div class="floatL"><img style="vertical-align:middle;" src='images/ab/radio.png' usemap="#planetmap1"/><img id="on" class="on" style="vertical-align:middle;" src='images/radio.on.png'/></div><div class="floatR" id="radiodiv" style="width:40px; height:38px; overflow:hidden; position:relative;margin-top:30px"> <iframe src="http://hichannel.hinet.net/player/radio/index.jsp?radio_id=210" height="180" id="radioframe"  style="display:none;position:absolute;top:-150px;left:-20px" scrolling="no"  marginwidth="0" marginheight="0" frameborder="0"></iframe> </div></div></div></body></html>