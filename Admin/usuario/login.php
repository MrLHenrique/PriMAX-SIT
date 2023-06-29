<?php
session_start();

// Verificar se o usuário já está logado
if (isset($_SESSION['usuario'])) {
  header("Location: admin.php");
  exit();
}

// Verificar se os dados foram enviados através do método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  // Conectar ao banco de dados PostgreSQL
  include $_SERVER['DOCUMENT_ROOT'] . '/PriMAX-SIT/banco/Conexao.php';


  // Consulta para verificar se o usuário existe no banco de dados
  $consulta = "SELECT * FROM usuarios WHERE email = :email";
  $stmt = $pdo->prepare($consulta);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $usuario = $stmt->fetch();

  // Verificar se o usuário foi encontrado e a senha está correta
  if ($usuario && password_verify($senha, $usuario['senha'])) {
    // Iniciar a sessão e armazenar os dados do usuário logado
    $_SESSION['usuario'] = $usuario;
    header("Location: admin.php");
    exit();
  } else {
    $erro = "Email ou senha inválidos.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>
  
  <?php if (isset($erro)): ?>
    <p><?php echo $erro; ?></p>
  <?php endif; ?>
  
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required><br>
    <button type="submit">Entrar</button>
  </form>
</body>
</html>
