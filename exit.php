<?php
setcookie('user', $user['name'], time() - 120, "/");
unset($_COOKIE['name']);
header("location: /park/index.php");

?>