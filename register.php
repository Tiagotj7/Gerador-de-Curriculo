
<?php
session_start();
require "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $password]);
        
        $_SESSION['user_id'] = $pdo->lastInsertId();
        header("Location: listar.php");
        exit;
    } catch (PDOException $e) {
        $error = "Email já cadastrado";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
      <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Registro</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        
        <form method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Senha:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Registrar</button>
            <p>Já tem conta? <a href="login.php">Faça login</a></p>
        </form>
    </div>
</body>
</html>