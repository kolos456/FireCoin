<?php
// Настройки подключения к базе данных
$servername = "localhost";
$username_db = "root"; // Ваши данные для доступа к базе данных
$password_db = "";
$dbname = "firecoinbase_bd";

// Подключение к базе данных
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных из формы
$username = $_POST['username'];
$password = $_POST['password'];

// Отладочная информация
error_log("Имя пользователя: " . $username); // Логируем имя пользователя
error_log("Пароль: " . $password); // Логируем пароль

// Проверка, что поля не пустые
if (empty($username) || empty($password)) {
    echo "Все поля должны быть заполнены!";
    exit();
}

// Хеширование пароля перед сохранением в базе данных
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL-запрос для добавления нового пользователя
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";

// Подготовка и выполнение SQL-запроса
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hashed_password);

// Выполнение запроса и проверка на успешность
if ($stmt->execute()) {
    echo "success"; // Успешная регистрация
} else {
    echo "Ошибка: " . $stmt->error; // Ошибка при выполнении запроса
}

// Закрытие соединения с базой данных
$stmt->close();
$conn->close();
?>
