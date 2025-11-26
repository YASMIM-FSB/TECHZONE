<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$name = trim($_GET['name'] ?? '');

if ($name && isset($_SESSION['cart'][$name])) {
    unset($_SESSION['cart'][$name]);
}

header("Location: carrito.php");
exit;
