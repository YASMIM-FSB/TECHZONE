<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// se não estiver logado, manda pro login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/config/db.php";

$userId = $_SESSION['user_id']; // ID do usuário logado
$errors = [];

// ========== Remover item da wishlist ==========
if (isset($_GET['remove'])) {
    $itemId = (int) $_GET['remove'];

    try {
        $stmt = $pdo->prepare("
            DELETE FROM wishlist
            WHERE id = :id AND user_id = :user_id
        ");
        $stmt->execute([
            'id'      => $itemId,
            'user_id' => $userId
        ]);

        // evita re-envio de remoção ao atualizar a página
        header("Location: wishlist.php");
        exit;
    } catch (PDOException $e) {
        $errors[] = "Erro ao remover item da lista de desejos.";
        // Se quiser debugar:
        // $errors[] = "Erro ao remover: " . $e->getMessage();
    }
}

// ========== Buscar itens da wishlist ==========
try {
    $stmt = $pdo->prepare("
        SELECT id, product_name, image_path, price, old_price, discount_percent
        FROM wishlist
        WHERE user_id = :user_id
        ORDER BY created_at DESC
    ");
    $stmt->execute(['user_id' => $userId]);
    $items = $stmt->fetchAll();
    $totalItems = count($items);
} catch (PDOException $e) {
    $errors[] = "Erro ao carregar a lista de desejos.";
    $items = [];
    $totalItems = 0;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Lista de deseos - TechZone</title>
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

      <!-- título + botão mover -->
      <div class="wishlist-header">
        <h2 class="wishlist-title">
          Lista de deseos (<?= (int) $totalItems ?>)
        </h2>

        <button class="btn-outline-black wishlist-move-all" type="button">
          Mover toda a la bolsa
        </button>
      </div>

      <?php if (!empty($errors)): ?>
        <div class="auth-alert auth-alert-error" style="margin-bottom:1rem;">
          <?php foreach ($errors as $err): ?>
            <p><?= htmlspecialchars($err); ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if ($totalItems === 0): ?>

        <p>Tu lista de deseos está vacía por ahora.</p>
        <a href="index.php" class="btn-primary" style="margin-top:1rem;display:inline-flex;align-items:center;gap:0.4rem;">
          Ir de compras
          <i class="fa-solid fa-arrow-right"></i>
        </a>

      <?php else: ?>

        <!-- GRID DE ITENS DA WISHLIST -->
        <div class="wishlist-grid">

          <?php foreach ($items as $item): ?>
            <div class="wishlist-card">
              <?php if (!is_null($item['discount_percent'])): ?>
                <span class="discount-badge">-<?= (int) $item['discount_percent']; ?>%</span>
              <?php endif; ?>

              <!-- botão remover -->
              <a href="wishlist.php?remove=<?= (int) $item['id']; ?>" class="wishlist-remove" title="Remover">
                <i class="fa-regular fa-trash-can"></i>
              </a>

              <div class="wishlist-img">
                <img src="<?= htmlspecialchars($item['image_path']); ?>" alt="">
              </div>

              <h3 class="wishlist-name">
                <?= htmlspecialchars($item['product_name']); ?>
              </h3>

              <div class="wishlist-price">
                <span class="price-current">
                  $<?= number_format((float) $item['price'], 0); ?>
                </span>

                <?php if (!is_null($item['old_price'])): ?>
                  <span class="price-old">
                    $<?= number_format((float) $item['old_price'], 0); ?>
                  </span>
                <?php endif; ?>
              </div>

              <button class="btn-black">
                Añadir a la cesta
              </button>
            </div>
          <?php endforeach; ?>

        </div>

      <?php endif; ?>

    </div>
  </section>

  <!-- RECOMENDACIONES -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <div class="section-title-group">
          <span class="section-pill section-pill-purple"></span>
          <div>
            <p class="section-subtitle">Sólo para ti</p>
            <h2 class="section-title">Recomendado para ti</h2>
          </div>
        </div>
        <button class="btn-outline-black">Ver todo</button>
      </div>

      <div class="products-row">
        <?php include "partials/related-products.php"; ?>
      </div>
    </div>
  </section>

</main>

<?php include "partials/footer.php"; ?>

<script src="assets/js/main.js"></script>
</body>
</html>
