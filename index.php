<?php session_start(); ?>
<?php
function log_check()
{
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
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
    if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
        echo("<p style='position: absolute; left: 0; margin-left: auto; right: 0; margin-right: auto; color: red; text-align: center'>Заполните все поля!</p>");
        return;
    }
    //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
    // подключаемся к базе
    include("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
    $result = mysqli_query($db, "SELECT * FROM users WHERE login='$login'"); //извлекаем из базы все данные о пользователе с введенным логином
    $myrow = mysqli_fetch_array($result);
    if (empty($myrow['password'])) {
        //если пользователя с введенным логином не существует
        echo("<p style='position: absolute; left: 0; margin-left: auto; right: 0; margin-right: auto; color: red; text-align: center'>Введённый логин или пароль неверны</p>");
        return;
    } else {
        //если существует, то сверяем пароли
        $password = hash('sha256', $password);
        if ($myrow['password'] == $password) {
            //если пароли совпадают, то запускаем пользователю сессию
            $_SESSION['login'] = $myrow['login'];
            $_SESSION['id'] = $myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
            echo '<meta http-equiv="refresh" content="0;URL=main.php">';
        } else {
            //если пароли не сошлись

            echo("<p style='position: absolute; left: 0; margin-left: auto; right: 0; margin-right: auto; color: red; text-align: center'>Введённый логин или пароль неверны</p>");
            return;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Автосалон - Вход</title>
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
                <br>
                <input type="submit" class="log_button" name="log_btn" value="Вход">
                <br>
                <input type="submit" class="log_button" name="reg_btn" value="Регистрация">
            </form>

            <?php
            if (isset($_POST['reg_btn'])) {
                echo '<meta http-equiv="refresh" content="0;URL=reg.php">';
            }
            if (isset($_POST['log_btn'])) {
                log_check();
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
