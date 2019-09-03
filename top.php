<header>
<div class="navbar">
    <div class="header_items ">
        <a href="main.php">Главная</a>
    </div>
    <div class="header_items ">
        <a href="catalog.php">Каталог</a>
    </div>
    <div class="header_items ">
        <a href="cabinet.php">Личный кабинет</a>
    </div>
    <div class="header_items ">
        <a href="contacts.php">Контакты</a>
    </div>
    <?php if (!empty($_SESSION['login'])): ?>
        <form class='header_items' method='post' action='exit.php'>
            <input type='submit' name='exit' value='Выйти'>
        </form>
    <?php endif; ?>
</div>

<div class="header_main">
    <div class="logo">
        <img alt="Автосалон" src="images/logotype.png">
    </div>
    <div class="cabinet_access">

    </div>
    <div class="contacts">
        <p style="text-align: center;">Москва, ул. Автосалонная, д.1, офис</p>
        <p style="font-size:22px; font-weight: bold; text-align: center;">8 (800) 555-35-35</p>
    </div>
</div>
</header>