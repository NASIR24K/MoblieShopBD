<?php
session_start();
$mid=microtime();
//session_unset(@$_SESSION['myID']);
//session_unset(@$_SESSION['id']);
$_SESSION['myID']=md5($mid);
header("location:home.php");
?>