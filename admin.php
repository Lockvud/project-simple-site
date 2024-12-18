<?php
session_start();

if (!empty($_GET['do']) && $_GET['do'] == 'exit') {
    if (!empty($_SESSION['user'])) {
        unset($_SESSION['user']);
        header('Location: index.php');
        die;
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Админка</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <?php if (!empty($_SESSION['user'])): ?>
        <div style="text-align: center;">
            <?php echo "Добрый день: {$_SESSION['user']['login']}.<br>Ваша роль: {$_SESSION['user']['rolename']} " ?>
            <br>
            <a href="?do=exit">Выйти</a>
            
            <a href="/admin/contact.php">Контакты</a>
            <a href="/admin/header.php">Заголовок</a>
            <a href="/admin/services.php">Услуги</a>
            <a href="/admin/about.php">О нас</a>
            <a href="/admin/footer.php">Футер</a>

        <?php else:
        echo '<h2>У вас нет доступа к этой странице</h2>';
        echo  '<a href="/index.php" style="color: black;">На главную</a>';
        endif; ?>
    </div>
</body>


</html>