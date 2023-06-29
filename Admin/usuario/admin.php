<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit();
}

// Obter os dados do usuário logado
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Administrativa</title>
</head>
<body>
  <h2>Bem-vindo, <?php echo $usuario['nome']; ?>!</h2>
  <p>Esta é a página administrativa.</p>
  <a href="logout.php">Sair</a>
</body>
</html>
