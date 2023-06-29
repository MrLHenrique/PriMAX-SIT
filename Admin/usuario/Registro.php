<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PriMAX-SIT/banco/Conexao.php';

// Função para excluir um usuário
function excluirUsuario($conn, $id) {
    $query = "DELETE FROM usuarios WHERE id = $id";
    $result = pg_query($conn, $query);
    return $result;
}

// Estabelecer a conexão com o banco de dados
$conn = pg_connect("host=$dbhost port=5432 dbname=$dbname user=$dbuser password=$pass");

// Verificar se a conexão foi estabelecida com sucesso
if (!$conn) {
    echo "Erro ao conectar ao banco de dados PostgreSQL.";
    exit;
}

// Verificar se o botão "Editar" foi acionado
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    // Redirecionar para a página de edição do usuário passando o ID como parâmetro
    header("Location: atualizar.php?id=$id");
    exit; // Certifique-se de sair após o redirecionamento
}

// Verificar se os dados foram enviados através do método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o botão "Excluir" foi acionado
    if (isset($_POST['excluir'])) {
        $id = $_POST['id'];
        $excluir = excluirUsuario($conn, $id);

        if ($excluir) {
            echo "Usuário excluído com sucesso.";
            // Atualizar a página para refletir as alterações
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Erro ao excluir usuário.";
        }
    }
}

// Consulta para selecionar todos os usuários
$query = "SELECT * FROM usuarios";
$result = pg_query($conn, $query);

// Verificar se a consulta foi executada com sucesso
if (!$result) {
    echo "Erro ao executar a consulta.";
    exit;
}

// Verificar se existem registros de usuários
if (pg_num_rows($result) > 0) {
    // Exibir a tabela de usuários
    echo "<h2>Lista de Usuários Cadastrados</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr>";

    while ($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['nome']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>";
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "<input type='submit' name='excluir' value='Excluir'>";
        echo "<input type='submit' name='editar' value='Editar'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }    

    echo "</table>";
} else {
    echo "Nenhum usuário cadastrado.";
}

// Fechar a conexão
pg_close($conn);
?>
