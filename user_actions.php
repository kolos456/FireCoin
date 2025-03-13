<?php
$host = 'mysql-firecoinbase.alwaysdata.net';  // или адрес вашего сервера
$dbname = 'firecoinbase_bd';
$username = '403942';  // имя пользователя MySQL
$password = 'hugabos223';  // пароль пользователя MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Регистрация нового пользователя
    if (isset($_POST['register'])) {
        $newUsername = $_POST['username'];
        $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$newUsername, $newPassword]);

        echo "Пользователь зарегистрирован!";
    }

    // Вход пользователя
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            echo "Добро пожаловать, " . $user['username'];
        } else {
            echo "Неверное имя пользователя или пароль.";
        }
    }

    // Добавление монеты
    if (isset($_POST['add_coin'])) {
        $userId = $_POST['user_id'];
        $stmt = $pdo->prepare("UPDATE users SET coins = coins + 1 WHERE id = ?");
        $stmt->execute([$userId]);
    }
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
?>
