<?php
session_start();

// conexão com o banco
require_once __DIR__ . "/config/db.php";

$successMessage = "";
$errors = [];

// Se enviou o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // validações simples
    if ($name === '') {
        $errors[] = "Por favor, informe su nombre.";
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Por favor, informe un correo electrónico válido.";
    }

    if ($phone === '') {
        $errors[] = "Por favor, informe su teléfono.";
    }

    if ($message === '') {
        $errors[] = "Por favor, escriba su mensaje.";
    }

    // se não tiver erro, insere no banco
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO contact_messages (name, email, phone, message)
                VALUES (:name, :email, :phone, :message)
            ");
            $stmt->execute([
                'name'    => $name,
                'email'   => $email,
                'phone'   => $phone,
                'message' => $message,
            ]);

            $successMessage = "¡Mensaje enviado con éxito! Pronto entraremos en contacto.";

            // limpa campos do formulário após sucesso
            $name = $email = $phone = $message = "";

        } catch (PDOException $e) {
            $errors[] = "Ocurrió un error al enviar su mensaje. Inténtalo de nuevo más tarde.";
        }
    }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Contacto - TechZone</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "partials/header.php"; ?>

<main class="page" style="height: 75vh;">

  <section class="section contact-page">
    <div class="container">

      <!-- Breadcrumb -->
      <nav class="breadcrumb">
        <a href="index.php">Home</a>
        <span>/</span>
        <span>Contacto</span>
      </nav>

      <div class="contact-layout">

        <!-- BLOCO DE INFORMAÇÕES -->
        <aside class="contact-info-box">

          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fa-solid fa-phone"></i>
            </div>
            <div>
              <h3 class="contact-info-title">Llama a nosotros</h3>
              <p>Estamos disponibles las 24 horas del día, los 7 días de la semana.</p>
              <p>Teléfono: +55 11 9002-8922</p>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
              <h3 class="contact-info-title">Escríbenos</h3>
              <p>Rellena nuestro formulario y nos pondremos en contacto contigo en un plazo de 24 horas.</p>
              <p>Correo electrónico:<br>apoyo@techzone.com</p>
            </div>
          </div>

        </aside>

        <!-- FORMULÁRIO -->
        <div class="contact-form-box">

          <?php if (!empty($successMessage)): ?>
            <div class="auth-alert auth-alert-success" style="margin-bottom: 1rem;">
              <?= htmlspecialchars($successMessage); ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($errors)): ?>
            <div class="auth-alert auth-alert-error" style="margin-bottom: 1rem;">
              <?php foreach ($errors as $err): ?>
                <p><?= htmlspecialchars($err); ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <form action="contacto.php" method="post" class="contact-form">

            <div class="contact-form-grid">
              <input
                type="text"
                name="name"
                placeholder="Su nombre *"
                value="<?= htmlspecialchars($name ?? '') ?>"
                required
              >
              <input
                type="email"
                name="email"
                placeholder="Tu correo electrónico *"
                value="<?= htmlspecialchars($email ?? '') ?>"
                required
              >
              <input
                type="text"
                name="phone"
                placeholder="Tu teléfono *"
                value="<?= htmlspecialchars($phone ?? '') ?>"
                required
              >
            </div>

            <textarea
              name="message"
              placeholder="Tu mensaje"
              rows="6"
            ><?= htmlspecialchars($message ?? '') ?></textarea>

            <button type="submit" class="btn-primary contact-submit">
              Enviar Mensaje
            </button>
          </form>
        </div>

      </div>

    </div>
  </section>

</main>

<?php include "partials/footer.php"; ?>

<script>
  // Remove mensagens de sucesso/erro após 3 segundos
  setTimeout(() => {
    const alerts = document.querySelectorAll(".auth-alert");
    alerts.forEach(alert => {
      alert.style.transition = "opacity .5s";
      alert.style.opacity = "0";

      setTimeout(() => alert.remove(), 500);
    });
  }, 3000);
</script> 
<script src="assets/js/main.js"></script>
</body>
</html>
