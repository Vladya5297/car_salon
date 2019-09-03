<?php
session_start();
if (empty($_SESSION['login']) or $_SESSION['login'] == '') {
    header('Location: index.php');
}
?>
<!-- add_car_func -->
<?php
function add_car_func()
{
    if (isset($_POST['car_name'])) {
        $car_name = $_POST['car_name'];
        $car_name = stripslashes($car_name);
        $car_name = htmlspecialchars($car_name);
        $car_name = trim($car_name);
        if ($car_name == '') {
            unset($car_name);
        }
    } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['car_description'])) {
        $car_description = $_POST['car_description'];
        $car_description = stripslashes($car_description);
        $car_description = htmlspecialchars($car_description);
        $car_description = trim($car_description);
        if ($car_description == '') {
            unset($car_description);
        }
    }
    if (isset($_POST['car_price'])) {
        $car_price = $_POST['car_price'];
        $car_price = stripslashes($car_price);
        $car_price = htmlspecialchars($car_price);
        $car_price = trim($car_price);
        if ($car_price == '') {
            unset($car_price);
        }
    }
    if (empty($car_name) or empty($car_description) or empty($car_price) or empty($_FILES)) {
        echo("<p style='color: red; text-align: center'>Заполните все поля!</p>");
        return;
    }
    include("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь

    $uploaddir = 'uploads/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);


    $result = mysqli_query($db, "SELECT * FROM cars_list WHERE car='$car_name'");
    $myrow = mysqli_fetch_array($result);
    if ($myrow['car'] == $car_name or $myrow['description'] == $car_description) {
        echo("<p style='color: red; text-align: center'>Такой автомобиль уже добавлен</p>");
        return;
    } else {
        mysqli_query($db, "INSERT INTO cars_list (car,description,price,image) VALUES('$car_name','$car_description','$car_price','$uploadfile')");
    }
}

?>
<!-- del_car_func -->
<?php
function del_car_func()
{
    if (isset($_POST['car_id'])) {
        $car_id = $_POST['car_id'];
        if ($car_id == '') {
            unset($car_id);
        }
    }
    if (empty($car_id)) {
        echo("<p style='color: red; text-align: center'>Заполните все поля!</p>");
        return;
    }
    $car_id = stripslashes($car_id);
    $car_id = htmlspecialchars($car_id);
    $car_id = trim($car_id);

    include("bd.php");
    $result = mysqli_query($db, "SELECT * FROM cars_list WHERE id='$car_id'");
    $myrow = mysqli_fetch_array($result);
    if (empty($myrow)) {
        echo("<p style='color: red; text-align: center'>Такого автомобиля не существует</p>");
        return;
    } else {
        mysqli_query($db, "DELETE FROM cars_list WHERE id = '$car_id'");
    }
}

?>
<!-- re_add_car_func -->
<?php
function re_add_car_func()
{
    $car_id_red = $_POST['car_id_red'];

    if (isset($_POST['car_re_name'])) {
        $car_re_name = $_POST['car_re_name'];
        $car_re_name = stripslashes($car_re_name);
        $car_re_name = htmlspecialchars($car_re_name);
        $car_re_name = trim($car_re_name);

    }
    if (isset($_POST['car_re_description'])) {
        $car_re_description = $_POST['car_re_description'];
        $car_re_description = stripslashes($car_re_description);
        $car_re_description = htmlspecialchars($car_re_description);
        $car_re_description = trim($car_re_description);
    }
    if (isset($_POST['car_re_price'])) {
        $car_re_price = $_POST['car_re_price'];
        $car_re_price = stripslashes($car_re_price);
        $car_re_price = htmlspecialchars($car_re_price);
        $car_re_price = trim($car_re_price);
    }

    include("bd.php");
    if ($car_re_name != '') {
        mysqli_query($db, "UPDATE cars_list SET car='$car_re_name' WHERE id='$car_id_red'");
    }
    if ($car_re_description != '') {
        mysqli_query($db, "UPDATE cars_list SET description='$car_re_description' WHERE id='$car_id_red'");
    }
    if ($car_re_price != '') {
        mysqli_query($db, "UPDATE cars_list SET price='$car_re_price' WHERE id='$car_id_red'");
    }
}

?>
<!-- red_car_func -->
<?php
function red_car_func()
{
    if (isset($_POST['car_id_red'])) {
        $car_id_red = $_POST['car_id_red'];
        if ($car_id_red == '') {
            unset($car_id_red);
        }
    }
    if (empty($car_id_red)) {
        echo("<p style='color: red; text-align: center'>Заполните все поля!</p>");
        return;
    }
    $car_id_red = stripslashes($car_id_red);
    $car_id_red = htmlspecialchars($car_id_red);
    $car_id_red = trim($car_id_red);

    include("bd.php");
    $result = mysqli_query($db, "SELECT * FROM cars_list WHERE id='$car_id_red'");
    $myrow = mysqli_fetch_array($result);
    if (empty($myrow)) {
        echo("<p style='color: red; text-align: center'>Такого автомобиля не существует</p>");
        return;
    } else {
        echo <<< HTML
    <form class='cat_form' method='post'>
        <table>
            <tr>
                <td>
                    <input class='catalog_input' name='car_id_red' value='$car_id_red' readonly>
                </td>
                <td>
                    <input class='catalog_input' name='car_re_name' placeholder='Название'>
                </td>
                <td>
                    <input class='catalog_input' name='car_re_description' placeholder='Описание'>
                </td>
                <td>
                    <input class='catalog_input' name='car_re_price' pattern=\"^[ 0-9]+$\" placeholder='Цена'>
                </td>

                <td class='btn_row'>
                    <input type='submit' class='log_button' name='re_add_car' value='Сохранить'>
                </td>
            </tr>

        </table>
    </form>
HTML;
    }
}

?>
<!-- add_order -->
<?php
function add_order()
{
    include("bd.php");
    if ($_SESSION['login'] != "admin@mail.ru") {
        mysqli_query($db, "INSERT INTO orders(user_id, order_id) VALUES('$_SESSION[id]','$_POST[order_id]')");
    }
    echo '<meta http-equiv="refresh" content="0;URL=cabinet.php">';
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Автосалон - Каталог</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php include("top.php"); ?>

<main>
    <?php if ($_SESSION['login'] == 'admin@mail.ru' or $_SESSION['login'] == '123zlodey@mail.ru'): ?>
        <form enctype="multipart/form-data" class="cat_form" method="post">
            <div style="display: flex; flex-direction: column">
                <h3 style="text-align: center">Добавить новый автомобиль</h3>
                <div style="display: flex; flex-direction: row; justify-content: center; align-items: center">
                    <div>
                        <input name="userfile" type="file" accept="image/*">
                    </div>
                    <div style="padding: 0 5px">
                        <input class="catalog_input" name="car_name" placeholder="Название">
                    </div>
                    <div style="padding: 0 5px">
                        <input class="catalog_input" name="car_description" placeholder="Описание">
                    </div>
                    <div style="padding: 0 5px">
                        <input class="catalog_input" name="car_price" pattern="^[ 0-9]+$" placeholder="Стоимость">
                    </div>
                    <div style="padding: 0 5px">
                        <input type="submit" class="log_button" name="add_car" value="Добавить">
                    </div>
                </div>

                <h3 style="text-align: center">Удалить автомобиль</h3>
                <div style="display: flex; flex-direction: row; justify-content: center; align-items: center">
                    <div style="padding: 0 5px">
                        <input class="catalog_input" name="car_id" pattern="^[ 0-9]+$" placeholder="Номер">
                    </div>
                    <div style="padding: 0 5px">
                        <input type="submit" class="log_button" name="del_car" value="Удалить">
                    </div>
                </div>

                <h3 style="text-align: center">Редактировать позицию</h3>
                <div style="display: flex; flex-direction: row; justify-content: center; align-items: center">
                    <div style="padding: 0 5px">
                        <input class="catalog_input" name="car_id_red" pattern="^[ 0-9]+$" placeholder="Номер">
                    </div>
                    <div style="padding: 0 5px">
                        <input type="submit" class="log_button" name="red_car" value="Изменить">
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <?php
    if (isset($_POST['add_car'])) {
        add_car_func();
    } elseif (isset($_POST['del_car'])) {
        del_car_func();
    } elseif (isset($_POST['red_car'])) {
        red_car_func();
    } elseif (isset($_POST['re_add_car'])) {
        re_add_car_func();
    } elseif (isset($_POST['buy_button'])) {
        add_order();
    }
    ?>

    <div class="catalog_main">
        <?php
        include("bd.php");
        $result = mysqli_query($db, "SELECT * FROM cars_list");
        $rows = mysqli_num_rows($result); // количество полученных строк
        echo "<table style='margin-top: 30px' cellspacing='0'><tr>";
        if ($_SESSION['login'] == 'admin@mail.ru') {
            echo "<th class='t_header'> Номер</th >";
        } else {
            echo "<th class='t_header' style='display: none'> Номер</th >";
        }
        echo
        "<th class='t_header'>Фото</th><th class='t_header'>Название</th>
        <th class='t_header'>Описание</th>
        <th class='t_header'>Цена</th>
        <th class='t_header'></th></tr>";
        for ($i = 0; $i < $rows; ++$i) {
            $myrow = mysqli_fetch_array($result);
            echo "<form method='post'>";
            echo "<tr class='border_bottom'>";
            if ($_SESSION['login'] == 'admin@mail.ru') {
                echo("<td><input class='catalog_text' name='order_id' value='$myrow[0]' readonly style='width: 50px'></td>");
            } else {
                echo("<td style='display: none'><input class='catalog_text' name='order_id' value='$myrow[0]' readonly style='width: 50px'></td>");
            }
            echo "<td><img src='$myrow[4]' style='width: 100px; height: 50px; border: 1px solid #808080' alt='image'></td>";
            echo "<td><input class='catalog_text' value='$myrow[1]' readonly style='font-weight: bold'></td>";
            echo "<td><p class='catalog_text_area'>$myrow[2]</p></td>";
            echo "<td><input class='catalog_text' value='$myrow[3]' readonly></td>";
            echo "<td><input type='submit' class='buy_button' name='buy_button' value='Забронировать'></td>";
            echo "</tr>";
            echo "</form>";
        }
        echo "</table>";
        ?>
    </div>
</main>
<footer>
    <div class="footer_vertical">
        <p>Все права защищены</p>
        <p>2018</p>
    </div>
</footer>
</body>

