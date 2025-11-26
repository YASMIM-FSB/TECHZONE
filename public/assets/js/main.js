// Contador simples de exemplo (3 dias a partir de agora)
const endDate = new Date();
endDate.setDate(endDate.getDate() + 3);

function updateCountdown() {
  const now = new Date().getTime();
  const distance = endDate.getTime() - now;

  const d = Math.max(0, Math.floor(distance / (1000 * 60 * 60 * 24)));
  const h = Math.max(0, Math.floor((distance / (1000 * 60 * 60)) % 24));
  const m = Math.max(0, Math.floor((distance / (1000 * 60)) % 60));
  const s = Math.max(0, Math.floor((distance / 1000) % 60));

  const daysEl = document.getElementById("days");
  const hoursEl = document.getElementById("hours");
  const minutesEl = document.getElementById("minutes");
  const secondsEl = document.getElementById("seconds");

  if (daysEl) {
    daysEl.textContent = String(d).padStart(2, "0");
    hoursEl.textContent = String(h).padStart(2, "0");
    minutesEl.textContent = String(m).padStart(2, "0");
    secondsEl.textContent = String(s).padStart(2, "0");
  }
}

setInterval(updateCountdown, 1000);
updateCountdown();

// Slider horizontal simples (scroll)
const flashSlider = document.getElementById("flash-slider");
const flashPrev = document.getElementById("flash-prev");
const flashNext = document.getElementById("flash-next");

if (flashSlider && flashPrev && flashNext) {
  // pega a largura de um card pra deslizar bloco a bloco
  const card = flashSlider.querySelector(".product-card");
  const scrollAmount = card ? card.offsetWidth + 20 : 280;

  flashPrev.addEventListener("click", () => {
    flashSlider.scrollBy({
      left: -scrollAmount,
      behavior: "smooth",
    });
  });

  flashNext.addEventListener("click", () => {
    flashSlider.scrollBy({
      left: scrollAmount,
      behavior: "smooth",
    });
  });
}


// Dropdown do usuário (quando logado)
const userToggle = document.getElementById("user-menu-toggle");
const userDropdown = document.getElementById("user-dropdown");

if (userToggle && userDropdown) {
  userToggle.addEventListener("click", (e) => {
    e.stopPropagation(); // não deixa o clique fechar imediatamente
    userDropdown.classList.toggle("open");
  });

  // fecha ao clicar fora
  document.addEventListener("click", () => {
    userDropdown.classList.remove("open");
  });

  // evita fechar se clicar dentro do menu
  userDropdown.addEventListener("click", (e) => {
    e.stopPropagation();
  });
}


// ===== CÁLCULO DO CARRINHO =====
const cartRows = document.querySelectorAll(".cart-item-row");
const subtotalSumEl = document.getElementById("cart-subtotal-sum");
const totalEl = document.getElementById("cart-total");
const btnUpdateCart = document.getElementById("btn-update-cart");

function calcularTotaisCarrinho() {
  let subtotal = 0;

  cartRows.forEach((row) => {
    const price = Number(row.dataset.price || 0);
    const qtySelect = row.querySelector(".cart-qty-select");
    const subtotalSpan = row.querySelector(".cart-subtotal");

    const qty = qtySelect ? Number(qtySelect.value) : 1;
    const itemSubtotal = price * qty;

    subtotal += itemSubtotal;

    if (subtotalSpan) {
      subtotalSpan.textContent = itemSubtotal.toString();
    }
  });

  if (subtotalSumEl) subtotalSumEl.textContent = subtotal.toString();
  if (totalEl) totalEl.textContent = subtotal.toString(); // sem frete
}

// atualiza quando mudar a quantidade
cartRows.forEach((row) => {
  const qtySelect = row.querySelector(".cart-qty-select");
  if (qtySelect) {
    qtySelect.addEventListener("change", calcularTotaisCarrinho);
  }
});

// botão "Atualizar carrito"
if (btnUpdateCart) {
  btnUpdateCart.addEventListener("click", calcularTotaisCarrinho);
}

// roda 1x ao carregar
if (cartRows.length) {
  calcularTotaisCarrinho();
}

// ===== Troca imagem principal =====
const thumbImgs = document.querySelectorAll(".thumb-img");
const mainImg = document.getElementById("main-product-img");

thumbImgs.forEach((thumb) => {
  thumb.addEventListener("click", () => {
    mainImg.src = thumb.src;
    thumbImgs.forEach(t => t.classList.remove("active-thumb"));
    thumb.classList.add("active-thumb");
  });
});

// ===== Quantidade =====
const qtyMinus = document.getElementById("qty-minus");
const qtyPlus = document.getElementById("qty-plus");
const qtyNum = document.getElementById("qty-number");

if (qtyMinus && qtyPlus && qtyNum) {
  qtyMinus.addEventListener("click", () => {
    let n = parseInt(qtyNum.textContent);
    if (n > 1) qtyNum.textContent = n - 1;
  });

  qtyPlus.addEventListener("click", () => {
    let n = parseInt(qtyNum.textContent);
    qtyNum.textContent = n + 1;
  });
}

// ===== ADICIONAR AO CARRINHO (COM DELEGAÇÃO) =====
document.addEventListener("click", function (event) {
  const btnCart = event.target.closest(".add-cart-btn");
  if (!btnCart) return;

  event.preventDefault();

  const card = btnCart.closest(".product-card");
  if (!card) {
    console.warn("Nenhum .product-card encontrado para este botão de carrinho.");
    return;
  }

  const titleEl    = card.querySelector(".product-title");
  const imgEl      = card.querySelector(".product-image img");
  const priceEl    = card.querySelector(".price-current");

  const name   = titleEl ? titleEl.textContent.trim() : "";
  const image  = imgEl ? imgEl.getAttribute("src") : "";
  const price  = priceEl ? priceEl.textContent.replace(/[^0-9.,]/g, "").replace(",", ".") : "";

  if (!name || !price) {
    console.warn("Dados insuficientes para adicionar ao carrinho.", { name, price });
    return;
  }

  // se tiver quantidade na página de produto, você pode ler aqui depois
  const qty = 1;

  const params = new URLSearchParams();
  params.set("name", name);
  params.set("image", image);
  params.set("price", price);
  params.set("qty", qty);

  // redireciona para o PHP que salva o carrinho na sessão
  window.location.href = "cart-add.php?" + params.toString();
});


// ===== ADICIONAR À WISHLIST (COM DELEGAÇÃO — FUNCIONA EM QUALQUER LUGAR) =====
document.addEventListener("click", function (event) {
  const btn = event.target.closest(".fav-btn");
  if (!btn) return;

  event.preventDefault();

  const card = btn.closest(".product-card");
  if (!card) {
    console.warn("Nenhum .product-card encontrado para este botão.");
    return;
  }

  const titleEl    = card.querySelector(".product-title");
  const imgEl      = card.querySelector(".product-image img");
  const priceEl    = card.querySelector(".price-current");
  const oldPriceEl = card.querySelector(".price-old");
  const discountEl = card.querySelector(".discount-badge");

  const name   = titleEl ? titleEl.textContent.trim() : "";
  const image  = imgEl ? imgEl.getAttribute("src") : "";
  const price  = priceEl ? priceEl.textContent.replace(/[^0-9.,]/g, "").replace(",", ".") : "";
  const oldP   = oldPriceEl ? oldPriceEl.textContent.replace(/[^0-9.,]/g, "").replace(",", ".") : "";
  const disc   = discountEl ? discountEl.textContent.replace(/[^0-9]/g, "") : "";

  if (!name || !image || !price) {
    console.warn("Dados insuficientes para adicionar à wishlist.", { name, image, price });
    return;
  }

  const params = new URLSearchParams();
  params.set("name", name);
  params.set("image", image);
  params.set("price", price);

  if (oldP) params.set("old_price", oldP);
  if (disc) params.set("discount", disc);

  window.location.href = "wishlist-add.php?" + params.toString();
});

// no main.js (já tem bloco de qty)
const buyButton = document.querySelector(".btn-primary"); // ajusta seletor se precisar

if (buyButton && qtyNum) {
  buyButton.addEventListener("click", function (e) {
    e.preventDefault();
    const qty = parseInt(qtyNum.textContent) || 1;
    const baseUrl = this.getAttribute("href");
    window.location.href = baseUrl + "&qty=" + qty;
  });
}


// ===== MENU HAMBÚRGUER (MOBILE) =====
const navToggle = document.getElementById("nav-toggle");
const navMenu   = document.getElementById("nav-menu");

if (navToggle && navMenu) {
  navToggle.addEventListener("click", (e) => {
    e.stopPropagation();
    navMenu.classList.toggle("open");
  });

  // fecha ao clicar fora
  document.addEventListener("click", (e) => {
    const clickInsideMenu   = navMenu.contains(e.target);
    const clickOnToggleBtn  = navToggle.contains(e.target);
    if (!clickInsideMenu && !clickOnToggleBtn) {
      navMenu.classList.remove("open");
    }
  });

  // fecha ao clicar em algum link do menu
  navMenu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      navMenu.classList.remove("open");
    });
  });
}
