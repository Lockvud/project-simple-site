<?php
session_start();
require_once '../functions/func.php';

$res = getFooter();

if (!empty($_GET['do']) && $_GET['do'] == 'main') {
    if (!empty($_SESSION['user'])) {
        header('Location: ../admin.php');
        die;
    }
}

if (isset($_POST['update_footer'])) {
    setFooter();
    header('Location: footer.php');
    die;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Редактирование футера</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <?php if (!empty($_SESSION['errors'])): ?>
        <dialog open="open" id="closeError" aria-labelledby="heading">
            <h2 id="heading">Ошибка!</h2>
            <p>
                <?php echo $_SESSION['errors'];
                unset($_SESSION['errors']);
                ?>
            </p>
            <button type="button" onclick="window.closeError.close()">
                Закрыть
            </button>
        </dialog>
    <?php endif; ?>

    <?php if (!empty($_SESSION['success'])): ?>
        <dialog open="open" id="closeSuccess" aria-labelledby="heading">
            <h2 id="heading">Успех!</h2>
            <p>
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </p>
            <button type="button" onclick="window.closeSuccess.close()">
                Закрыть
            </button>
        </dialog>
    <?php endif; ?>


    <?php if (!empty($_SESSION['user'])): ?>
        <div style="text-align: center;">
            <h1>Редактирование футера</h1>
            <?php echo "Добрый день: {$_SESSION['user']['login']}.<br>Ваша роль: {$_SESSION['user']['rolename']} " ?>
            <br>
            <a href="?do=main">Вернуться на главную</a>
            <br>
            <?php if (!empty($res)): ?>
                <form action="/admin/footer.php" method="post">
                    <input type="text" name="address" value="<?php echo $res['address'] ?>">
                    <input type="text" name="phone" value="<?php echo $res['phone'] ?>">
                    <input type="text" name="email" value="<?php echo $res['email'] ?>">
                    <button type="submit" value="Сохранить" name="update_footer">Сохранить</button>
                </form>
                <br>
            <?php else:
                $_SESSION['errors'] = 'Ошибка! Нет данных!!!'; ?>
            <?php endif; ?>
        <?php else:
        echo '<h2>У вас нет доступа к этой странице</h2>';
        echo '<a href="/index.php" style="color: black;">На главную</a>';
    endif; ?>
    </div>
</body>


</html>