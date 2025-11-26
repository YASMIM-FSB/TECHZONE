<?php
// por enquanto estático – depois podemos puxar do banco
?>

<!-- Producto relacionado 1 -->
<article class="product-card">
  <span class="discount-badge">-40%</span>

  <button class="circle-btn fav-btn">
    <i class="fa-regular fa-heart"></i>
  </button>

  <button class="circle-btn view-btn">
    <i class="fa-regular fa-eye"></i>
  </button>

   <a href="product.php?id=1" class="product-image">
    <img src="assets/img/carrossel1/1.png" alt="Mando para juegos">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=1">Mando para juegos</a>
  </h3>

  <div class="product-price">
    <span class="price-current">$120</span>
    <span class="price-old">$160</span>
  </div>

  <div class="product-rating">
    <span class="stars">★★★★★</span>
    <span class="rating-count">(88)</span>
  </div>

  <!-- AQUI: link direto pro cart-add.php -->
  <a
    class="btn-black"
    href="cart-add.php?name=<?= urlencode('Mando para juegos HAVIT HV-G92') ?>
      &image=assets/img/gamepad.png
      &price=120
      &qty=1">
    Añadir a la cesta
  </a>
</article>

<!-- Producto relacionado 2 -->
<article class="product-card">
  <span class="discount-badge">-30%</span>
  <button class="circle-btn fav-btn">
    <i class="fa-regular fa-heart"></i>
  </button>
  <button class="circle-btn view-btn">
    <i class="fa-regular fa-eye"></i>
  </button>

   <a href="product.php?id=10" class="product-image">
    <img src="assets/img/GERAL/3.png" alt="Teclado con cable AK-900">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=10">Teclado con cable AK-900</a>
  </h3>

  <div class="product-price">
    <span class="price-current">$960</span>
    <span class="price-old">$1160</span>
  </div>

  <div class="product-rating">
    <span class="stars">★★★★★</span>
    <span class="rating-count">(75)</span>
  </div>

  <a
    class="btn-black"
    href="cart-add.php?name=<?= urlencode('Teclado con cable AK-900') ?>
      &image=assets/img/keyboard.png
      &price=960
      &qty=1">
    Añadir a la cesta
  </a>
</article>

<!-- Producto relacionado 3 -->
<article class="product-card">
  <span class="discount-badge">-30%</span>
  <button class="circle-btn fav-btn">
    <i class="fa-regular fa-heart"></i>
  </button>
  <button class="circle-btn view-btn">
    <i class="fa-regular fa-eye"></i>
  </button>

  <a href="product.php?id=11" class="product-image">
    <img src="assets/img/carrossel1/2.png" alt="Monitor de juegos LCD IPS">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=11">Monitor de juegos LCD IPS</a>
  </h3>

  <div class="product-price">
    <span class="price-current">$370</span>
    <span class="price-old">$400</span>
  </div>

  <div class="product-rating">
    <span class="stars">★★★★★</span>
    <span class="rating-count">(99)</span>
  </div>

  <a
    class="btn-black"
    href="cart-add.php?name=<?= urlencode('Monitor de juegos LCD IPS') ?>
      &image=assets/img/monitor.png
      &price=370
      &qty=1">
    Añadir a la cesta
  </a>
</article>

<!-- Producto relacionado 4 -->
<article class="product-card">
  <span class="discount-badge">-25%</span>
  <button class="circle-btn fav-btn">
    <i class="fa-regular fa-heart"></i>
  </button>
  <button class="circle-btn view-btn">
    <i class="fa-regular fa-eye"></i>
  </button>

  <a href="product.php?id=12" class="product-image">
    <img src="assets/img/carrossel1/4.png" alt="RGB líquido CPU Cooler">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=12">RGB líquido CPU Cooler</a>
  </h3>

  <div class="product-price">
    <span class="price-current">$160</span>
    <span class="price-old">$180</span>
  </div>

  <div class="product-rating">
    <span class="stars">★★★★★</span>
    <span class="rating-count">(65)</span>
  </div>

  <a
    class="btn-black"
    href="cart-add.php?name=<?= urlencode('RGB líquido CPU Cooler') ?>
      &image=assets/img/cooler-rgb.png
      &price=160
      &qty=1">
    Añadir a la cesta
  </a>
</article>
