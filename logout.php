<?php
session_start();
include('function.inc.php');
unset($_SESSION['ACCOUNT_USER_ID']);
unset($_SESSION['ACCOUNT_USER_NAME']);
unset($_SESSION['ACCOUNT_USER_EMAIL']);

redirect('index');
?>
