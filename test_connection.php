<?php
$servername = "mysqlXX.alwaysdata.net"; // Замените на актуальный хост
$username = "your_db_username";         // Имя пользователя базы данных
$password = "your_db_password";         // Ваш пароль
$dbname = "firecoinbase_bd";            // Имя вашей базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Подключение не удалось: " . $conn->connect_error);
} else {
    echo "Подключение успешно!";
}

// Закрытие соединения
$conn->close();
?>
