<?php
session_start();
ob_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PriMAX-SIT/banco/Conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location: Cadastro.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Atualizar os dados do usuário no banco de dados
    $query_update = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = $id";

    // Reabrir a conexão com o banco de dados
    $conn = pg_connect("host=$dbhost port=5432 dbname=$dbname user=$dbuser password=$pass");

    if (pg_query($conn, $query_update)) {
        $_SESSION['msg'] = "<p style='color: #0f0;'>Usuário atualizado com sucesso!</p>";
        header("Location: Cadastro.php");
        exit();
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro ao atualizar usuário!</p>";
        header("Location: Cadastro.php");
        exit();
    }
}

// Reabrir a conexão com o banco de dados
$conn = pg_connect("host=$dbhost port=5432 dbname=$dbname user=$dbuser password=$pass");

// Consultar os dados do usuário
$query_usuario = "SELECT id, nome, email FROM usuarios WHERE id = $id LIMIT 1";
$result_usuario = pg_query($conn, $query_usuario);

if (pg_num_rows($result_usuario) != 0) {
    $row_usuario = pg_fetch_assoc($result_usuario);
    extract($row_usuario);

    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Atualização</title>
        </head>
        <body>
            <a href="Registro.php">Listar</a><br>
            <a href="cadastrar.php">Cadastrar</a><br>

            <h1>Visualizar</h1>

            <form method="POST" action="">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required><br><br>
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
    <button type="submit">Atualizar</button>
    </form>


            <script>
                window.onload = function() {
                    document.querySelector('form').addEventListener('submit', function() {
                        alert('Usuário atualizado com sucesso!');
                        window.location.href = "Cadastro.php";
                    });
                };
            </script>
        </body>
    </html>

    <?php
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location Cadastro.php");
    exit();
}
?>
