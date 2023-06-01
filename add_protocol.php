<?
include 'settings.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $protocol_number = $_POST["protocol_number"];
    $issue_date = $_POST["issue_date"];
    $emp = $_POST["emp"];
    $is_compliance = $_POST["is_compliance"];

    $sql = "SELECT * FROM PROTOCOL_TABLE WHERE protocol_number = '$protocol_number'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script>alert('Протокол с таким номером уже существует!');</script>";
    } else {
        $sql = "INSERT INTO PROTOCOL_TABLE (protocol_number, issue_date, emp, is_compliance) VALUES ('$protocol_number', '$issue_date', '$emp', '$is_compliance')";
        if ($conn->query($sql) === TRUE) {
            header("Location: protocol.php");
        } else {
            $error = $conn->error;
            echo "<script>alert('Произошла ошибка при сохранении {$error}');</script>";
        }
    }
}

$conn->close();
?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <form method="post" action="<?= $_SERVER["PHP_SELF"]; ?>">
                    <div class="form-group">
                        <label for="protocol_number">Номер протокола:</label>
                        <input type="text" class="form-control" id="protocol_number" name="protocol_number">
                    </div>

                    <div class="form-group">
                        <label for="issue_date">Дата выдачи (дд.мм.гг):</label>
                        <input type="date" class="form-control" id="issue_date" name="issue_date">
                    </div>

                    <div class="form-group">
                        <label for="emp">Ответственный (ФИО):</label>
                        <input type="text" class="form-control" id="emp" name="emp">
                    </div>

                    <div class="form-group">
                        <label for="is_compliance">Соответствие («да», «нет»):</label>
                        <select class="form-control" id="is_compliance" name="is_compliance">
                            <option value="1">да</option>
                            <option value="0">нет</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>