<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carrinho em sessão
$cart = $_SESSION['cart'] ?? [];

// Calcula subtotal inicial (JS depois atualiza)
$subtotal = 0;
$totalItems = 0;

foreach ($cart as $item) {
    $subtotal += $item['price'] * $item['qty'];
    $totalItems += $item['qty'];
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Carrito - TechZone</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "partials/header.php"; ?>

<main class="page">
  <section class="section">
    <div class="container"> 

      <!-- breadcrumb -->
      <p class="breadcrumb">
        Hogar / <span>Carrito</span>
      </p>

      <div class="cart-page-header">
        <div>
          <h1 class="page-title">Carrito de compras</h1>
          <?php if ($totalItems > 0): ?>
            <p class="page-subtitle">
              Tienes <strong><?= (int)$totalItems ?></strong> artículo<?= $totalItems > 1 ? 's' : '' ?> en tu carrito.
            </p>
          <?php else: ?>
            <p class="page-subtitle">Aún no has añadido productos a tu carrito.</p>
          <?php endif; ?>
        </div>

        <?php if ($totalItems > 0): ?>
          <div class="cart-page-actions">
            <a href="index.php" class="btn-outline-black">
              <i class="fa-solid fa-arrow-left"></i>
              Continuar comprando
            </a>
            <a href="cart-clear.php" class="btn-outline-black cart-clear-btn">
              <i class="fa-regular fa-trash-can"></i>
              Vaciar carrito
            </a>
          </div>
        <?php endif; ?>
      </div>

      <?php if (empty($cart)): ?>

        <div class="cart-empty-box">
          <p>Tu carrito está vacío por ahora.</p>
          <a href="index.php" class="btn-primary" style="margin-top:1rem;display:inline-flex;align-items:center;gap:0.4rem;">
            Ir de compras
            <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>

      <?php else: ?>

        <!-- LAYOUT PRINCIPAL: lista de itens + resumo -->
        <div class="cart-layout">

          <!-- Lista de itens -->
          <div class="cart-table-box">

            <!-- Cabeçalho desktop -->
            <div class="cart-table-row cart-table-head">
              <div class="cart-col cart-col-product">Producto</div>
              <div class="cart-col cart-col-price">Precio</div>
              <div class="cart-col cart-col-qty">Cantidad</div>
              <div class="cart-col cart-col-subtotal">Total parcial</div>
              <div class="cart-col cart-col-remove"></div>
            </div>

            <!-- Itens -->
            <?php foreach ($cart as $item): ?>
              <article class="cart-table-row cart-item-row" data-price="<?= htmlspecialchars($item['price']) ?>">

                <!-- Produto -->
                <div class="cart-col cart-col-product">
                  <div class="cart-product-main">
                    <div class="cart-product-img">
                      <?php if (!empty($item['image'])): ?>
                        <img src="<?= htmlspecialchars($item['image']); ?>" alt="">
                      <?php endif; ?>
                    </div>
                    <div class="cart-product-info">
                      <p class="cart-product-name">
                        <?= htmlspecialchars($item['name']); ?>
                      </p>
                      <p class="cart-product-meta">
                        En stock · Envío en 3–5 días
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Preço -->
                <div class="cart-col cart-col-price">
                  <span class="cart-price-label">Precio</span>
                  <span class="cart-price-value">
                    $<?= number_format((float)$item['price'], 2); ?>
                  </span>
                </div>

                <!-- Quantidade -->
                <div class="cart-col cart-col-qty">
                  <span class="cart-price-label">Cantidad</span>
                  <select class="cart-qty-select"
                          onchange="window.location='cart-update.php?name=<?= urlencode($item['name']); ?>&qty='+this.value">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                      <option value="<?= $i ?>" <?= $i == $item['qty'] ? 'selected' : '' ?>>
                        <?= $i ?>
                      </option>
                    <?php endfor; ?>
                  </select>
                </div>

                <!-- Subtotal (por item) -->
                <div class="cart-col cart-col-subtotal">
                  <span class="cart-price-label">Total parcial</span>
                  <span class="cart-subtotal-wrapper">
                    $<span class="cart-subtotal">
                      <?= number_format($item['price'] * $item['qty'], 2); ?>
                    </span>
                  </span>
                </div>

                <!-- Remover -->
                <div class="cart-col cart-col-remove">
                  <button type="button"
                          class="cart-remove-btn"
                          onclick="window.location='cart-remove.php?name=<?= urlencode($item['name']); ?>'">
                    <i class="fa-regular fa-trash-can"></i>
                  </button>
                </div>

              </article>
            <?php endforeach; ?>

          </div>

          <!-- RESUMO DO CARRINHO -->
          <aside class="cart-summary-box">
            <h3 class="cart-summary-title">Total del carrito</h3>

            <div class="cart-summary-row">
              <span>Total parcial:</span>
              <span id="cart-subtotal-sum">
                <?= number_format($subtotal, 2); ?>
              </span>
            </div>

            <div class="cart-summary-row">
              <span>Envío:</span>
              <span>Free</span>
            </div>

            <div class="cart-summary-row cart-summary-total">
              <span>Total:</span>
              <span id="cart-total">
                <?= number_format($subtotal, 2); ?>
              </span>
            </div>

            <p class="cart-summary-note">
              Los costos de envío y los impuestos pueden actualizarse durante el pago.
            </p>

            <a href="#" class="btn-primary cart-checkout-btn">
              Proceder al pago
            </a>

            <button type="button" class="btn-outline-black cart-keep-buying-btn"
                    onclick="window.location='index.php'">
              Seguir comprando
            </button>
          </aside>

        </div><!-- /cart-layout -->

      <?php endif; ?>

    </div>
  </section>
</main>

<?php include "partials/footer.php"; ?>

<script src="assets/js/main.js"></script>
</body>
</html>