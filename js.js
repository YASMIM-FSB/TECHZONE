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