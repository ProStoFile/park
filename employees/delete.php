<?php
if (isset($_GET["employee_id"])) {
    $employee_id = $_GET["employee_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "park";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM employees WHERE employee_id=$employee_id;";
    $connection->query($sql);

    header("location: /park/index.php");
    exit;
}
?>