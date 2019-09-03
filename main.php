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
    <title>Автосалон</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php include("top.php"); ?>

<main>
    <div style="position: relative; font-size: 36px; font-weight: 400; ">
        <div class="motto" style="background-image: url(images/01.jpg);"></div>
        <p style="position: absolute; top: 70px; left: 0; margin-left: auto; right: 0; margin-right: auto; text-align: center; color: white; z-index: 3;">
            Найди свою машину прямо сейчас
        </p>
    </div>

    <h1 style="text-align: center">Лучшие предложения</h1>
    <div class="hot_sells">
        <?php
        include("bd.php");
        $result = mysqli_query($db, "SELECT * FROM cars_list ORDER BY price ASC");
        $rows = mysqli_num_rows($result);
        if ($rows >= 3) $rows = 3;
        for ($i = 0; $i < $rows; ++$i) {
            $row = mysqli_fetch_array($result);
            echo "<div class='hot_sells_item'><table>";
            echo "<tr><td><img src='$row[image]' style='width: 250px; height: 110px'></td></tr>";
            echo "<tr><th>$row[car]</th></tr>";
            echo "<tr><td>Цена: от $row[price]</td></tr>";
            echo "</table></div>";
        }
        echo "</div>";
        ?>
    </div>
    </div>
</main>
<footer>
    <div class="footer_vertical">
        <p>Все права защищены</p>
        <p>2018</p>
    </div>
</footer>
</body>

</html>