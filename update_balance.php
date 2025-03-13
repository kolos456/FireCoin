<?php
header('Content-Type: application/json');

// Подключаемся к базе данных
$host = 'localhost';
$user = 'root';
$password = 'your_password';
$dbname = 'firecoinbase_bd';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Ошибка подключения к базе данных');
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']) && isset($data['balance'])) {
    $username = $conn->real_escape_string($data['username']);
    $balance = (int) $data['balance'];

    $sql = "UPDATE users SET balance = $balance WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        echo 'Баланс обновлен';
    } else {
        echo 'Ошибка обновления баланса';
    }
}

$conn->close();
?>
