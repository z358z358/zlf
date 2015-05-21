$(function(){{
$("#form1").submit(function() {
      if (checkall()) {
		$("input#formsubmit").before('<p>請稍候</p>');
		$("input#formsubmit").remove();
        return true;
      }
	  else
	  {
      $("input#formsubmit").after('<p>*為必填項目</p>');
      return false;
	  }
    });
}});

function checkall()
{

	if(checkBRN()&&checkBname()&&checkBphone()&&checkaddress()&&checkPname()&&checkPphone()&&checkPemail())
	{
		return true;
	}
	else
	{
		return false;
	}
}

function checkBRN()
{
	if($('#BRN').val()=='')
	return false;
	else
	return true;
} 

function checkBname()
{
	if($('#Bname').val()=='')
	return false;
	else
	return true;
}

function checkBphone()
{
	if($('#Bphone').val()=='')
	return false;
	else
	return true;
}

function checkaddress()
{
	if($('#address').val()=='')
	return false;
	else
	return true;
}

function checkPname()
{
	if($('#Pname').val()=='')
	return false;
	else
	return true;
}

function checkPphone()
{
	if($('#Pphone').val()=='')
	return false;
	else
	return true;
}

function checkPemail()
{
	if($('#Pemail').val()=='')
	return false;
	if($("#Pemail").val().search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)==0)
	return true;
	else
	{
	$("input#formsubmit").after('<p>email格式錯誤</p>');
	return false;
	}
}