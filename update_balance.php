<?php
session_start();
include('db_config.php');

// Проверка, что пользователь авторизован
if (!isset($_SESSION['username'])) {
    echo "Пользователь не авторизован.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $balance = $_POST['balance'];
    $username = $_SESSION['username'];

    // Логирование полученного баланса
    error_log('Обновление баланса пользователя ' . $username . ' на ' . $balance . ' монет.');

    // Обновление баланса в базе данных
    $stmt = $conn->prepare("UPDATE users SET balance = ? WHERE username = ?");
    if ($stmt === false) {
        die('Ошибка подготовки запроса: ' . $conn->error);
    }

    $stmt->bind_param("is", $balance, $username);
    if ($stmt->execute()) {
        echo "Баланс обновлен";
    } else {
        echo "Ошибка при обновлении баланса: " . $stmt->error;
    }
}
?>
