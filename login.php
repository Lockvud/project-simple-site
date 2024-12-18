<?php
error_reporting(-1);
session_start();
require_once './admin/admin.php';

if (isset($_POST['sign'])):
    adminAuth();
    if (!empty($_SESSION['user']) && (($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2))):
        getNameOfRole();
        header('Location: admin.php');
    elseif (!empty($_SESSION['user']) && $_SESSION['user']['role'] == 3):
        echo "Вы не имеете необходимых прав доступа";
        ?>
        <a href="?do=exit">Вернуться</a>
    <?php endif; ?>
<?php endif; ?>
<?php
if (!empty($_GET['do']) && $_GET['do'] == 'exit'):
    unset($_SESSION['user']);
    header('Location: index.php');
endif;

if (isset($_POST['exit'])) {
    header('Location: index.php');
    die;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Вход в админку</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
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

    <h2 style="text-align:center;padding-top:100px">Вход в админ-панель</h2>
    <form action="login.php" method="post">
        <br>
        <div class="form-group" style="display:flex; flex-wrap:wrap; flex-direction:column; align-content:center">
            <input type="text" class="input-text" placeholder="Введите логин" name="login">
            <br>
            <input type="password" class="input-text" placeholder="Введите пароль" name="password">
            <br>
            <button type="submit" class="btn btn-primary" name="sign">Вход</button>
            <br>
            <button type="submit" class="btn btn-primary" name="exit">На главную</button>
        </div>
    </form>
</body>

</html>