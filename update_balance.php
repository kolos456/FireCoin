<?php
session_start();
include('db_config.php');

if (isset($_SESSION['username']) && isset($_POST['balance'])) {
    $username = $_SESSION['username'];
    $balance = $_POST['balance'];

    // Подключаемся к базе данных
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Обновляем баланс
    $stmt = $conn->prepare("UPDATE users SET balance = ? WHERE username = ?");
    $stmt->bind_param("is", $balance, $username);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
