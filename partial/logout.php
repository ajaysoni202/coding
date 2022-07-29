<?php
session_start();
echo "Logging you out. Please wait";
unset($_SESSION['loggin']);
session_destroy();
header('location:../index.php');
die();
?>