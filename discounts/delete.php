<?php
if (isset($_GET["activity_id"])) {
    $activity_id = $_GET["activity_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "park";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM activities WHERE activity_id=$activity_id";
    $connection->query($sql);

    header("location: /park/index.php");
    exit;
}
?>