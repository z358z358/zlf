<?php
//include('include/session.php');
include('include/w3.html');
$title='躲避遊戲';
include('include/header.php');
?>
<script type="text/javascript" src="javascripts/jquery.tools.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

$(window).resize(function(){  
$("div.flash").height($(window).height());
$("div.flash").width($(window).width());
});  

$("div.flash").flashembed("/flash/rich4.swf<?php if(isset($_SESSION['id'])) echo "?id=".$_SESSION['id']?>");


});
</script>
</header>
<body>
<div class="flash" style="height:700px;width:940px;">

</div>
</body>
</html>