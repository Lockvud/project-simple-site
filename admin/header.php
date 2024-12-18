<?php
session_start();
require_once '../functions/func.php';

$res = getHeader();

if (!empty($_GET['do']) && $_GET['do'] == 'main') {
    if (!empty($_SESSION['user'])) {
        header('Location: ../admin.php');
        die;
    }
}

if (isset($_POST['update_header'])) {
    setHeader();
    header('Location: header.php');
    die;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Редактирование заголовка</title>
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
            <h1>Редактирование заголовка</h1>
            <?php echo "Добрый день: {$_SESSION['user']['login']}.<br>Ваша роль: {$_SESSION['user']['rolename']} " ?>
            <br>
            <a href="?do=main">Вернуться на главную</a>
            <br>
            <?php if (!empty($res)): ?>
                <form action="/admin/header.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="name" value="<?php echo $res['name'] ?>">

                    <p>
                        <label for="file-upload" class="custom-file-upload">
                            Загрузить изображение
                            <input type="file" name="filename">
                        </label>
                    </p>

                    <button type="submit" value="Сохранить" name="update_header">Сохранить</button>
                </form>
                <br>
                <img src="img/<?php echo $res['filename'] ?>" style="width: 500px" alt="Image" class="img-fluid">
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