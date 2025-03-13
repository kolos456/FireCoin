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
    $password = $conn->real_escape_string($data['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверный логин или пароль']);
    }
}

$conn->close();
?>
