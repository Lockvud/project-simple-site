<?php
error_reporting(-1);
session_start();
require_once './functions/connect.php';
require_once './functions/func.php';


if (isset($_POST['register'])) {
    registration();
    die;
}

if (isset($_POST['exit'])) {
    header('Location: index.php');
    die;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
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
                        <h2 id="heading">Действие выполнено успешно!</h2>
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

    <h2 style="text-align:center;padding-top:100px">Регистрация</h2>
    <form action="registration.php" method="post">
        <br>
        <div class="form-group" style="display:flex; flex-wrap:wrap; flex-direction:column; align-content:center">




            <input type="text" class="input-text" placeholder="Введите логин" name="login">
            <br>
            <input type="password" class="input-text" placeholder="Введите пароль" name="password">
            <br>
            <input type="hidden" class="input-text" name="role">
            <button type="submit" class="btn btn-primary" name="register">Регистрация</button>
            <br>
            <button type="submit" class="btn btn-primary" name="exit">На главную</button>
        </div>
    </form>
</body>

</html>