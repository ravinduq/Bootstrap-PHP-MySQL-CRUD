<?php
session_start();
$_SESSION['loggedin'] = false;
session_destroy();
$uname = $_SESSION['user'];
header("Location:../login.php");
?>