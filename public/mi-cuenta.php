<?php
// public/mi-cuenta.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// só entra logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/config/db.php";

$userId   = $_SESSION['user_id'];
$userName = $_SESSION['user_name'] ?? "Usuario";

$errors  = [];
$success = "";

// =========================
// 1) Se enviou o formulário, faz UPDATE
// =========================
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST['first_name'] ?? "");
    $last_name  = trim($_POST['last_name'] ?? "");
    $email      = trim($_POST['email'] ?? "");
    $address    = trim($_POST['address'] ?? "");

    // validações simples
    if ($first_name === "") {
        $errors[] = "O nome é obrigatório.";
    }

    if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Informe um e-mail válido.";
    }

    if (empty($errors)) {
        try {
            // verifica se já existe outro usuário com esse e-mail
            $stmt = $pdo->prepare("
                SELECT id FROM users
                WHERE email = :email AND id <> :id
                LIMIT 1
            ");
            $stmt->execute([
                'email' => $email,
                'id'    => $userId
            ]);
            $other = $stmt->fetch();

            if ($other) {
                $errors[] = "Este e-mail já está sendo usado por outro usuário.";
            } else {
                // faz o UPDATE
                $stmt = $pdo->prepare("
                    UPDATE users
                    SET first_name = :first_name,
                        last_name  = :last_name,
                        email      = :email,
                        address    = :address
                    WHERE id = :id
                ");

                $stmt->execute([
                    'first_name' => $first_name,
                    'last_name'  => $last_name,
                    'email'      => $email,
                    'address'    => $address,
                    'id'         => $userId
                ]);

                $success = "Dados atualizados com sucesso!";

                // atualiza o nome na sessão para aparecer no header
                $_SESSION['user_name'] = $first_name !== "" ? $first_name : $userName;
                $userName = $_SESSION['user_name'];
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao salvar as alterações no banco de dados.";
        }
    }

    // se der erro, os valores preenchidos ficam em $first_name, etc.

    // =========================
// 3) Alteração de senha
// =========================

$current_password = trim($_POST["current_password"] ?? "");
$new_password     = trim($_POST["new_password"] ?? "");
$confirm_password = trim($_POST["confirm_password"] ?? "");

if ($current_password !== "" || $new_password !== "" || $confirm_password !== "") {

    // regras
    if ($current_password === "") {
        $errors[] = "Informe a senha atual.";
    }
    if ($new_password === "") {
        $errors[] = "Informe a nova senha.";
    }
    if ($confirm_password === "") {
        $errors[] = "Confirme a nova senha.";
    }
    if ($new_password !== $confirm_password) {
        $errors[] = "A nova senha e a confirmação não coincidem.";
    }
    if (strlen($new_password) < 6) {
        $errors[] = "A nova senha deve ter ao menos 6 caracteres.";
    }

    if (empty($errors)) {
        // busca hash atual
        $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $userPwd = $stmt->fetch();

        if (!$userPwd || !password_verify($current_password, $userPwd["password_hash"])) {
            $errors[] = "A senha atual está incorreta.";
        } else {
            // gerar hash novo
            $newHash = password_hash($new_password, PASSWORD_DEFAULT);

            // atualizar no banco
            $stmt = $pdo->prepare("
                UPDATE users
                SET password_hash = :hash
                WHERE id = :id
            ");

            $stmt->execute([
                'hash' => $newHash,
                'id'   => $userId
            ]);

            $success = "Senha alterada com sucesso!";
        }
    }
}

} else {
    // =========================
    // 2) Se só abriu a página, busca dados do usuário
    // =========================
    $stmt = $pdo->prepare("
        SELECT first_name, last_name, email, address
        FROM users
        WHERE id = :id
        LIMIT 1
    ");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch();

    $first_name = $user['first_name'] ?? "";
    $last_name  = $user['last_name'] ?? "";
    $email      = $user['email'] ?? "";
    $address    = $user['address'] ?? "";
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Mi cuenta - TechZone</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

<?php include "partials/header.php"; ?>

<main class="page">

  <section class="section account-page">
    <div class="container">

      <!-- Breadcrumb + boas-vindas -->
      <div class="account-top-bar">
        <nav class="breadcrumb">
          <a href="index.php">Hogar</a>
          <span>/</span>
          <span>Mi cuenta</span>
        </nav>

        <span class="account-welcome">
          ¡Bienvenido/a <?= htmlspecialchars($userName); ?>!
        </span>
      </div>

      <div class="account-layout">

        <!-- MENU LATERAL -->
        <aside class="account-sidebar">
          <div class="account-section-title">Administrar mi cuenta</div>
          <ul class="account-menu">
            <li><a href="mi-cuenta.php" class="active">Mi perfil</a></li>
            <li><a href="#">Mis opciones de pago</a></li>
          </ul>

          <div class="account-section-title">Mis pedidos</div>
          <ul class="account-menu">
            <li><a href="#">Mis devoluciones</a></li>
            <li><a href="#">Mis Cancelaciones</a></li>
          </ul>

          <div class="account-section-title">Mi lista de deseos</div>
          <ul class="account-menu">
            <li><a href="wishlist.php">Lista de deseos</a></li>
          </ul>
        </aside>

        <!-- CONTEÚDO PRINCIPAL -->
        <section class="account-main">

          <div class="account-card">
            <h2 class="account-card-title">Edita tu perfil</h2>

            <?php if (!empty($errors)): ?>
              <div class="auth-alert auth-alert-error" style="margin-bottom:1rem;">
                <?php foreach ($errors as $err): ?>
                  <p><?= htmlspecialchars($err); ?></p>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <?php if ($success): ?>
              <div class="auth-alert auth-alert-success" style="margin-bottom:1rem;">
                <p><?= htmlspecialchars($success); ?></p>
              </div>
            <?php endif; ?>

            <form action="" method="post" class="account-form">
              <div class="account-form-grid">

                <div class="account-field">
                  <label for="first_name">Nombre de pila</label>
                  <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    value="<?= htmlspecialchars($first_name ?? ""); ?>"
                    placeholder="Nombre de pila"
                  >
                </div>

                <div class="account-field">
                  <label for="last_name">Apellido</label>
                  <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    value="<?= htmlspecialchars($last_name ?? ""); ?>"
                    placeholder="Apellido"
                  >
                </div>

                <div class="account-field">
                  <label for="email">Correo electrónico</label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($email ?? ""); ?>"
                    placeholder="correo@ejemplo.com"
                  >
                </div>

                <div class="account-field">
                  <label for="address">Dirección</label>
                  <input
                    type="text"
                    id="address"
                    name="address"
                    value="<?= htmlspecialchars($address ?? ""); ?>"
                    placeholder="Dirección completa"
                  >
                </div>

              </div>

              <div class="account-section-subtitle">Cambios de contraseña</div>

              <!-- Por enquanto, apenas visual – a lógica da senha fazemos depois -->
              <div class="account-form-grid">
                <div class="account-field">
                  <label for="current_password">Contraseña actual</label>
                  <input type="password" id="current_password" name="current_password" placeholder="Contraseña actual">
                </div>

                <div class="account-field">
                  <label for="new_password">Nueva contraseña</label>
                  <input type="password" id="new_password" name="new_password" placeholder="Nueva contraseña" >
                </div>

                <div class="account-field">
                  <label for="confirm_password">Confirmar nueva contraseña</label>
                  <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar nueva contraseña" >
                </div>
              </div>

              <div class="account-actions">
                <button type="reset" class="btn-outline-black account-cancel">
                  Cancelar
                </button>
                <button type="submit" class="btn-primary account-save">
                  Guardar cambios
                </button>
              </div>
            </form>
          </div>

        </section>

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