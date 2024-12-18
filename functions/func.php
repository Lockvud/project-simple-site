<?php
error_reporting(-1);
require_once 'connect.php';
function registration(): bool
{
    global $pdo;
    $res = $pdo->prepare("SELECT COUNT(*) FROM user WHERE login = ?");
    $login = !empty($_POST['login']) ? trim($_POST['login']) : '';
    $password = !empty($_POST['password']) ? trim($_POST['password']) : '';
    $_POST['role'] = '3';
    $role = !empty($_POST['role']) ? $_POST['role'] : '';

    if (empty($_POST['login']) || empty($_POST['password'])) {
        $_SESSION['errors'] = "Поля логин/пароль обязательны!";
        header("Location: ./registration.php");
        return false;
    }

    $res->execute([$login]);

    if ($res->fetchColumn()) {
        $_SESSION['errors'] = 'Данное имя уже используется';
        header("Location: ./registration.php");
        return false;
    }


    $password = password_hash($password, PASSWORD_DEFAULT);
    $res = $pdo->prepare('INSERT INTO user (login, password, role) VALUES (?, ?, ?)');

    if ($res->execute([$login, $password, $role])) {
        $_SESSION['success'] = 'Успешная регистрация';
        header("Location: ./index.php");
        return true;
    } else {
        $_SESSION['errors'] = 'Ошибка регистрации';
        header("Location: ./registration.php");
        return false;
    }


}

function getContacts()
{
    global $pdo;
    $sql = $pdo->prepare("SELECT * FROM contact");
    if ($sql->execute()) {
        $res = $sql->fetch();
        return $res;
    }
}

function getHeader()
{
    global $pdo;
    $main = $pdo->prepare("SELECT * FROM header");
    if ($main->execute()) {
        $res = $main->fetch();
        return $res;
    }
}

function getAbout()
{
    global $pdo;
    $data = $pdo->prepare("SELECT * FROM about");
    if ($data->execute()) {
        $res = $data->fetch();
        return $res;
    }
}

function getServices()
{
    global $pdo;
    $data = $pdo->prepare("SELECT * FROM services");
    if ($data->execute()) {
        $res = $data->fetchAll();
        return $res;
    }
}

function setContact(): bool
{
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    global $pdo;
    $sql = $pdo->prepare("UPDATE contact SET city=?, phone=?, email=?");
    if ($sql->execute([$city, $phone, $email])) {
        $_SESSION['success'] = 'Данные изменены успешно';
        $sql->fetch();
        return true;
    } else {
        $_SESSION['errors'] = 'Ошибка изменения';
        return false;
    }
}

function setAbout(): bool
{
    global $pdo;
    $list = ['.php', '.zip', '.js', '.html'];
    foreach ($list as $item) {
        if (preg_match("/$item$/", $_FILES['filename']['name'])) {
            exit('Расширение файла не подходит');
        }
    }

    if (!empty($_FILES['filename']['tmp_name'])) {
        $type = getimagesize($_FILES['filename']['tmp_name']);
        if ($type && ($type['mime'] == 'image/png' || $type['mime'] == 'image/jpg' || $type['mime'] == 'image/jpeg' || $type['mime'] == 'image/webp')) {
            if ($_FILES['filename']['size'] <= 1024 * 1000) {
                $upload = 'img/' . $_FILES['filename']['name'];

                if (move_uploaded_file($_FILES['filename']['tmp_name'], $upload)) {
                    $_SESSION['success'] = 'Файл загружен';
                } else {
                    $_SESSION['errors'] = 'Ошибка при загрузке';
                }
            } else {
                exit("Размер файла превышен");
            }
        } else {
            exit("тип файла не подходит");
        }
    } else {
        $_SESSION['errors'] = 'Добавьте изображение!!!';
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
    if (!empty($_FILES['filename']['name'])) {
        $filename = $_FILES['filename']['name'];
        $sql = $pdo->prepare("UPDATE about SET title=?, description=?, filename=?");
        if ($sql->execute([$title, $description, $filename])) {
            $_SESSION['success'] = 'Данные изменены успешно';
            $sql->fetch();
            return true;
        } else {
            $_SESSION['errors'] = 'Ошибка изменения';
            return false;
        }
    } else {
        $_SESSION['errors'] = 'Добавьте изображение!!!';
        return false;
    }

}

function setServices(): bool
{

    global $pdo;
    $list = ['.php', '.zip', '.js', '.html'];
    foreach ($list as $item) {
        if (preg_match("/$item$/", $_FILES['filename']['name'])) {
            exit('Расширение файла не подходит');
        }
    }

    if (!empty($_FILES['filename']['tmp_name'])) {
        $type = getimagesize($_FILES['filename']['tmp_name']);
        if ($type && ($type['mime'] == 'image/png' || $type['mime'] == 'image/jpg' || $type['mime'] == 'image/jpeg' || $type['mime'] == 'image/webp')) {
            if ($_FILES['filename']['size'] <= 1024 * 1000) {
                $upload = 'img/' . $_FILES['filename']['name'];

                if (move_uploaded_file($_FILES['filename']['tmp_name'], $upload)) {
                    $_SESSION['success'] = 'Файл загружен';
                } else {
                    $_SESSION['errors'] = 'Ошибка при загрузке';
                }
            } else {
                exit("Размер файла превышен");
            }
        } else {
            exit("тип файла не подходит");
        }
    }

    $title = $_POST['title'];
    $price = $_POST['price'];
    $id = $_POST['id'];

    if (!empty($_FILES['filename']['name'])) {
        $filename = $_FILES['filename']['name'];
        $sql = $pdo->prepare("UPDATE services SET title=?, price=?, filename=? WHERE id = ?");
        if ($sql->execute([$title, $price, $filename, $id])) {
            $_SESSION['success'] = 'Данные изменены успешно';
            $sql->fetchAll();
            return true;
        } else {
            $_SESSION['errors'] = 'Ошибка изменения';
            return false;
        }
    } else {
        $_SESSION['errors'] = 'Добавьте изображение!!!';
        return false;
    }

}

function addServices(): bool
{
    global $pdo;
    $list = ['.php', '.zip', '.js', '.html'];
    foreach ($list as $item) {
        if (preg_match("/$item$/", $_FILES['filename']['name'])) {
            exit('Расширение файла не подходит');
        }
    }

    if (!empty($_FILES['filename']['tmp_name'])) {
        $type = getimagesize($_FILES['filename']['tmp_name']);
        if ($type && ($type['mime'] == 'image/png' || $type['mime'] == 'image/jpg' || $type['mime'] == 'image/jpeg' || $type['mime'] == 'image/webp')) {
            if ($_FILES['filename']['size'] <= 1024 * 1000) {
                $upload = 'img/' . $_FILES['filename']['name'];

                if (move_uploaded_file($_FILES['filename']['tmp_name'], $upload)) {
                    $_SESSION['success'] = 'Файл загружен';
                } else {
                    $_SESSION['errors'] = 'Ошибка при загрузке';
                }
            } else {
                exit("Размер файла превышен");
            }
        } else {
            exit("тип файла не подходит");
        }
    }

    $title = $_POST['title'];
    $price = $_POST['price'];

    if (!empty($_FILES['filename']['name'])) {
        $filename = $_FILES['filename']['name'];
        $res = $pdo->prepare('INSERT INTO services (title, price, filename) VALUES (?, ?, ?)');
        if ($res->execute([$title, $price, $filename])) {
            $_SESSION['success'] = 'Данные добавлены успешно';
            header("Location: ./index.php");
            return true;
        } else {
            $_SESSION['errors'] = 'Ошибка добавления';
            header("Location: ./registration.php");
            return false;
        }
    } else {
        $_SESSION['errors'] = 'Добавьте изображение!!!';
        return false;
    }
}

function deleteServices(): bool
{
    global $pdo;
    $id = $_POST['id'];

    $sql = $pdo->prepare("DELETE FROM services WHERE id = ?");
    if ($sql->execute([$id])) {
        $_SESSION['success'] = 'Данные удалены успешно';
        $sql->fetchAll();
        return true;
    } else {
        $_SESSION['errors'] = 'Ошибка удаления';
        return false;
    }
}

function getFooter()
{
    global $pdo;
    $data = $pdo->prepare("SELECT * FROM footer");
    if ($data->execute()) {
        $res = $data->fetch();
        return $res;
    }
}

function setHeader(): bool
{

    global $pdo;
    $list = ['.php', '.zip', '.js', '.html'];
    foreach ($list as $item) {
        if (preg_match("/$item$/", $_FILES['filename']['name'])) {
            exit('Расширение файла не подходит');
        }
    }

    if (!empty($_FILES['filename']['tmp_name'])) {
        $type = getimagesize($_FILES['filename']['tmp_name']);
        if ($type && ($type['mime'] == 'image/png' || $type['mime'] == 'image/jpg' || $type['mime'] == 'image/jpeg' || $type['mime'] == 'image/webp')) {
            if ($_FILES['filename']['size'] <= 1024 * 1000) {
                $upload = 'img/' . $_FILES['filename']['name'];

                if (move_uploaded_file($_FILES['filename']['tmp_name'], $upload)) {
                    $_SESSION['success'] = 'Файл загружен';
                } else {
                    $_SESSION['errors'] = 'Ошибка при загрузке';
                }
            } else {
                exit("Размер файла превышен");
            }
        } else {
            exit("тип файла не подходит");
        }
    }

    $name = $_POST['name'];


    if (!empty($_FILES['filename']['name'])) {
        $filename = $_FILES['filename']['name'];
        $sql = $pdo->prepare("UPDATE header SET name=?, filename=?");
        if ($sql->execute([$name, $filename])) {
            $_SESSION['success'] = 'Данные изменены успешно';
            $sql->fetchAll();
            return true;
        } else {
            $_SESSION['errors'] = 'Ошибка изменения';
            return false;
        }
    } else {
        $_SESSION['errors'] = 'Добавьте изображение!!!';
        return false;
    }

}

function setFooter(): bool
{

    global $pdo;

    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $sql = $pdo->prepare("UPDATE footer SET address=?, phone=?, email=?");
    if ($sql->execute([$address, $phone, $email])) {
        $_SESSION['success'] = 'Данные изменены успешно';
        $sql->fetch();
        return true;
    } else {
        $_SESSION['errors'] = 'Ошибка изменения';
        return false;
    }
}
?>