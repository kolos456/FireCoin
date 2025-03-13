<?php
header('Content-Type: application/json');

// Подключаемся к базе данных
$host = 'mysql-firecoinbase.alwaysdata.net';
$user = '403942';
$password = 'hugabos223';
$dbname = 'firecoinbase_bd';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных']));
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']) && isset($data['password'])) {
    $username = $conn->real_escape_string($data['username']);
    $password = password_hash($conn->real_escape_string($data['password']), PASSWORD_DEFAULT); // Хешируем пароль для безопасности

    // Проверка, существует ли уже такой логин
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Пользователь с таким логином уже существует']);
    } else {
        // Добавляем нового пользователя в базу
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ошибка регистрации']);
        }
    }
}

$conn->close();
?>
