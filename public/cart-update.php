<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$name = trim($_GET['name'] ?? '');
$qty  = (int) ($_GET['qty'] ?? 1);

if ($name && $qty > 0 && isset($_SESSION['cart'][$name])) {
    $_SESSION['cart'][$name]['qty'] = $qty;
}

header("Location: carrito.php");
exit;
