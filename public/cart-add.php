<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$name  = trim($_GET['name'] ?? '');
$image = trim($_GET['image'] ?? '');
$price = isset($_GET['price']) ? (float) $_GET['price'] : 0;
$qty   = isset($_GET['qty']) ? (int) $_GET['qty'] : 1;

if ($name === '' || $price <= 0) {
    // volta pra home se vier coisa quebrada
    header("Location: index.php");
    exit;
}

// se já existir → soma quantidade
if (isset($_SESSION['cart'][$name])) {
    $_SESSION['cart'][$name]['qty'] += $qty;
} else {
    $_SESSION['cart'][$name] = [
        'name'  => $name,
        'image' => $image,
        'price' => $price,
        'qty'   => $qty,
    ];
}

// volta para a página anterior ou carrinho
$back = $_SERVER['HTTP_REFERER'] ?? 'carrito.php';
header("Location: " . $back);
exit;