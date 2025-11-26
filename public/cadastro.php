<?php
// public/cadastro.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// se já estiver logado, se quiser pode redirecionar:
// if (isset($_SESSION['user_id'])) {
//     header("Location: mi-cuenta.php");
//     exit;
// }

require_once __DIR__ . "/config/db.php";

$errors  = [];
$success = "";
$name    = "";
$email   = "";

// Tratamento do submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = trim($_POST["name"] ?? "");
    $email    = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    // Validações
    if ($name === "") {
        $errors[] = "O nome é obrigatório.";
    }

    if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Informe um e-mail válido.";
    }

    if (strlen($password) < 6) {
        $errors[] = "A senha deve ter pelo menos 6 caracteres.";
    }

    if (empty($errors)) {
        try {
            // Verifica se já existe e-mail cadastrado
            $stmt = $pdo->prepare("
                SELECT id FROM users
                WHERE email = :email
                LIMIT 1
            ");
            $stmt->execute(['email' => $email]);
            $existing = $stmt->fetch();

            if ($existing) {
                $errors[] = "Este e-mail já está cadastrado.";
            } else {
                // Cria hash da senha
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Insere usuário
                $stmt = $pdo->prepare("
                    INSERT INTO users (name, email, password_hash)
                    VALUES (:name, :email, :password_hash)
                ");

                $stmt->execute([
                    'name'          => $name,
                    'email'         => $email,
                    'password_hash' => $passwordHash,
                ]);

                $success = "Conta criada com sucesso! Você já pode fazer login.";
                // limpa campos
                $name  = "";
                $email = "";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao salvar no banco de dados.";
        }
    }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>TechZone - Crear una cuenta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

  <?php include "partials/header.php"; ?>

  <main class="page">

    <section class="section auth-section">
      <div class="container auth-grid">

        <!-- LADO ESQUERDO: IMAGEM -->
        <div class="auth-illustration">
          <img src="assets/img/imgCadastro.png" alt="E-commerce illustration">
        </div>

        <!-- LADO DIREITO: FORMULÁRIO -->
        <div class="auth-card">
          <h1 class="auth-title">Crear una cuenta</h1>
          <p class="auth-subtitle">Ingresa tus datos a continuación</p>

          <!-- mensagens de erro / sucesso -->
          <?php if (!empty($errors)): ?>
            <div class="auth-alert auth-alert-error">
              <?php foreach ($errors as $err): ?>
                <p><?= htmlspecialchars($err) ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <?php if ($success): ?>
            <div class="auth-alert auth-alert-success">
              <p><?= htmlspecialchars($success) ?></p>
            </div>
          <?php endif; ?>

          <form action="" method="post" class="auth-form">
            <div class="auth-field">
              <label for="name">Nombre</label>
              <input
                type="text"
                id="name"
                name="name"
                placeholder="Nombre completo"
                value="<?= htmlspecialchars($name) ?>"
                required
              >
            </div>

            <div class="auth-field">
              <label for="email">Correo electrónico</label>
              <input
                type="email"
                id="email"
                name="email"
                placeholder="correo@ejemplo.com"
                value="<?= htmlspecialchars($email) ?>"
                required
              >
            </div>

            <div class="auth-field">
              <label for="password">Contraseña</label>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
              >
            </div>

            <button type="submit" class="btn-primary auth-submit">
              Crear una cuenta
            </button>
          </form>

          <p class="auth-footer-text">
            ¿Ya tienes cuenta?
            <a href="login.php" class="auth-link">Acceso</a>
          </p>
        </div>

      </div>
    </section>

  </main>

  <?php include "partials/footer.php"; ?>

  <script>
    // sumir mensagens depois de 3s (mesma lógica do mi-cuenta)
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
