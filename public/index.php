<?php
require '../src/auth.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
?>

<h1>Bem-vindo, <?= htmlspecialchars($user['username']) ?>!</h1>
<p>Você está logado como <strong><?= htmlspecialchars($user['role']) ?></strong>.</p>

<ul>
    <?php if ($user['role'] === 'admin'): ?>
        <li><a href="https://www.youtube.com" target="_blank">YouTube</a></li>
        <li><a href="https://www.facebook.com" target="_blank">Facebook</a></li>
    <?php elseif ($user['role'] === 'user'): ?>
        <li><a href="https://www.facebook.com" target="_blank">Facebook</a></li>
    <?php else: ?>
        <li><em>Sem links disponíveis para esse perfil.</em></li>
    <?php endif; ?>
</ul>

<a href="logout.php">Sair</a>
