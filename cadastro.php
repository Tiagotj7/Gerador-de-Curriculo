<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Cadastro de Usuário</title>
<link rel="stylesheet" href="cadastro.css">
</head>
<body>
<div class="container">
  <h1>Cadastro de Usuário</h1>
  <form action="salvar_usuario.php" method="POST">
    <label>Nome completo:</label>
    <input type="text" name="nome" placeholder="Seu nome completo" required>

    <label>Email:</label>
    <input type="email" name="email" placeholder="seu@email.com" required>

    <label>Senha:</label>
    <input type="password" name="senha" placeholder="••••••••" required>

    <button type="submit">Cadastrar</button>
  </form>
    <p>Já tem conta? <a href="login.php">Entrar</a></p>
  <a href="index.html" style="display:block;margin-top:15px;color:#aaa;">⬅ Voltar ao início</a>
</div>
</body>
</html>
