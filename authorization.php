<?php
session_start();
$login = filter_var(
    trim($_POST['login']),
FILTER_SANITIZE_STRING
);
$pass = filter_var(
    trim($_POST['pass']),
FILTER_SANITIZE_STRING
);

if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
    echo "Длина логина должна быть не менее 5 символов";
    exit();
} else if (mb_strlen($pass) < 3 || mb_strlen($pass) > 20) {
    echo "Длина пароля должна быть не менее 3 и не более 20 символов";
    exit();
}

$pass = md5($pass . "abcpark"); // create hash of pass

$mysql = new mysqli('localhost', 'root', '', 'park');

$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");

$user = $result->fetch_assoc();
if (count($user) == 0) {
    echo "Пользователь не существует";
    exit();
}

setcookie('user', $user['name'], time() + 120, "/");

$mysql->close();

header("location: /park/index.php");
?>