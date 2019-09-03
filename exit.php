<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['id']);
unset($_SESSION['paid']);
unset($_SESSION['date']);
session_unset();
header('Location: index.php');
?>