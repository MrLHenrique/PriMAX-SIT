<?php
$dbhost = '192.168.92.207';
$dbuser = 'fgmaiss';
$pass = '*!!**#!@@#?@@ZKyzi0951*%$@';
$dbname = 'teste_luiz';

include $_SERVER['DOCUMENT_ROOT'] . '/PriMAX-SIT/banco/Conexao.php';

// Estabelecer a conexão com o banco de dados
$conn = pg_connect("host=$dbhost port=5432 dbname=$dbname user=$dbuser password=$pass");

// Verificar se o ID do usuário foi passado como parâmetro na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para buscar o usuário pelo ID
    $query = "SELECT * FROM usuarios WHERE id=$id";
    $result = pg_query($conn, $query);

    // Verificar se o usuário existe
    if (pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        $nome = $row['nome'];
        $email = $row['email'];

        // Exibir o formulário com os dados do usuário
        echo "<h2>Editar Usuário</h2>";
        echo "<form method='POST' action=''>";
        echo "<label for='nome'>Nome:</label>";
        echo "<input type='text' id='nome' name='nome' value='$nome' required><br><br>";
        echo "<label for='email'>Email:</label>";
        echo "<input type='email' id='email' name='email' value='$email' required><br><br>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<a href='atualizar.php?id=".$row['id']."'>atualizar</a>";
        echo "</form>";
    } else {
        echo "Usuário não encontrado.";
    }
}

// Fechar a conexão
pg_close($conn);
?>
