<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/config/db.php";

// pega o id pela URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    // id inválido
    http_response_code(404);
    die("Produto não encontrado.");
}

// busca produto no banco
$stmt = $pdo->prepare("
    SELECT *
    FROM products
    WHERE id = :id
    LIMIT 1
");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    http_response_code(404);
    die("Produto não encontrado.");
}

// só pra facilitar nos echos:
$name  = $product['name'];
$price = (float)$product['price'];
$old   = $product['old_price'] !== null ? (float)$product['old_price'] : null;
$img   = $product['image'];
$desc  = $product['description'] ?: "Descripción breve del producto.";
$stock = (int)$product['in_stock'];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title><?= htmlspecialchars($name); ?> - TechZone</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "partials/header.php"; ?>

<main class="page">
  <section class="section">
    <div class="container product-page">

      <!-- breadcrumb -->
      <p class="breadcrumb">
        Hogar / Gaming / <span><?= htmlspecialchars($name); ?></span>
      </p>

      <div class="product-layout">
        <!-- GALERIA / IMAGEM PRINCIPAL -->
        <div class="product-gallery">
          <div class="product-main-image">
            <img id="main-product-img" src="<?= htmlspecialchars($img); ?>" alt="<?= htmlspecialchars($name); ?>">
          </div>

          <!-- thumbs (se quiser pode repetir a mesma imagem) -->
          <div class="product-thumbs">
            <img class="thumb-img active-thumb" src="<?= htmlspecialchars($img); ?>" alt="">
            <img class="thumb-img" src="<?= htmlspecialchars($img); ?>" alt="">
            <img class="thumb-img" src="<?= htmlspecialchars($img); ?>" alt="">
            <img class="thumb-img" src="<?= htmlspecialchars($img); ?>" alt="">
          </div>
        </div>

        <!-- INFO DO PRODUTO -->
        <div class="product-info-box">
          <h1 class="product-page-title"><?= htmlspecialchars($name); ?></h1>

          <div class="product-rating-line">
            <span class="stars">★★★★☆</span>
            <span class="rating-count">(120 reseñas)</span>
            <span class="stock-label <?= $stock ? 'stock-available' : 'stock-out'; ?>">
              <?= $stock ? 'En stock' : 'Sin stock'; ?>
            </span>
          </div>

          <div class="product-price-line">
            <span class="product-price-current">$<?= number_format($price, 2); ?></span>
            <?php if ($old): ?>
              <span class="product-price-old">$<?= number_format($old, 2); ?></span>
            <?php endif; ?>
          </div>

          <p class="product-page-description">
            <?= nl2br(htmlspecialchars($desc)); ?>
          </p>


          <!-- Quantidade + botões -->
          <div class="product-actions">
            <div class="product-qty">
              <button id="qty-minus" type="button">-</button>
              <span id="qty-number">1</span>
              <button id="qty-plus" type="button">+</button>
            </div>

            <!-- Botão adicionar ao carrinho (usando o mesmo cart-add) -->
            <a
              href="cart-add.php?name=<?= urlencode($name); ?>
                &image=<?= urlencode($img); ?>
                &price=<?= $price; ?>
                &qty=1"
              class="btn-primary">
              Comprar ahora
            </a>

            <!-- Coração para wishlist -->
            <button class="circle-btn fav-btn" type="button">
              <i class="fa-regular fa-heart"></i>
            </button>
          </div>

        </div><!-- /product-info-box -->
      </div><!-- /product-layout -->

      <!-- Produtos relacionados -->
      <section class="section" style="padding-top:3rem;">
        <div class="section-header">
          <div class="section-title-group">
            <span class="section-pill section-pill-purple"></span>
            <div>
              <p class="section-subtitle">Artículos relacionados</p>
              <h2 class="section-title">También te puede interesar</h2>
            </div>
          </div>
        </div>
        <div class="products-row">
          <?php include "partials/related-products.php"; ?>
        </div>
      </section>

    </div>
  </section>
</main>

<?php include "partials/footer.php"; ?>

<script src="assets/js/main.js"></script>
</body>
</html>