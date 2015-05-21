<?php
session_start(); //顆顆
$message = 0;
if(isset($_GET['word'])&&isset( $_SESSION['turing_string'] ))
{
if($_GET['word']==$_SESSION['turing_string'])
$message = 1;
}	
echo $message;
?>