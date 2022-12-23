<?php
if (isset($_GET["discount_id"])) {
    $discount_id = $_GET["discount_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "park";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM discounts WHERE discount_id=$discount_id";
    $connection->query($sql);

    header("location: /park/index.php");
    exit;
}
?>