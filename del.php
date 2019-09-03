<?php
session_start();
if (empty($_SESSION['login']) or $_SESSION['login'] == '')
{
    header('Location: index.php');
}
include("bd.php");
$result = mysqli_query($db, "SELECT * FROM users WHERE id='$_POST[user_id]'");
$myrow = mysqli_fetch_array($result);
if (empty($myrow)) {
    header("Location: cabinet.php");
} else {
    mysqli_query($db, "DELETE FROM users WHERE id = '$_POST[user_id]'");
    header("Location: cabinet.php");
}