<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PriMAX-SIT/banco/Conexao.php';

// Verificar se o ID do usuário foi fornecido
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Estabelecer a conexão com o banco de dados
    $conn = pg_connect("host=$dbhost port=5432 dbname=$dbname user=$dbuser password=$pass");

    // Verificar se a conexão foi estabelecida com sucesso
    if (!$conn) {
        echo "Erro ao conectar ao banco de dados PostgreSQL.";
        exit;
    }

    // Consulta para excluir o usuário com base no ID
    $query = "DELETE FROM usuarios WHERE id=$id";
    $result = pg_query($conn, $query);

    // Verificar se o usuário foi excluído com sucesso
    if ($result) {
        echo "Usuário excluído com sucesso.";
    } else {
        echo "Erro ao excluir usuário.";
    }

    // Fechar a conexão
    pg_close($conn);
} else {
    echo "ID de usuário não fornecido.";
}
?>
