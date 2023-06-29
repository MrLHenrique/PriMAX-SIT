<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cadastro de Usuário</title>
    
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

</head>
<body>
    <h1>Cadastro de Usuário</h1>

    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="confirmar_senha">Confirmar Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>

    <?php
   $dbhost = '192.168.92.207';
   $dbuser = 'fgmaiss';
   $pass = '*!!**#!@@#?@@ZKyzi0951*%$@';
   $dbname = 'teste_luiz';

    // Estabelecer a conexão com o banco de dados
    $conn = pg_connect("host=$dbhost port=5432 dbname=$dbname user=$dbuser password=$pass");

    // Verificar se a conexão foi estabelecida com sucesso
    if (!$conn) {
        echo "Erro ao conectar ao banco de dados PostgreSQL.";
        exit;
    }

    // Verificar se os dados foram enviados através do método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $confirmarSenha = $_POST["confirmar_senha"];

        // Verificar se as senhas coincidem
        if ($senha != $confirmarSenha) {
            echo "As senhas não coincidem.";
            exit;
        }

        // Verificar se o email já está cadastrado
        $queryVerificarEmail = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultVerificarEmail = pg_query($conn, $queryVerificarEmail);
        if (pg_num_rows($resultVerificarEmail) > 0) {
            echo "Este email já está cadastrado.";
            exit;
        }

        // Verificar se o nome de usuário já está cadastrado
        $queryVerificarNome = "SELECT * FROM usuarios WHERE nome = '$nome'";
        $resultVerificarNome = pg_query($conn, $queryVerificarNome);
        if (pg_num_rows($resultVerificarNome) > 0) {
            echo "Este nome de usuário já está cadastrado.";
            exit;
        }

        // Consulta para inserir os dados na tabela
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
        $result = pg_query($conn, $query);

        // Verificar se a consulta foi executada com sucesso
        if (!$result) {
            echo "Erro ao cadastrar usuário.";
            exit;
        }

        echo "Usuário cadastrado com sucesso!";
    }

    // Fechar a conexão
    pg_close($conn);
    ?>
</body>
</html>
