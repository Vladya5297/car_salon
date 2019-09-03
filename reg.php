<?php session_start(); ?>
<?php
function reg_func() {
    if (isset($_POST['login'])) {
        $login = $_POST['login'];
        if ($login == '') {
            unset($login);
        }
    } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        if ($password == '') {
            unset($password);
        }
    }
    if (isset($_POST['password2'])) {
        $password2 = $_POST['password2'];
        if ($password2 == '') {
            unset($password2);
        }
    }
    if (empty($login) or empty($password) or empty($password2)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
        echo ("<p style='position: absolute; left: 0; margin-left: auto; right: 0; margin-right: auto; color: red; text-align: center'>Заполните все поля!</p>");
        return;
    }
    if ($password != '' and $password != $password2) {
        echo ("<p style='position: absolute; left: 0; margin-left: auto; right: 0; margin-right: auto; color: red; text-align: center'>Введённые пароли не совпадают!</p>");
        return;
    }
    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
    // подключаемся к базе
    include("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
    // проверка на существование пользователя с таким же логином
    $result = mysqli_query($db, "SELECT id FROM users WHERE login='$login'");
    $myrow = mysqli_fetch_array($result);
    if (!empty($myrow['id'])) {
        echo ("<p style='font-size: 15px; position: absolute; left: 0; margin-left: auto; right: 0; margin-right: auto; color: red; text-align: center'>Введённый вами логин уже используется</p>");
        return;
    }
    // если такого нет, то сохраняем данные
    $password = hash('sha256', $password);
    $result2 = mysqli_query($db, "INSERT INTO users (login,password) VALUES('$login','$password')");
    // Проверяем, есть ли ошибки
    if ($result2 == 'TRUE') {
        header("Location: index.php");
    } else {
        echo "<p>Повторите регистрацию позже</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Автосалон - Регистрация</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php include("top.php"); ?>

<main>
    <div class="authorization_main_hor">
        <div class="authorization_main_ver">
            <form method="post" class="authorization">
                <p>Логин</p>
                <input type="email" class="form_input" placeholder="example@mail.ru" name="login" size="15"
                       maxlength="50">
                <p>Пароль</p>
                <input type="password" class="form_input" placeholder="Введите ваш пароль" name="password"
                       type="password"
                       size="15"
                       maxlength="15">
                <p>Повторите пароль</p>
                <input type="password" class="form_input" placeholder="Введите ваш пароль" name="password2"
                       type="password"
                       size="15"
                       maxlength="15">
                <br>
                <input type="submit" class="log_button" name="reg_btn1" value="Регистрация">
            </form>

            <?php
            if (isset($_POST['reg_btn1'])) {
                reg_func();
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
</html>