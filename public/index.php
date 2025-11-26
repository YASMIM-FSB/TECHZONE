<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>TechZone - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Fonte Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome (ícones) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

  <!-- HEADER / NAVBAR -->
  <?php include "partials/header.php"; ?>

  <main class="page">

    <!-- HERO PRINCIPAL -->
    <section class="hero">
      <div class="container hero-inner">
        <div class="hero-text">
          <p class="hero-tag">Computadora para juegos</p>
          <h1>Cupón de descuento de <span>hasta el 10%</span></h1>
          <a href="#" class="btn-primary hero-cta">
            Shop Now <i class="fa-solid fa-arrow-right-long"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- VENTAS RELÁMPAGO -->
    <section class="section">
      <div class="container">
        <div class="section-header">
          <div class="section-title-group">
            <span class="section-pill section-pill-purple"></span>
            <div>
              <p class="section-subtitle">Hoy</p>
              <h2 class="section-title">Ventas relámpago</h2>
            </div>
          </div>

          <div class="flash-timer">
            <div class="time-box">
              <span class="time-label">Días</span>
              <span class="time-value" id="days">03</span>
            </div>
            <div class="time-sep">:</div>
            <div class="time-box">
              <span class="time-label">Horas</span>
              <span class="time-value" id="hours">23</span>
            </div>
            <div class="time-sep">:</div>
            <div class="time-box">
              <span class="time-label">Minutos</span>
              <span class="time-value" id="minutes">19</span>
            </div>
            <div class="time-sep">:</div>
            <div class="time-box">
              <span class="time-label">Artículos de segunda clase</span>
              <span class="time-value" id="seconds">56</span>
            </div>
          </div>

          <div class="slider-arrows">
            <button class="slider-btn" id="flash-prev">
              <i class="fa-solid fa-arrow-left"></i>
            </button>
            <button class="slider-btn" id="flash-next">
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>

        <div class="products-row" id="flash-slider">
          <!-- CARD PRODUTO -->
          <?php include "partials/related-products.php"; ?>
          <?php include "partials/related-products2.php"; ?>
        </div>

        <div class="section-footer-center">
          <a href="#" class="btn-primary">Ver todos los productos</a>
        </div>
      </div>
    </section>

    <!-- CATEGORIAS (COMPUTADORAS, CAMARAS WEB, etc.) -->
    <section class="section">
      <div class="container">
        <div class="category-row">
          <button class="category-card">
            <i class="fa-solid fa-desktop"></i>
            <span>Computadoras</span>
          </button>
          <button class="category-card category-card-active">
            <i class="fa-solid fa-camera"></i>
            <span>Cámaras Web</span>
          </button>
          <button class="category-card">
            <i class="fa-solid fa-headphones"></i>
            <span>HeadPhones</span>
          </button>
          <button class="category-card">
            <i class="fa-solid fa-gamepad"></i>
            <span>Gaming</span>
          </button>
        </div>
      </div>
    </section>

    <!-- PRODUCTOS MÁS VENDIDOS -->
    <section class="section">
      <div class="container">
        <div class="section-header">
          <div class="section-title-group">
            <span class="section-pill section-pill-purple"></span>
            <div>
              <p class="section-subtitle">Este mes</p>
              <h2 class="section-title">Productos más vendidos</h2>
            </div>
          </div>
        </div>

        <div class="products-row">
          <!-- repita cards conforme necessário -->
          <?php include "partials/destaques.php"; ?>
          <!-- outros cards aqui... -->
        </div>
      </div>
    </section>

    <!-- HERO MUSICAL -->
    <section class="hero hero-dark">
      <div class="container hero-inner hero-inner-alt">
        <div class="hero-text hero-text-light">
          <p class="hero-tag">Categorías</p>
          <h2>Mejora tu experiencia musical</h2>
          <a href="#" class="btn-primary hero-cta">
            ¡Comprar ahora!
          </a>
        </div>
      </div>
    </section>

    <!-- EXPLORA NUESTROS PRODUCTOS -->
    <section class="section">
      <div class="container">
        <div class="section-header">
          <div class="section-title-group">
            <span class="section-pill section-pill-purple"></span>
            <div>
              <p class="section-subtitle">Nuestros productos</p>
              <h2 class="section-title">Explora nuestros productos</h2>
            </div>
          </div>
        </div>

        <div class="products-row" style="overflow-x: hidden;">
          <?php include "partials/nuestrosProductos.php"; ?>
        </div>

        <div class="section-footer-center">
          <a href="#" class="btn-primary">Ver todos los productos</a>
        </div>
      </div>
    </section>

    <!-- RECIÉN LLEGADO (MOSAICO) -->
    <section class="section">
      <div class="container">
        <h2 class="section-title">Recién llegado</h2>

        <div class="grid-arrivals">
          <div class="arrival-card arrival-large">
            <div class="arrival-text">
              <h3>Computadoras</h3>
              <p>Elige tus componentes y monta tu PC.</p>
            </div>
          </div>

          <div class="arrival-card">
            <div class="arrival-text">
              <h3>Cámaras Web</h3>
              <p>Cámaras de alta calidad para tus videollamadas.</p>
            </div>
          </div>

          <div class="grid-arrivals grid-arrivals2">
            <div class="arrival-card">
              <div class="arrival-text">
                <h3>HeadPhones</h3>
                <p>Un sonido fantástico</p>
              </div>
            </div>
            <div class="arrival-card">
              <div class="arrival-text perifericos">
                <h3>Gaming</h3>
                <p>Periféricos y juegos.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- BENEFÍCIOS -->
    <section class="section section-services">
      <div class="container services-row">
        <div class="service-item">
          <div class="service-icon">
            <i class="fa-solid fa-truck-fast"></i>
          </div>
          <h3>ENTREGA GRATUITA Y RÁPIDA</h3>
          <p>Envío gratuito para todos los pedidos superiores a 140 dólares.</p>
        </div>

        <div class="service-item">
          <div class="service-icon">
            <i class="fa-regular fa-clock"></i>
          </div>
          <h3>SERVICIO AL CLIENTE 24/7</h3>
          <p>Atención al cliente amigable 24/7.</p>
        </div>

        <div class="service-item">
          <div class="service-icon">
            <i class="fa-solid fa-rotate-left"></i>
          </div>
          <h3>GARANTÍA DE DEVOLUCIÓN DE DINERO</h3>
          <p>Devolvemos el dinero en un plazo de 30 días.</p>
        </div>
      </div>
    </section>

  </main>

  <!-- FOOTER -->
  <?php include "partials/footer.php"; ?>

  <script src="assets/js/main.js"></script>
</body>
</html>
