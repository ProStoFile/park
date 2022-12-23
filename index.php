<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Парк активного отдыха</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h2>Мероприятия</h2>
        <a class="btn btn-primary" href="/park/activities/create.php" role="button">Добавить</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Стоимость</th>
                    <th>Возрастные ограничения</th>
                    <th>Максимальное количество человек</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "park";

                // Create connection
                $connection = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                
                $sql = "SELECT * FROM activities";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[activity_id]</td>
                    <td>$row[activity_title]</td>
                    <td>$row[price]</td>
                    <td>$row[age_restrictions]</td>
                    <td>$row[max_count_people]</td>
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/park/activities/edit.php?activity_id=$row[activity_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/park/activities/delete.php?activity_id=$row[activity_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
                }

                ?>

            </tbody>
        </table>
    </div>

    <div class="container my-5">
        <h2>Скидки</h2>
        <a class="btn btn-primary" href="/park/discounts/create.php" role="button">Добавить</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Размер скидки (%)</th>
                    <th>Условия для получения</th>
                    <th>Суммируется с другими скидками</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "park";

                // Create connection
                $connection = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                
                $sql = "SELECT * FROM discounts";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[discount_id]</td>
                    <td>$row[discount_value]</td>
                    <td>$row[receive_conditions]</td>
                    <td>$row[is_cumulative]</td>
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/park/discounts/edit.php?discount_id=$row[discount_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/park/discounts/delete.php?discount_id=$row[discount_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
                }

                ?>

            </tbody>
        </table>
    </div>
</body>

</html>