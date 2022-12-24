<?php
if (isset($_GET["client_id"])) {
    $client_id = $_GET["client_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "park";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM clients WHERE client_id=$client_id;";
    $connection->query($sql);

    header("location: /park/index.php");
    exit;
}
?>