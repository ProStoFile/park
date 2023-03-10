<?php
use FTP\Connection;

$servername = "localhost";
$username = "root";
$password = "";
$database = "park";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$employee_id = "";
$fullname = "";
$age = "";
$position = "";
$favorite_activity = "";
$available_discount = "";
$is_banned = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["employee_id"])) {
        header("location: /park/index.php");
        exit;
    }

    $employee_id = $_GET["employee_id"];

    $sql = "SELECT * FROM employees WHERE employee_id=$employee_id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /park/index.php");
        exit;
    }

    $employee_id = $row["employee_id"];
    $fullname = $row["fullname"];
    $age = $row["age"];
    $position = $row["position"];
    $phone = $row["phone"];
    $email = $row["email"];
} else {

    $employee_id = $_POST["employee_id"];
    $fullname = $_POST["fullname"];
    $age = $_POST["age"];
    $position = $_POST["position"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    do {
        if (
            empty($employee_id) ||
            empty($fullname) ||
            empty($age) ||
            empty($position) ||
            empty($phone) ||
            empty($email)
        ) {
            $errorMessage = "Заполните все поля";
            break;
        }

        if (!(preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email))) {
            $errorMessage = "Некорректный email";
            break;
        }

        $sql = "UPDATE employees " .
            "SET fullname = '$fullname', 
            age = '$age', 
            position = '$position', 
            phone = '$phone',
            email = '$email'" .
            "WHERE employee_id = $employee_id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Успешно обновлено";

        header("location: /park/index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Парк активного отдыха</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Изменить данные</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ФИО</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="fullname" value="<?php echo $fullname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Возраст</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="age" value="<?php echo $age; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Должность</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="position" value="<?php echo $position; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Телефон</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/park/index.php" role="button">Отменить</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>