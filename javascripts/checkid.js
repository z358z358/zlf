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

function checkid()
{
if($("#id").val()=='') return false;
if($("#id").val().search(/^[a-zA-Z]/))
{
$("#chkid").html('<img src="images/no.png">');  
return false;
}
else if($("#id").val().length>=6&&$("#id").val().length<=12)
{
	var result=false;
	var id=$("#id").val();
	$.ajax
	({
    url: 'include/checkid.php',
    data: {id: id},
    error: function(xhr) {},
	async:false,
    success: function(response) 
		{
		if(response==0)
		{
		result=true;
		//alert(result);
		$('#chkid').html('<img src="images/ok.png">');
		}
		else if(response==1)
		{
		$('#chkid').html('<img src="images/no.png">已被註冊');
		}
		else
		{
		$('#chkid').html('<img src="images/no.png">');
		}
		//alert(r);
		//alert(e);
		

		//$('#chkr').text(response);
		//alert($('#chkr').text());
		//alert(response.toSource());
		}
	})
	

return result;
}
else
{
$("#chkid").html('<img src="images/no.png">');
return false;
}
}

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
function checkrpassword(){

//alert(x.value);
//alert(id);
var rpassword=$('#rpassword').val();
if(rpassword=='')
{
$('#chkrpw').html(''); 
return false;
}

//alert(x.innerHTML);

if($('#password').val()==rpassword)
{
$('#chkrpw').html('<img src="images/ok.png">');  
return true;
}
else $('#chkrpw').html('<img src="images/no.png">'); 
return false;
} 


function checkdate()
{
//$("input#formsubmit").remove();

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
function checkemail() {

if($("#email").val()=='') {$("#chkmail").html('');return false;}
if($("#email").val().search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)==0)
{
$("#chkmail").html('<img src="images/ok.png">');
return true;
}
else
{
$("#chkmail").html('<img src="images/no.png">');  
return false;
}
}


function checkphone() {

   if($("#phone").val()=='') {$("#chkphone").html('');return false;}
   if($("#phone").val().search(/^\d{10}$/))
   {
   $("#chkphone").html('<img src="images/no.png">');
   return false;
   }
   else 
   {
   $("#chkphone").html('<img src="images/ok.png">');
   return true;
   }

}


function checkfixphone() {

   if($("#fixphone").val()=='') 
   {
   $("#chkfixphone").html('');
   return true;
   }
   if($("#fixphone").val().search(/^\d{8,10}$/))
   {
   $("#chkfixphone").html('<img src="images/no.png">');
   return false;
   }
   else 
   {
   $("#chkfixphone").html('<img src="images/ok.png">');
   return true;
   
   }

}

function checkname()
{
	
	if($("#name").val()=='') return false;
	if(!isChinese($("#name").val())||$("#name").val().length<2||$("#name").val().length>6)
	{
	$("#chkname").html('<img src="images/no.png">');
	return false;
	}
	$("#chkname").html('<img src="images/ok.png">');
	return true;

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

if(checkid()&&checksid()&&checkrpassword()&&checkpassword()&&checkdate()&&checkemail()&&checkphone()&&checkname()&&checkaddress()&&checkagree()&&checkfixphone()&&checkcaptcha())
{
//$("#address").val("okkkk");
return true;
}
else
{
//$("#address").val("errr");
//$("#chkr6").html("資料不完全");
return false;
}
}

$(function(){{
$("#form1").submit(function() {
      if (checkall()) {
        //$("span").text("Validated...").show();
		//$("#chkr6").html('<img src="images/ok.png">');
		$("input#formsubmit").before('<p>請稍候</p>');
		$("input#formsubmit").remove();
        return true;
      }
	  else
	  {
      $("#chkr6").html('<img src="images/no.png">').show().fadeOut(4000);
      return false;
	  }
    });
}});

function checkpassword()
{
if($("#password").val()=='') return false;
if($("#password").val().search(/[^a-z^A-Z^0-9]/)==0)
{
$("#chkpw").html('<img src="images/no.png">');  
return false;
}
else if($("#password").val().length>=6&&$("#password").val().length<=12)
{
$("#chkpw").html('<img src="images/ok.png">');
return true;
}
else
{

$("#chkpw").html('<img src="images/no.png">');
return false;
}
}

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

function checkaddress(){
if($("#address").val()==''||$('.addr3-area').val()=='')
	{
	$('#chkaddress').html('');
	return false;
	}
else 
	{
	$('#chkaddress').html('<img src="images/ok.png">');
	return true;
	}
}

