<?
include 'settings.php';

$sql = "SELECT * FROM PROTOCOL_TABLE";
$result = $conn->query($sql);

$conn->close();

function formatCompliance($number)
{
    if ($number == 0) {
        return 'нет';
    }
    return 'да';
}
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

<body>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>№ п/п</th>
                <th>Номер протокола</th>
                <th>Дата выдачи (дд.мм.гг)</th>
                <th>Ответственный (ФИО)</th>
                <th>Соответствие («да», «нет»)</th>
            </tr>
        </thead>
        <tbody>

            <? if ($result->num_rows > 0) { ?>
                <? $count = 0; ?>
                <? while ($row = $result->fetch_assoc()) { ?>
                    <? $count++; ?>
                    <tr>
                        <td>
                            <?= $count ?>
                        </td>
                        <td>
                            <?= $row["protocol_number"] ?>
                        </td>
                        <td>
                            <?= date('d.m.Y', strtotime($row['issue_date'])) ?>
                        </td>
                        <td>
                            <?= $row["emp"] ?>
                        </td>
                        <td>
                            <?= formatCompliance($row["is_compliance"]) ?>
                        </td>
                    </tr>
                <? } ?>
            <? } else { ?>
                <tr>
                    <td colspan='5'>0 результатов</td>
                </tr>
            <? } ?>
        </tbody>
    </table>

    <button class="btn btn-primary" onclick="location.href='add_protocol.php'">Добавить протокол</button>
</body>

</html>