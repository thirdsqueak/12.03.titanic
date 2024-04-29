//12.03.2024
<?php

// Загрузка данных
$data = array_map('str_getcsv', file('titanic.csv'));
next($data); // Skip header

// Функция для поиска по возрасту
function searchByAge($age) {
    global $data;
    $results = array();
    foreach ($data as $row) {
        if (isset($row[4]) && $row[4] != '' && $row[4] == $age) {
            $results[] = $row;
        }
    }
    return $results;
}

// Функция для поиска по имени
function searchByName($name) {
    global $data;
    $results = array();
    foreach ($data as $row) {
        if (isset($row[2]) && preg_match('/' . $name . '/i', $row[2])) {
            $results[] = $row;
        }
    }
    return $results;
}

// Обработка запроса
$age = (int) filter_input(INPUT_POST, 'age');
$name = filter_input(INPUT_POST, 'name');

$ageResults = searchByAge($age);
$nameResults = searchByName($name);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты поиска пассажиров Титаника</title>
</head>
<body>
    <h1>Результаты поиска</h1>
    <h2>Поиск по возрасту (<?php echo $age; ?>):</h2>
    <ul>
        <?php foreach ($ageResults as $row): ?>
            <li><?php echo $row[2]; ?> (<?php echo $row[4]; ?>)</li>
        <?php endforeach; ?>
    </ul>
    <h2>Поиск по имени (<?php echo $name; ?>):</h2>
    <ul>
        <?php foreach ($nameResults as $row): ?>
            <li><?php echo $row[2]; ?> (<?php echo $row[4]; ?>)</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>