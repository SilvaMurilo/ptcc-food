<?php
session_start();

function login($username, $password) {
    require 'db.php';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "Usuário não encontrado";
        return false;
    }

    // if (!password_verify($password, $user['password'])) {
    if ($password !== $user['password']) {

        echo "Senha incorreta";
        return false;
    }

    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['name'],
        'role' => $user['role']
    ];

    return true;
}

function isAuthenticated() {
    return isset($_SESSION['user']);
}

function logout() {
    session_destroy();
}
