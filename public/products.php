<?php
session_start();

$produtos = [
    1 => ['nome' => 'Camiseta', 'preco' => 50.00],
    2 => ['nome' => 'Calça Jeans', 'preco' => 120.00],
    3 => ['nome' => 'Tênis', 'preco' => 200.00],
];

if (isset($_GET['add']) && isset($produtos[$_GET['add']])) {
    $id = $_GET['add'];
    $_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 0) + 1;
}

if (isset($_GET['finalizar'])) {
    $_SESSION['carrinho'] = [];
    echo "<p><strong>Compra finalizada!</strong></p>";
}
?>

<h1>Produtos</h1>
<ul>
    <?php foreach ($produtos as $id => $produto): ?>
        <li>
            <?= $produto['nome'] ?> - R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
            <a href="?add=<?= $id ?>">[Adicionar ao carrinho]</a>
        </li>
    <?php endforeach; ?>
</ul>

<h2>Carrinho</h2>
<?php if (!empty($_SESSION['carrinho'])): ?>
    <ul>
        <?php 
        $total = 0;
        foreach ($_SESSION['carrinho'] as $id => $quantidade):
            $produto = $produtos[$id];
            $subtotal = $produto['preco'] * $quantidade;
            $total += $subtotal;
        ?>
            <li><?= $produto['nome'] ?> (<?= $quantidade ?>) - R$ <?= number_format($subtotal, 2, ',', '.') ?></li>
        <?php endforeach; ?>
    </ul>
    <p><strong>Total: R$ <?= number_format($total, 2, ',', '.') ?></strong></p>
    <a href="?finalizar=true">[Finalizar Compra]</a>
<?php else: ?>
    <p>Carrinho vazio.</p>
<?php endif; ?>