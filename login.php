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

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Пользователь не найден.";
    } else {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            echo "success";  // Успешный вход
        } else {
            echo "Неверный пароль.";
        }
    }
}
?>
