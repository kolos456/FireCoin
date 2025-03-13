<?php
// Параметры подключения к базе данных
$servername = "mysql-firecoinbase.alwaysdata.net";  // Замените на актуальный хост
$username = "403942";          // Имя пользователя базы данных
$password = "hugabos223";          // Ваш пароль
$dbname = "firecoinbase_bd";             // Имя базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
} else {
    echo "Подключение успешно!";
}

// Закрытие соединения
$conn->close();
?>
