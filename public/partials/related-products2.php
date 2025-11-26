<?php
// por enquanto estático – depois podemos puxar do banco
?>

<!-- Producto relacionado 1 -->
<article class="product-card">
  <span class="discount-badge">-50%</span>

  <button class="circle-btn fav-btn">
    <i class="fa-regular fa-heart"></i>
  </button>

  <button class="circle-btn view-btn">
    <i class="fa-regular fa-eye"></i>
  </button>

  <a href="product.php?id=8" class="product-image">
    <img src="assets/img/carrossel1/5.png" alt="Actualización BS">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=8">Actualización BS</a>
  </h3>

  <div class="product-price">
    <span class="price-current">$80</span>
    <span class="price-old">$160</span>
  </div>

  <div class="product-rating">
    <span class="stars">★★★★★</span>
    <span class="rating-count">(88)</span>
  </div>

  <a class="btn-black add-cart-btn"
   href="cart-add.php?name=<?= urlencode($name) ?>&image=<?= $img ?>&price=<?= $price ?>">
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

  <a href="product.php?id=14" class="product-image">
    <img src="assets/img/carrossel1/6.png" alt="Attack Shark X11 0.1">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=14">Attack Shark X11 0.1</a>
  </h3>


  <div class="product-price">
    <span class="price-current">$960</span>
    <span class="price-old">$1160</span>
  </div>

  <div class="product-rating">
    <span class="stars">★★★★★</span>
    <span class="rating-count">(75)</span>
  </div>

  <a class="btn-black add-cart-btn"
   href="cart-add.php?name=<?= urlencode($name) ?>&image=<?= $img ?>&price=<?= $price ?>">
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

  <a href="product.php?id=15" class="product-image">
    <img src="assets/img/carrossel1/3.png" alt="Silla de juego XLL0123">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=15">Silla de juego XLL0123</a>
  </h3>

  <div class="product-price">
    <span class="price-current">$370</span>
    <span class="price-old">$400</span>
  </div>

  <div class="product-rating">
    <span class="stars">★★★★★</span>
    <span class="rating-count">(99)</span>
  </div>

  <a class="btn-black add-cart-btn"
   href="cart-add.php?name=<?= urlencode($name) ?>&image=<?= $img ?>&price=<?= $price ?>">
    Añadir a la cesta
</a>
</article>

<!-- Producto relacionado 4 -->
<article class="product-card">
  <span class="discount-badge">-80%</span>
  <button class="circle-btn fav-btn">
    <i class="fa-regular fa-heart"></i>
  </button>
  <button class="circle-btn view-btn">
    <i class="fa-regular fa-eye"></i>
  </button>

   <a href="product.php?id=16" class="product-image">
    <img src="assets/img/GERAL/9.png" alt="Auriculares X1125">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=16">Auriculares X1125</a>
  </h3>

  <div class="product-price">
    <span class="price-current">$80</span>
    <span class="price-old">$160</span>
  </div>

  <div class="product-rating">
    <span class="stars">★★★★★</span>
    <span class="rating-count">(65)</span>
  </div>

  <a class="btn-black add-cart-btn"
   href="cart-add.php?name=<?= urlencode($name) ?>&image=<?= $img ?>&price=<?= $price ?>">
    Añadir a la cesta
</a>
</article>
