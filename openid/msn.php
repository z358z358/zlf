<?php

//ㄎㄎ
var_dump($_REQUEST);
if(!empty($_GET['code']))
{
$URL="https://oauth.live.com/token";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://$URL");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "code=$_GET[code]");
curl_exec ($ch);
curl_close ($ch);
}
else
var_dump($_REQUEST);

?>