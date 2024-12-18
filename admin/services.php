<?php
session_start();
require_once '../functions/func.php';

$res = getServices();



if (!empty($_GET['do']) && $_GET['do'] == 'main') {
    if (!empty($_SESSION['user'])) {
        header('Location: ../admin.php');
        die;
    }
}

if (isset($_POST['update_services'])) {
    setServices();
    header('Location: services.php');
    die;
}

if (isset($_POST['add_services'])) {
    addServices();
    header('Location: services.php');
    die;
}

if (isset($_POST['delete_services'])) {
    deleteServices();
    header('Location: services.php');
    die;
}

$num_row = 0;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Редактирование услуг</title>
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
            <h1>Редактирование услуг</h1>
            <?php echo "Добрый день: {$_SESSION['user']['login']}.<br>Ваша роль: {$_SESSION['user']['rolename']} " ?>
            <br>
            <a href="?do=main">Вернуться на главную</a>
            <br>
            <?php if (!empty($res)): ?>
                <?php foreach ($res as $value):
                    $num_row++;
                    ?>
                    <form action="/admin/services.php" method="post" enctype="multipart/form-data">
                        <b><?php echo $num_row . '.' ?></b>
                        <input type="text" name="title" value="<?php echo $value['title'] ?>">
                        <input type="text" name="price" value="<?php echo $value['price'] ?>">
                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">


                        <p>
                            <label for="file-upload" class="custom-file-upload">
                                Загрузить изображение
                                <input type="file" name="filename">
                            </label>
                        </p>

                        <button type="submit" value="Сохранить" name="update_services">Сохранить</button>
                        <button type="submit" value="Сохранить" name="delete_services">Удалить</button>
                    </form>
                    <br>
                    <img src="img/<?php echo $value['filename'] ?>" style="width: 500px" alt="Image" class="img-fluid">
                <?php endforeach ?>
                <br>
                <br>
                <h1>Добавление услуг</h1>

                <form action="/admin/services.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="title" placeholder="Название услуги">
                    <input type="text" name="price" placeholder="Цена услуги">
                    <p>
                        <label for="file-upload" class="custom-file-upload">
                            Загрузить изображение
                            <input type="file" name="filename">
                        </label>
                    </p>

                    <button type="submit" value="Добавить" name="add_services">Добавить услугу</button>

                    <button type="submit" value="Добавить" name="add_field">Добавить поле</button>
                </form>
                    <br>
                    <br>
                    <?php if (!empty($_POST['add_field'])): ?>
                        <form action="/admin/services.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="title" placeholder="Название услуги">
                        <input type="text" name="price" placeholder="Цена услуги">
                            <p>
                                <label for="file-upload" class="custom-file-upload">
                                    Загрузить изображение
                                    <input type="file" name="filename">
                                </label>
                            </p>

                            <button type="submit" value="Добавить" name="add_services">Добавить услугу</button>

                            <button type="submit" value="Добавить" name="add_field">Добавить поле</button>

                            <button type="submit" value="Добавить" name="delete_field">Удалить поле</button>
                        </form>
                    <?php elseif (!empty($_POST['delete_field'])):
                        unset($_POST['add_field']);
                        ?>
                    <?php endif; ?>
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