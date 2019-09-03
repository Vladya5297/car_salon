<?php
session_start();
if (empty($_SESSION['login']) or $_SESSION['login'] == '')
{
    header('Location: index.php');
}

if (isset($_POST['buy_button'])) {
    include ("bd.php");
    $result = mysqli_query($db, "UPDATE orders SET paid = true, color = '$_POST[color]' WHERE user_id='$_SESSION[id]' AND order_id='$_POST[order_id]'");
}
if (isset($_POST['refuse_button'])) {
    include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
    $result = mysqli_query($db, "DELETE FROM orders WHERE user_id='$_SESSION[id]' AND order_id = '$_POST[order_id]'");
}
header("Location: cabinet.php");
?>