<?php

require_once 'db.php';

if (isset($_POST['email']) && isset($_POST['password'])) {

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    if ($user) {
        if ($user['password'] = md5($_POST['password'])) {

            session_start();
            $token = base64_encode(random_bytes(10));
            $stmt = $pdo->prepare("UPDATE users SET token = (:token) WHERE email = :email");
            $stmt->bindParam(':email', $user['email']);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            $_SESSION['token'] = $token;

            header("Location: http://".$_SERVER['SERVER_NAME']);

        } else {
            echo 'Incorrect password';
        }
    } else {
        echo 'User not found';
    }
}
