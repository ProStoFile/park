<?php
setcookie('user', $user['name'], time() - 3600, "/");
unset($_COOKIE['name']);
header("location: /park/index.php");

?>