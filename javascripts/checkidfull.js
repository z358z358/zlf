/*
function createXHR(){ 
if (window.XMLHttpRequest) { 
xmlHttp = new XMLHttpRequest(); 
}else if (window.ActiveXObject) { 
xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); 
} 

if (!xmlHttp) { 
alert('您使用的瀏覽器不支援 XMLHTTP 物件'); 
return false; 
} 
} 

function sendRequest(){ 
$(function(){{
var id=$('#sid').val();
if(id=='')
{
document.getElementById('chkr').innerHTML=''; 
return false;
}
else
{
createXHR(); 
var url='check_id.php?id='+id; 
window.status='Checking customer ID...'; 
xmlHttp.open('GET',url,true); 
//xmlHttp.onreadystatechange=catchResult; 
//xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
if (xmlHttp.readyState==4){ 
var s=xmlHttp.responseText; 
if (xmlHttp.status == 200) { 
if (s==1){ 
document.getElementById('chkr').innerHTML='已被註冊'; 
return false;
}else if(s==0){ 
document.getElementById('chkr').innerHTML='可以用'; 
return true;
}
else if(s==2){ 
document.getElementById('chkr').innerHTML='不是身分證字號';
return false; 
} 
} 
} 
xmlHttp.send(null); 
}

}});
} 
*/



function checksid()
{
var result=false;
var id=$('#sid').val();
if(id=='')
{
$('#chksid').html('');
return false;
}
else if($('#sid').val().search(/^[A-Z^a-z]\d{9}$/))
{
$('#chksid').html('<img src="images/no.png">');
}
else
{
$.ajax
	({
    url: 'include/checksid.php',
    data: {id: id},
    error: function(xhr) {},
	async:false,
    success: function(response) 
		{
		if(response==0)
		{
		result=true;
		//alert(result);
		$('#chksid').html('<img src="images/ok.png">');
		}
		else if(response==1)
		{
		$('#chksid').html('<img src="images/no.png">已被註冊');
		}
		else
		{
		$('#chksid').html('<img src="images/no.png">');
		}
		//alert(r);
		//alert(e);
		

		//$('#chkr').text(response);
		//alert($('#chkr').text());
		//alert(response.toSource());
		}
	})
}
//alert(output);
/*
if (output=='可以使用')
	{
	$('#chkr2').html('true');
	return true;
	}
	else 
	{
	$('#chkr2').html('false');
	return false;
	}
*/
//alert(result);
return result;
}
/*
function catchResult(){ 
if (xmlHttp.readyState==4){ 
s=xmlHttp.responseText; 
if (xmlHttp.status == 200) { 
if (s==1){ 
document.getElementById('chkr').innerHTML='已被註冊'; 
}else if(s==0){ 
document.getElementById('chkr').innerHTML='可以用'; 
}
else if(s==2){ 
document.getElementById('chkr').innerHTML='不是身分證字號'; 
} 
} 
} 
} 
*/

function checkdate()
{
    var year=$('#year').val();
	var month=$('#month').val();
	var day=$('#day').val();
	//$("#chkr4").html(year+"/"+month+"/"+day);
	if(!day||!year||!month)
	{
	//$("#chkr3").html("尚未填寫完畢"+year+"/"+month+"/"+day);
	return false;
	}
	month--;
	var test=new Date(year,month,day);
	//$("#chkr5").html(test.getFullYear()+"/"+test.getMonth()+"/"+test.getDate());
	if((test.getFullYear() == year)&&(month == test.getMonth())&&(day == test.getDate()))
    {
		if(test>(new Date()))
		$("#chkdate").html('<img src="images/no.png">');	
		else if((((new Date()).getFullYear())-test.getFullYear())>150)
		{
		$("#chkdate").html('<img src="images/no.png">');
		}
		else
		{		
		$("#chkdate").html('<img src="images/ok.png">');
		return true;
		}
	}
	else $("#chkdate").html('<img src="images/no.png">')
	
return false;   
  
}
/*(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)*/

function checkname()
{
	
	if($("#name").val()=='') return false;
	if(isChinese($("#name").val())&&$("#name").val().length>1&&$("#name").val().length<7)
	{
	$("#chkname").html('<img src="images/ok.png">');
	return true;
	}
	else
	{
	$("#chkname").html('<img src="images/no.png">');
	return false;
	}

}

function isChinese(a){
  for(var i=0;i<a.length;i++){  
      if(a.charCodeAt(i) < 0xA0)  
          return false;
  }
  return true;
}

function checkall()
{

if(checksid()&&checkdate()&&checkemail()&&checkname()&&checkagree()&&checkcaptcha())
{
//$("#address").val("okkkk");
return true;
}
//$("#address").val("errr");
//$("#chkr6").html("資料不完全");
return false;


}

$(document).ready(function() {
$("#form1").submit(function() {
      if (checkall()) {
        //$("span").text("Validated...").show();
		//$("#chkr6").html('<img src="images/ok.png">');
        
      }
	  else
	  {
      $("#chkr6").html('<img src="images/no.png">').show().fadeOut(4000);
      return false;
	  }
var ext = $('#Faccount').val().split('.').pop().toLowerCase();
var ext2 = $('#Fcredit').val().split('.').pop().toLowerCase();
var f=true;


if(($('#Faccount').val()!=''&&$.inArray(ext, ['gif','png','jpg','jpeg']) == -1)||($('#Fcredit').val()!=''&&$.inArray(ext2, ['gif','png','jpg','jpeg']) == -1)) {
    alert('只允許上傳圖片( gif , png , jpg , jpeg )');
	f=false;
}

var a=false;
if(($('#account').val()!=''&&$('#bank').val()!='')||$('#credit').val()!='')
a=true;

return flagsize&&f&&a;
	  
	  
	  
	  
    });
});


function checkcaptcha()
{
var result=false;
var id=$('#word').val();
if(id=='')
{
$('#chkcaptcha').html('');
return false;
}
else if($('#word').val().length!=4)
{
$('#chkcaptcha').html('<img src="images/no.png">');
}
else
{
$.ajax
	({
    url: 'include/captcha.php',
    data: {word: id},
    error: function(xhr) {},
	async:false,
    success: function(response) 
		{
		if(response==1)
		{
		result=true;
		//alert(result);
		$('#chkcaptcha').html('<img src="images/ok.png">');
		}
		else
		{
		$('#chkcaptcha').html('<img src="images/no.png">');
		}
		//alert(r);
		//alert(e);
		

		//$('#chkr').text(response);
		//alert($('#chkr').text());
		//alert(response.toSource());
		}
	})
}
//alert(output);
/*
if (output=='可以使用')
	{
	$('#chkr2').html('true');
	return true;
	}
	else 
	{
	$('#chkr2').html('false');
	return false;
	}
*/
//alert(result);
return result;
}

/*
$(function(){{
$("input[type='password']").width($("input[type='text']").width());

}});*/

function checkagree(){
if ( $("#agree").attr('checked') ) 
{
$('#chkagree').html('<img src="images/ok.png">');
return true;
}
else 
{
$('#chkagree').html('<img src="images/no.png">');
return false;
}
}
