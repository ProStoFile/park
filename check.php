<?php
$login = filter_var(
    trim($_POST['login']),
FILTER_SANITIZE_STRING
);
$name = filter_var(
    trim($_POST['name']),
FILTER_SANITIZE_STRING
);
$pass = filter_var(
    trim($_POST['pass']),
FILTER_SANITIZE_STRING
);

if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
    echo "Длина логина должна быть не менее 5 символов";
    exit();
} else if (mb_strlen($name) < 3 || mb_strlen($name) > 50) {
    echo "Длина имени должна быть не менее 3 и не более 50 символов";
    exit();
} else if (mb_strlen($pass) < 3 || mb_strlen($pass) > 20) {
    echo "Длина пароля должна быть не менее 3 и не более 20 символов";
    exit();
}

$mysql = new mysqli('localhost', 'root', '', 'park');
$mysql->query("INSERT INTO `users` (`login`, `name`, `pass`)
VALUES('$login', '$name', '$pass')");

$mysql->close();

header("location: /park/index.php");

?>