<?php
error_reporting(-1);
require_once './functions/connect.php';

function adminAuth(): bool
{
    global $pdo;
    $login = !empty($_POST['login']) ? trim($_POST['login']) : '';
    $password = !empty($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($login) || empty($password)) {
        $_SESSION['errors'] = 'Поля логин/пароль обязательны';
        return false;
    }

    $res = $pdo->prepare("SELECT * FROM user WHERE login=?");
    $res->execute([$login]);
    if (!$user = $res->fetch()) {
        $_SESSION['errors'] = 'Логин/пароль введены неверно';
        return false;
    }

    if (!password_verify($password, $user['password'])) {
        $_SESSION['errors'] = 'Логин/пароль введены неверно';
        return false;
    } else {
        $_SESSION['success'] = 'Вы успешно вошли';
        $_SESSION['user']['login'] = $user['login'];
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['role'] = $user['role'];
        return true;
    }
}

function getNameOfRole(): bool
{
    global $pdo;
    $res = $pdo->query("SELECT bez_role.name, user.role FROM bez_role JOIN user ON bez_role.id_role = user.role AND bez_role.id_role = {$_SESSION['user']['role']}");
    if (!$user = $res->fetch()) {
        $_SESSION['user']['rolename'] = 'Ошибка';
        return false;
    } else {
        $_SESSION['user']['rolename'] = $user['name'];
        return true;
    }

}