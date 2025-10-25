<?php
// login.php
session_start();
require "db.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($email && $senha) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nome'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Email ou senha incorretos.";
        }
    } else {
        $error = "Preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login</title>
<link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
  <h1>Login</h1>

  <?php if($error): ?>
    <p style="color:#ff6b6b;text-align:center;margin-bottom:12px;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form action="" method="POST">
    <label>Email:</label>
    <input type="email" name="email" placeholder="seu@email.com" required>

    <label>Senha:</label>
    <input type="password" name="senha" placeholder="••••••••" required>

    <button type="submit">Entrar</button>
  </form>

    <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
  <a href="index.html" style="display:block;margin-top:15px;color:#aaa;">⬅ Voltar ao início</a>

<script>
  // Animação de fade-in do container
  const container = document.querySelector('.container');
  container.style.opacity = 0;
  container.style.transform = 'translateY(20px)';
  setTimeout(() => {
    container.style.transition = 'all 0.6s ease';
    container.style.opacity = 1;
    container.style.transform = 'translateY(0)';
  }, 100);
</script>
</body>
</html>
