<?php
session_start();
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Простейшая проверка пароля
    if (strlen($password) < 6) {
        echo "Пароль должен содержать хотя бы 6 символов.";
        exit;
    }

    // Хеширование пароля
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Проверка на существование пользователя
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Пользователь с таким именем уже существует.";
    } else {
        // Добавление нового пользователя в базу данных
        $stmt = $conn->prepare("INSERT INTO users (username, password, balance) VALUES (?, ?, ?)");
        $balance = 0; // Начальный баланс
        $stmt->bind_param("ssi", $username, $hashedPassword, $balance);

        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            echo "success";
        } else {
            echo "Ошибка при регистрации: " . $stmt->error;
        }
    }
}
?>
