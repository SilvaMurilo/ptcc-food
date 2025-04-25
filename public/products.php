<?php
session_start();

$produtos = [
    1 => ['nome' => 'Camiseta', 'preco' => 50.00, 'img' => 'https://static.ferju.com.br/public/ferju/imagens/produtos/media/camiseta-unissex-adulto-manga-curta-lisa-ht102-har-textil-bordo-4329.jpg'],
    2 => ['nome' => 'Calça Jeans', 'preco' => 120.00, 'img' => 'https://png.pngtree.com/png-clipart/20210318/ourmid/pngtree-pants-clip-art-jeans-png-image_3082930.jpg'],
    3 => ['nome' => 'Tênis', 'preco' => 200.00, 'img' => 'https://images.vexels.com/media/users/3/263856/isolated/preview/ea752ba6e0585e8450f24140287e87fc-tenis-de-maratona-esportiva-de-corrida.png'],
];

if (isset($_GET['add']) && isset($produtos[$_GET['add']])) {
    $id = $_GET['add'];
    $_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 0) + 1;
    header('Location: products.php');
    exit;
}

if (isset($_GET['finalizar'])) {
    $_SESSION['carrinho'] = [];
    $_SESSION['msg'] = 'Compra finalizada!';
    header('Location: products.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Loja PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f8f9fa;
            color: #333;
        }
        h1, h2 {
            color: #444;
        }
        .produtos, .carrinho {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .produto, .item-carrinho {
            background: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            width: 200px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
            text-align: center;
        }
        .produto img, .item-carrinho img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
        .msg {
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php if (isset($_SESSION['msg'])): ?>
    <div class="msg"><?= $_SESSION['msg'] ?></div>
    <?php unset($_SESSION['msg']); ?>
<?php endif; ?>

<h1>Produtos</h1>
<div class="produtos">
    <?php foreach ($produtos as $id => $produto): ?>
        <div class="produto">
            <img src="<?= $produto['img'] ?>" alt="<?= $produto['nome'] ?>">
            <h3><?= $produto['nome'] ?></h3>
            <p>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
            <a class="btn" href="?add=<?= $id ?>">Adicionar</a>
        </div>
    <?php endforeach; ?>
</div>

<h2>Carrinho</h2>
<?php if (!empty($_SESSION['carrinho'])): ?>
    <div class="carrinho">
        <?php 
        $total = 0;
        foreach ($_SESSION['carrinho'] as $id => $quantidade):
            $produto = $produtos[$id];
            $subtotal = $produto['preco'] * $quantidade;
            $total += $subtotal;
        ?>
            <div class="item-carrinho">
                <img src="<?= $produto['img'] ?>" alt="<?= $produto['nome'] ?>">
                <h4><?= $produto['nome'] ?></h4>
                <p>Quantidade: <?= $quantidade ?></p>
                <p>Subtotal: R$ <?= number_format($subtotal, 2, ',', '.') ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <p class="total">Total: R$ <?= number_format($total, 2, ',', '.') ?></p>
    <a class="btn" href="?finalizar=true">Finalizar Compra</a>
<?php else: ?>
    <p>Carrinho vazio.</p>
<?php endif; ?>

</body>
</html>
