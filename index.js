 // Defina a data-alvo da contagem regressiva (ano, mês-1, dia, hora, minuto, segundo)
  const targetDate = new Date("Nov 27, 2025 23:59:59").getTime();

  const timer = setInterval(() => {
    const now = new Date().getTime();
    const diff = targetDate - now;

    // Cálculo de tempo
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

    // Atualiza no HTML
    document.getElementById("days").textContent = days.toString().padStart(2, '0');
    document.getElementById("hours").textContent = hours.toString().padStart(2, '0');
    document.getElementById("minutes").textContent = minutes.toString().padStart(2, '0');
    document.getElementById("seconds").textContent = seconds.toString().padStart(2, '0');

    // Quando chegar a zero
    if (diff < 0) {
      clearInterval(timer);
      document.getElementById("timer").innerHTML = "<h3>Promoção encerrada!</h3>";
    }
  }, 1000);


  // carrossel

  const carrossel = document.querySelector('.carrossel');

let isDown = false;
let startX;
let scrollLeft;

carrossel.addEventListener('mousedown', (e) => {
  isDown = true;
  carrossel.classList.add('active');
  startX = e.pageX - carrossel.offsetLeft;
  scrollLeft = carrossel.scrollLeft;
});

carrossel.addEventListener('mouseleave', () => {
  isDown = false;
  carrossel.classList.remove('active');
});

carrossel.addEventListener('mouseup', () => {
  isDown = false;
  carrossel.classList.remove('active');
});

carrossel.addEventListener('mousemove', (e) => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - carrossel.offsetLeft;
  const walk = (x - startX) * 1.5; // Velocidade do arrasto
  carrossel.scrollLeft = scrollLeft - walk;
});

// Suporte para toque (mobile)
let touchStartX = 0;
let touchScrollLeft = 0;

carrossel.addEventListener('touchstart', (e) => {
  touchStartX = e.touches[0].pageX - carrossel.offsetLeft;
  touchScrollLeft = carrossel.scrollLeft;
});

carrossel.addEventListener('touchmove', (e) => {
  const x = e.touches[0].pageX - carrossel.offsetLeft;
  const walk = (x - touchStartX) * 1.5;
  carrossel.scrollLeft = touchScrollLeft - walk;
})

//Adicionar ao carrinho div
const cards = document.querySelectorAll('.card');

cards.forEach(card => {
  const addCarrinho = card.querySelector('.add-carrinho');
  
  card.addEventListener('mouseenter', () => {
    addCarrinho.classList.remove('opacity-0');
    addCarrinho.classList.add('opacity-100');
  });

  card.addEventListener('mouseleave', () => {
    addCarrinho.classList.remove('opacity-100');
    addCarrinho.classList.add('opacity-0');
  });
});