<?php
//tw id  顆顆
function check_twid($id) {
$flag = false;
$id=strtoupper($id);
$d0=strlen($id);
if ($d0 <= 0) {return false;}
if ($d0 > 10) {return false;}
if ($d0 < 10 && $d0 > 0) {return false;}
$d1=substr($id,0,1);
$ds=ord($d1);
if ($ds > 90 || $ds < 65) {return false;}
$d2=substr($id,1,1);
if($d2!="1" && $d2!="2") {return false;}
for ($i=1;$i<10;$i++) {
$d3=substr($id,$i,1);
$ds=ord($d3);
if ($ds > 57 || $ds < 48) {return false;}

}
$num=array("A" => "10","B" => "11","C" => "12","D" => "13","E" => "14",
"F" => "15","G" => "16","H" => "17","J" => "18","K" => "19","L" => "20",
"M" => "21","N" => "22","P" => "23","Q" => "24","R" => "25","S" => "26",
"T" => "27","U" => "28","V" => "29","X" => "30","Y" => "31","W" => "32",
"Z" => "33","I" => "34","O" => "35");
$n1=substr($num[$d1],0,1)+(substr($num[$d1],1,1)*9);
$n2=0;
for ($j=1;$j<9;$j++) {
$d4=substr($id,$j,1);
$n2=$n2+$d4*(9-$j);
}
$n3=$n1+$n2+substr($id,9,1);
if(($n3 % 10)!=0) {return false;}
return true;
}

//checkStr /[=,`\'"#$%\^&\*\+]/
function checkStr($str) {
    $interzis = '/[=,`\'"#$%\^&\*\+]/';
    if(preg_match($interzis, $str)) return false;
    else return true;
  }
  
//check email  
function checkemail($email){
return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// real ip
function realip(){
if (!empty($_SERVER['HTTP_CLIENT_IP']))
    $ip=$_SERVER['HTTP_CLIENT_IP'];
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	else
    $ip=$_SERVER['REMOTE_ADDR'];
	return $ip;
	}
	
//check id
function checkid($id){
if(preg_match("/^[a-zA-Z]/", $id)&&strlen($id)<=12&&strlen($id)>=6)
return true;
else return false;
}

//check phone
function checkphone($phone){
if(preg_match('/^\d+$/',$phone)&&strlen($phone)==10)
return true;
else return false;
}

//check fixphone
function checkfixphone($phone){
if(preg_match('/^\d{8,10}$/',$phone))
return true;
else return false;
}


//check name
function checkname($name){
if(strlen($name)<6||strlen($name)>18)
return false;
$pattern='/[\x{4e00}-\x{9fa5}]/u';
return (preg_match($pattern,$name))? true:false;
}

//check password
function checkpassword($password){
if(preg_match("/^[A-Za-z0-9]+$/", $password)&&strlen($password)<=12&&strlen($password)>=6)
return true;
else return false;
}

//check 銀行代號
function checkbank($bank){
if(preg_match('/^\d+$/',$bank)&&strlen($bank)==3)
return true;
else return false;
}

//check 銀行帳戶
function checkaccount($account){
if(preg_match('/^\d+$/',$account)&&strlen($account)<15&&strlen($account)>6)
return true;
else return false;
}

//check 信用卡
function checkcredit($number) {

  // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
  $number=preg_replace('/\D/', '', $number);
  if(strlen($number)<6)
  return false;
  // Set the string length and parity
  $number_length=strlen($number);
  $parity=$number_length % 2;

  // Loop through each digit and do the maths
  $total=0;
  for ($i=0; $i<$number_length; $i++) {
    $digit=$number[$i];
    // Multiply alternate digits by two
    if ($i % 2 == $parity) {
      $digit*=2;
      // If the sum is two digits, add them together (in effect)
      if ($digit > 9) {
        $digit-=9;
      }
    }
    // Total up the digits
    $total+=$digit;
  }

  // If the total mod 10 equals 0, the number is valid
  return ($total % 10 == 0) ? TRUE : FALSE;

}

?>