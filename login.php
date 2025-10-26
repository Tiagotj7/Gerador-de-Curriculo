<?php
session_start();
require "db.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // evita o aviso: verifica se os campos existem
    if (!isset($_POST['email']) || !isset($_POST['senha'])) {
        $error = 'Preencha email e senha.';
    } else {
        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND status = 1");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // grava id do usuário na sessão (mesmo nome usado no resto do projeto)
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: listar.php");
            exit;
        } else {
            $error = 'Email ou senha inválidos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Login</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
  <h1>Login</h1>
  <?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="POST" action="login.php">
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Senha:</label>
    <input type="password" name="senha" required>
    <button type="submit">Entrar</button>
  </form>
      <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
  <a href="index.html" style="display:block;margin-top:15px;color:#aaa;">⬅ Voltar ao início</a>
</div>
</body>
</html>
