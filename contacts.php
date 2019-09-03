<?php
session_start();
if (empty($_SESSION['login']) or $_SESSION['login'] == '') {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Автосалон - Контакты</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=6261f8da-50cb-4353-83de-ede4b196861a&lang=ru_RU"
            type="text/javascript">
    </script>
    <script src="js/index.js"></script>
</head>

<body>

<?php include("top.php"); ?>

<main>
    <div class="contacts">
        <h2>"Автосалон"</h2>
        <h3 style="color: #FF9700">8 (800) 555-35-35</h3>
        <p style="color: black">г. Москва, ул. Автосалонная, д.1, офис 1337</p>
        <br>
        <p>Техническая поддержка: <span>admin@mail.ru</span></p>
    </div>
    <div id="map" style="margin-bottom: 40px">

    </div>
</main>
<footer>
    <div class="footer_vertical">
        <p>Все права защищены</p>
        <p>2018</p>
    </div>
</footer>

</body>
