<?php
session_start();
include('db_config.php');

$response = ['balance' => 0];

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Подключаемся к базе данных
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получаем баланс пользователя
    $stmt = $conn->prepare("SELECT balance FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($balance);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    $response['balance'] = $balance;
}

echo json_encode($response);
?>
