<?php
if (isset($_GET["job_id"])) {
    $job_id = $_GET["job_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "park";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM jobs WHERE job_id=$job_id";
    $connection->query($sql);

    header("location: /park/index.php");
    exit;
}
?>