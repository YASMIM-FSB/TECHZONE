<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLogged = isset($_SESSION['user_id']);

// SE NÃO ESTIVER LOGADO, ZERA O CARRINHO NA SESSÃO
if (!$isLogged && isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

// contador do carrinho
$cartCount = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += (int)$item['qty'];
    }
}
?>

<header class="topbar">
  <div class="container topbar-inner">
    
    <!-- LOGO -->
    <div class="logo">
      <a href="index.php">TechZone</a>
    </div>

    <!-- MENU PRINCIPAL -->
    <nav class="nav-links" id="nav-menu">
      <a href="index.php">Hogar</a>
      <a href="contacto.php">Contacto</a>
      <a href="cadastro.php">Inscribirse</a>
    </nav>

    <!-- LADO DIREITO: busca + ícones + usuário + hambúrguer -->
    <div class="nav-right">

      <div class="search-wrapper">
        <input type="text" placeholder="¿Qué estás buscando?" />
        <button type="button">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>

      <!-- WISHLIST -->
      <a href="wishlist.php" class="icon-btn">
        <i class="fa-regular fa-heart"></i>
      </a>

      <!-- CARRINHO COM BADGE -->
      <a href="carrito.php" class="icon-btn cart-icon-wrapper" style="position: relative;">
        <i class="fa-solid fa-bag-shopping"></i>
        <?php if ($cartCount > 0): ?>
          <span class="cart-notification-badge">
            <?= $cartCount ?>
          </span>
        <?php endif; ?>
      </a>

      <!-- USUÁRIO -->
      <?php if ($isLogged): ?>
        <div class="nav-user">
          <button
            type="button"
            class="icon-btn icon-btn-user logged"
            id="user-menu-toggle">
            <i class="fa-regular fa-user"></i>
          </button>

          <div class="user-dropdown" id="user-dropdown">
            <ul>
              <li>
                <a href="mi-cuenta.php">
                  <i class="fa-regular fa-user"></i>
                  Administrar mi cuenta
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa-regular fa-bag-shopping"></i>
                  Mi pedido
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa-regular fa-circle-xmark"></i>
                  Mis Cancelaciones
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa-regular fa-star"></i>
                  Mis reseñas
                </a>
              </li>
              <li>
                <a href="logout.php" class="logout-link">
                  <i class="fa-solid fa-arrow-right-from-bracket"></i>
                  Cerrar sesión
                </a>
              </li>
            </ul>
          </div>
        </div>
      <?php else: ?>
        <a href="login.php" class="icon-btn icon-btn-user">
          <i class="fa-regular fa-user"></i>
        </a>
      <?php endif; ?>

      <!-- BOTÃO HAMBÚRGUER (mobile) -->
      <button
        class="icon-btn nav-toggle"
        id="nav-toggle"
        type="button"
        aria-label="Abrir menú">
        <i class="fa-solid fa-bars"></i>
      </button>

    </div>
  </div>
</header>
