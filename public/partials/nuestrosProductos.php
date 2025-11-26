<?php
// por enquanto estático – depois podemos puxar do banco
?>


<div style="display: flex; flex-direction: column; gap: 35px;">
  <div style="display: flex; gap: 35px;">
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

      <a href="product.php?id=18" class="product-image">
    <img src="assets/img/GERAL/4.png" alt="Enfriador de agua">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=18">Enfriador de agua</a>
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

       <a href="product.php?id=19" class="product-image">
    <img src="assets/img/GERAL/5.png" alt="Ratón sencillo CLL25">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=19">Ratón sencillo CLL25</a>
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
      <span class="discount-badge">-25%</span>
      <button class="circle-btn fav-btn">
        <i class="fa-regular fa-heart"></i>
      </button>
      <button class="circle-btn view-btn">
        <i class="fa-regular fa-eye"></i>
      </button>

        <a href="product.php?id=20" class="product-image">
    <img src="assets/img/GERAL/11.png" alt="63 GB de RAM BEST FURY">
  </a>

  <h3 class="product-title">
    <a href="product.php?id=20">63 GB de RAM BEST FURY</a>
  </h3>
  
      <div class="product-price">
        <span class="price-current">$160</span>
        <span class="price-old">$180</span>
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
  </div>
  
  <div style="display: flex; gap: 35px;">
    <!-- Producto relacionado 5 -->
    <article class="product-card">
      <span class="discount-badge">-40%</span>
  
      <button class="circle-btn fav-btn">
        <i class="fa-regular fa-heart"></i>
      </button>
  
      <button class="circle-btn view-btn">
        <i class="fa-regular fa-eye"></i>
      </button>

      <a href="product.php?id=5" class="product-image">
        <img src="assets/img/GERAL/8.png" alt="Teclado con cable HV-G92">
      </a>

      <h3 class="product-title">
        <a href="product.php?id=5">Teclado con cable HV-G92</a>
      </h3>
  
      <div class="product-price">
        <span class="price-current">$120</span>
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
  
    <!-- Producto relacionado 6 -->
    <article class="product-card">
      <span class="discount-badge">-30%</span>
      <button class="circle-btn fav-btn">
        <i class="fa-regular fa-heart"></i>
      </button>
      <button class="circle-btn view-btn">
        <i class="fa-regular fa-eye"></i>
      </button>

      <a href="product.php?id=6" class="product-image">
        <img src="assets/img/GERAL/6.png" alt="Cámara web Logitech 4k">
      </a>

      <h3 class="product-title">
        <a href="product.php?id=6">Cámara web Logitech 4k</a>
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
  
    <!-- Producto relacionado 7 -->
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
  
    <!-- Producto relacionado 8 -->
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
        <span class="rating-count">(65)</span>
      </div>
  
      <a class="btn-black add-cart-btn"
       href="cart-add.php?name=<?= urlencode($name) ?>&image=<?= $img ?>&price=<?= $price ?>">
        Añadir a la cesta
    </a>
    </article>
  
  </div>
</div>
