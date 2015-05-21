<?php 
session_start();
if (!isset( $_SESSION['id']))
{
$url_next=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

header("Location: login.php?next=".$url_next);
die();
}
?>