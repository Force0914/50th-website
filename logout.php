<?php 
session_start();

session_unset();
session_destroy();
$_SESSION['msg'] = "";

header("Location: index.php");