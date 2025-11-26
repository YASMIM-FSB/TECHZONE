<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// precisa estar logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/config/db.php";

$userId   = $_SESSION['user_id'];

$name     = trim($_GET['name']      ?? '');
$image    = trim($_GET['image']     ?? '');
$price    = trim($_GET['price']     ?? '');
$oldPrice = trim($_GET['old_price'] ?? '');
$discount = trim($_GET['discount']  ?? '');

// se não tiver dados mínimos, manda pra wishlist
if ($name === '' || $image === '' || $price === '') {
    die("Dados mínimos faltando para wishlist:\n<pre>" . print_r($_GET, true) . "</pre>");
}

$priceNum    = (float) $price;
$oldPriceNum = $oldPrice !== '' ? (float) $oldPrice : null;
$discountInt = $discount !== '' ? (int) $discount : null;

try {
    // evita duplicar o mesmo produto por nome para o mesmo usuário (opcional)
    $stmt = $pdo->prepare("
        SELECT id
        FROM wishlist
        WHERE user_id = :user_id
          AND product_name = :name
        LIMIT 1
    ");
    $stmt->execute([
        'user_id' => $userId,
        'name'    => $name,
    ]);
    $exists = $stmt->fetch();

    if (!$exists) {
        $insert = $pdo->prepare("
            INSERT INTO wishlist (user_id, product_name, image_path, price, old_price, discount_percent)
            VALUES (:user_id, :name, :image, :price, :old_price, :discount)
        ");

        $insert->execute([
            'user_id'   => $userId,
            'name'      => $name,
            'image'     => $image,
            'price'     => $priceNum,
            'old_price' => $oldPriceNum,
            'discount'  => $discountInt,
        ]);
    }

    // DEBUG: ver se entrou aqui
    // echo "Inserção ok"; exit;

} catch (PDOException $e) {
    // DEBUG: mostra o erro real do banco
    die("Erro ao inserir na wishlist: " . $e->getMessage());
}

// volta pra página anterior ou, se não tiver, para a wishlist
$back = $_SERVER['HTTP_REFERER'] ?? 'wishlist.php';
header("Location: " . $back);
exit;
