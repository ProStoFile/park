<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Парк активного отдыха</title>
    <link rel="stylesheet" href="../park/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

</head>

<body>

    <div style="color: white">

        <!-- Form -->

        <?php
        if ($_COOKIE['user'] == ''): ?>
            <div class="container my-5">
                <div class="row">
                    <div class="col text-center">
                        <h1 style="color: black">Форма регистрации</h1>
                        <form action="check.php" method="post">
                            <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"><br>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя"><br>
                            <input type="password" class="form-control" name="pass" id="pass"
                                placeholder="Введите пароль"><br>
                            <button class="btn btn-success" type="submit">Зарегистрироваться</button>
                        </form>
                    </div>
                    <div class="col text-center">
                        <h1 style="color: black">Форма авторизации</h1>
                        <form action="authorization.php" method="post">
                            <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"><br>
                            <input type="password" class="form-control" name="pass" id="pass"
                                placeholder="Введите пароль"><br>
                            <button class="btn btn-success" type="submit">Войти</button>
                        </form>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <!-- Admin -->

        <?php if ($_COOKIE['user'] == 'admin'): ?>

            <div class="container my-5">
                <p style="color: black">Вы вошли в профиль <?= $_COOKIE['user'] ?>. <a href="/park/exit.php">
                        Выйти из профиля</a> </p>
            </div>

            <div class="container my-5">
                <h2 style="color: black">Мероприятия</h2>
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
                <h2 style="color: black">Скидки</h2>
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

            <div class="container my-5">
                <h2 style="color: black">Должности</h2>
                <a class="btn btn-primary" href="/park/jobs/create.php" role="button">Добавить</a>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Наименование должности</th>
                            <th>Обязанности сотрудника</th>
                            <th>Требуемый опыт работы</th>
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

                        $sql = "SELECT * FROM jobs";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $connection->error);
                        }

                        while ($row = $result->fetch_assoc()) {
                            echo "
                    <tr>
                    <td>$row[job_id]</td>
                    <td>$row[job_title]</td>
                    <td>$row[responsibilities]</td>
                    <td>$row[work_experience]</td>
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/park/jobs/edit.php?job_id=$row[job_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/park/jobs/delete.php?job_id=$row[job_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
                        }

                        ?>

                    </tbody>
                </table>
            </div>

            <div class="container my-5">
                <h2 style="color: black">Посетители</h2>
                <a class="btn btn-primary" href="/park/clients/create.php" role="button">Добавить</a>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ФИО</th>
                            <th>Возраст</th>
                            <th>Наличие статуса постоянного клиента</th>
                            <th>Доступные скидки</th>
                            <th>Любимое мероприятие</th>
                            <th>Наличие запрета</th>
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

                        $sql = "SELECT * FROM clients";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $connection->error);
                        }

                        while ($row = $result->fetch_assoc()) {
                            echo "
                    <tr>
                    <td>$row[client_id]</td>
                    <td>$row[fullname]</td>
                    <td>$row[age]</td>
                    <td>$row[is_regular_customer]</td>
                    <td>$row[available_discount]</td>
                    <td>$row[favorite_activity]</td>     
                    <td>$row[is_banned]</td>
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/park/clients/edit.php?client_id=$row[client_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/park/clients/delete.php?client_id=$row[client_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
                        }

                        ?>

                    </tbody>
                </table>
            </div>

            <div class="container my-5">
                <h2 style="color: black">Сотрудники</h2>
                <a class="btn btn-primary" href="/park/employees/create.php" role="button">Добавить</a>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ФИО</th>
                            <th>Возраст</th>
                            <th>Должность</th>
                            <th>Номер телефона</th>
                            <th>Email</th>
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

                        $sql = "SELECT * FROM employees";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $connection->error);
                        }

                        while ($row = $result->fetch_assoc()) {
                            echo "
                    <tr>
                    <td>$row[employee_id]</td>
                    <td>$row[fullname]</td>
                    <td>$row[age]</td>
                    <td>$row[position]</td>
                    <td>$row[phone]</td>
                    <td>$row[email]</td>     
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/park/employees/edit.php?employee_id=$row[employee_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/park/employees/delete.php?employee_id=$row[employee_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
                        }

                        ?>

                    </tbody>
                </table>
            </div>

        <?php endif; ?>
        <!-- User -->

        <?php if ($_COOKIE['user'] == 'username'): ?>

            <div class="container my-5">
                <p style="color: black">Вы вошли в профиль <?= $_COOKIE['user'] ?>. <a href="/park/exit.php">
                        Выйти из профиля</a> </p>
            </div>


            <div class="container my-5">
                <h2 style="color: black">Мероприятия</h2>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Стоимость</th>
                            <th>Возрастные ограничения</th>
                            <th>Максимальное количество человек</th>
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
                    </tr>
                    ";
                        }

                        ?>

                    </tbody>
                </table>
            </div>

            <div class="container my-5">
                <h2 style="color: black">Скидки</h2>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Размер скидки (%)</th>
                            <th>Условия для получения</th>
                            <th>Суммируется с другими скидками</th>
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
                    </tr>
                    ";
                        }

                        ?>

                    </tbody>
                </table>
            </div>

            <div class="container my-5">
                <h2 style="color: black">Посетители</h2>
                <a class="btn btn-primary" href="/park/clients/create.php" role="button">Добавить</a>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ФИО</th>
                            <th>Возраст</th>
                            <th>Наличие статуса постоянного клиента</th>
                            <th>Доступные скидки</th>
                            <th>Любимое мероприятие</th>
                            <th>Наличие запрета</th>
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

                        $sql = "SELECT * FROM clients";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $connection->error);
                        }

                        while ($row = $result->fetch_assoc()) {
                            echo "
                    <tr>
                    <td>$row[client_id]</td>
                    <td>$row[fullname]</td>
                    <td>$row[age]</td>
                    <td>$row[is_regular_customer]</td>
                    <td>$row[available_discount]</td>
                    <td>$row[favorite_activity]</td>     
                    <td>$row[is_banned]</td>
                    <td>
                        <a class='btn btn-primary btn-sm ' href='/park/clients/edit.php?client_id=$row[client_id]'>Изменить</a>
                        <a class='btn btn-danger btn-sm' href='/park/clients/delete.php?client_id=$row[client_id]'>Удалить</a>
                    </td>
                    </tr>
                    ";
                        }

                        ?>

                    </tbody>
                </table>
            </div>

        <?php endif; ?>
    </div>

</body>

</html>