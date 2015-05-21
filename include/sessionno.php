<?php 
session_start();
if (isset( $_SESSION['id']))
{
header("Location: http://www.zlf168.com/");
die();
}
?>