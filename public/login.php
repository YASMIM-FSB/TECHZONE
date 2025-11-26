<?php
// public/login.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// se já estiver logado, manda para Mi cuenta
if (isset($_SESSION['user_id'])) {
    header("Location: mi-cuenta.php");
    exit;
}

// conexão com o banco (usa o db.php fora da pasta public)
require_once __DIR__ . "/config/db.php";

$errors = [];

// trata o submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Informe um e-mail válido.";
    }

    if ($password === "") {
        $errors[] = "Informe a senha.";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("
                SELECT id, name, password_hash
                FROM users
                WHERE email = :email
                LIMIT 1
            ");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user["password_hash"])) {
                $_SESSION["user_id"]   = $user["id"];
                $_SESSION["user_name"] = $user["name"];

                header("Location: mi-cuenta.php");
                exit;
            } else {
                $errors[] = "E-mail ou senha inválidos.";
            }

        } catch (PDOException $e) {
            $errors[] = "Erro ao acessar o banco de dados.";
        }
    }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>TechZone - Iniciar sesión</title>
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
          <h1 class="auth-title">Inicie sesión en Exclusivo</h1>
          <p class="auth-subtitle">Ingresa tus datos a continuación</p>

          <?php if (!empty($errors)): ?>
            <div class="auth-alert auth-alert-error">
              <?php foreach ($errors as $err): ?>
                <p><?= htmlspecialchars($err) ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <form action="" method="post" class="auth-form">
            <div class="auth-field">
              <label for="email">Correo electrónico</label>
              <input
                type="email"
                id="email"
                name="email"
                placeholder="correo@ejemplo.com"
                value="<?= htmlspecialchars($email ?? "") ?>"
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
              Acceso
            </button>
          </form>

          <p class="auth-footer-text">
            ¿Aún no tienes una cuenta?
            <a href="cadastro.php" class="auth-link">Crear un</a>
          </p>
        </div>

      </div>
    </section>

  </main>

  <?php include "partials/footer.php"; ?>

  <script src="assets/js/main.js"></script>
</body>
</html>
