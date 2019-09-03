<?php
session_start();
if (empty($_SESSION['login']) or $_SESSION['login'] == '') {
    header('Location: index.php');
}
?>

<?php
function show_order()
{
    include("bd.php");
    $get_order_id = mysqli_query($db, "SELECT * FROM orders WHERE user_id = '$_SESSION[id]'");
    $rows = mysqli_num_rows($get_order_id);
    if (empty($rows) or $rows == 0) {
        echo("<p style='font-weight: bold; font-size: 20px; color: grey; margin: 0'>Заказов нет</p>");
        return;
    }
    echo <<< HTML
<div style='margin-top: 30px; display: flex; flex-direction: column'><div style="display: flex; flex-direction: row">
<div style='width: 70px; text-align: center; background-color: #840000;
    color: white; padding: 10px 0; display: none'>Номер</div>
<div style='width: 150px; text-align: center; background-color: #840000;
    color: white; padding: 10px 0'>Название</div>
<div style='width: 300px; text-align: center; background-color: #840000;
    color: white; padding: 10px 0'>Описание</div>
<div style='width: 160px; text-align: center; background-color: #840000;
    color: white; padding: 10px 0'>Цвет</div>
<div style='width: 130px; text-align: center; background-color: #840000;
    color: white; padding: 10px 0'>Забронировать</div>
<div style='width: 110px; text-align: center; background-color: #840000;
    color: white; padding: 10px 0'>Отменить</div></div>
HTML;
    for ($i = 0; $i < $rows; $i++) {
        $new_order = mysqli_fetch_array($get_order_id);
        $result = mysqli_query($db, "SELECT * FROM cars_list WHERE id = '$new_order[order_id]'");
        $result = mysqli_fetch_array($result);
        echo <<< HTML
                <form method='post' action='buy.php' class='border_bottom' style="display: flex; flex-direction: row">
                <div style='width: 70px; display: none; align-items: center'><input class='catalog_text' style='width: 50px; padding: 0' name='order_id' value=$result[0] readonly ></div>
                <div style='width: 150px; display: flex; align-items: center'><input class='catalog_text' style='width: 150px; padding: 0; font-weight: bold' value=$result[1] readonly style='font-weight: bold'></div>
                <div><p class='catalog_text_area'>$result[2]</p></div>
HTML;
        if (empty($new_order['paid'])) {
            echo("<div class='catalog_text' style='width: 160px; padding: 0; display: flex; align-items: center; justify-content: center'>
<select style='padding: 5px' name='color'>
<option>Чёрный</option>
<option>Белый</option>
<option>Серебрстый</option>
<option>Красный</option>
<option>Синий</option>
</select>
</div>");
            echo "<div class='catalog_text' style='width: 130px; padding: 0; display: flex; align-items: center; justify-content: center'><input type='submit' class='buy_button' name='buy_button' value='Забронировать'></div>";
            echo "<div class='catalog_text' style='width: 110px; padding: 0; display: flex; align-items: center; justify-content: center'><input type='submit' class='refuse_button' name='refuse_button' value='Отказаться'></div>";
        } else {
            echo "<div class='catalog_text' style='width: 160px; padding: 0; display: flex; align-items: center; justify-content: center'><p style='padding: 0 20px;'>$new_order[color]</p></div>";
            echo "<div class='catalog_text' style='width: 130px; padding: 0; display: flex; align-items: center; justify-content: center'><p style='padding: 0 5px;'>Забронировано</p></div>";
            echo "<div class='catalog_text' style='width: 110px; padding: 0; display: flex; align-items: center; justify-content: center'><input type='submit' class='refuse_button' name='refuse_button' value='Удалить'></div>";
        }
        echo "</form>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Автосалон - Личный кабинет</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php include("top.php"); ?>

<main>
    <div class="orders">
        <div style="display: flex; flex-direction: column">
            <?php if ($_SESSION['login'] == 'admin@mail.ru') {
                echo <<< HTML
                <h2 style="text-align: center; margin: 0;">Удалить пользователя</h2>
                <div style="display: flex; flex-direction: column; align-items: center; margin: 20px 0">
                    <table>
                        <form class="cat_form" method="post" action="del.php">
                            <tr>
                                <td>
                                    <input style="margin-right: 10px" class="catalog_input" name="user_id"
                                           pattern="^[ 0-9]+$"
                                           placeholder="id">
                                </td>
                                <td><input style="padding: 18px; margin: 0" type="submit" class="log_button btn_row"
                                           name="submit" value="Удалить"></td>
                            </tr>

                        </form>
                    </table>
<h2 style="text-align: center; margin-top: 10px; margin-bottom: 0">Отчёт по заказам</h2>
                </div>
HTML;
                include("bd.php");
                $result = mysqli_query($db, "SELECT * FROM users");
                $rows = mysqli_num_rows($result);
                echo "<table cellspacing='0' style='text-align: center'>
<tr><th class='t_header'>id Пользователя</th>
<th class='t_header'>Логин</th>
<th class='t_header'>Номер в каталоге</th>
<th class='t_header' style='padding: 0 20px'>Название</th>
<th class='t_header' style='padding: 0 20px'>Цвет</th>
</tr>";
                for ($i = 0; $i < $rows; ++$i) {
                    $row = mysqli_fetch_array($result);
                    $get_order_id = mysqli_query($db, "SELECT * FROM orders WHERE user_id = '$row[id]' AND paid = 1");
                    $car_rows = mysqli_num_rows($get_order_id);
                    if ($car_rows < 2) echo "<tr class='border_bottom'>";
                    else echo "<tr>";
                    echo "<td>$row[0]</td>";
                    echo "<td>$row[1]</td>";
                    if ($car_rows == 0) echo "<td></td><td></td><td></td>";
                    for ($j = 0; $j < $car_rows; ++$j) {
                        $car_row = mysqli_fetch_array($get_order_id);
                        $car_name = mysqli_query($db, "SELECT car FROM cars_list WHERE id = '$car_row[order_id]'");
                        $car_name = mysqli_fetch_array($car_name);
                        if ($j == $car_rows - 1 and $car_rows != 1) echo "</tr><tr class='border_bottom'><td></td><td></td>";
                        elseif ($j > 0) echo "</tr><tr><td></td><td></td>";
                        echo "<td>$car_row[order_id]</td><td>$car_name[0]</td><td>$car_row[color]</td></tr>";
                    }
                }
                echo "</table>";
            }

            ?>


            <?php
            if ($_SESSION['login'] != 'admin@mail.ru') {
                show_order();
            }
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
