<?php
session_start();
include('db_config.php'); // Подключаем базу данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Проверка на пустое имя пользователя или пароль
    if (empty($username) || empty($password)) {
        echo "Имя пользователя и пароль не могут быть пустыми.";
        exit;
    }

    // Проверка, что имя пользователя уникально
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Пользователь с таким именем уже существует.";
    } else {
        // Хэшируем пароль перед сохранением в базе
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Вставляем нового пользователя в базу
        $stmt = $conn->prepare("INSERT INTO users (username, password, balance) VALUES (?, ?, 0)");
        $stmt->bind_param("ss", $username, $hashedPassword);
        if ($stmt->execute()) {
            echo "success";  // Возвращаем успешный ответ
        } else {
            echo "Ошибка при создании пользователя.";
        }
    }
}
?>
