<?php
require '../src/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (login($username, $password)) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Usuário ou senha inválidos!";
    }
}
?>

<form method="post">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <input type="text" name="username" placeholder="Usuário" required><br>
    <input type="password" name="password" placeholder="Senha" required><br>
    <button type="submit">Entrar</button>
</form>
