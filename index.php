<?php
// Параметры подключения к базе данных
$servername = "mysqlXX.alwaysdata.net";  // Замените на актуальный хост
$username = "your_db_username";          // Имя пользователя базы данных
$password = "your_db_password";          // Ваш пароль
$dbname = "firecoinbase_bd";             // Имя базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    $db_status = "Не подключена";
} else {
    $db_status = "Подключена";
}

// Закрытие соединения
$conn->close();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мини-игра</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            background-color: #f0f0f0;
        }
        h1 {
            font-size: 2em;
            color: #333;
        }
        .status {
            margin-top: 20px;
            font-size: 1.5em;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Мини-игра</h1>
    <p>Нажмите на картинку, чтобы заработать монеты.</p>

    <div class="status">
        Статус подключения к базе данных: <strong><?php echo $db_status; ?></strong>
    </div>
</body>
</html>

