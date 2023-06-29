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

// Comando SQL para criar a tabela "usuarios"
$queryCreateTable = "CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255),
    email VARCHAR(255),
    senha VARCHAR(255)
)";

// Executar o comando SQL para criar a tabela

// Verificar se a tabela foi criada com sucesso


// Estabelecer a conexão com o banco de dados
$conn = pg_connect("host=$dbhost port=5432 dbname=$dbname user=$dbuser password=$pass");

// Verificar se a conexão foi estabelecida com sucesso
if (!$conn) {
    echo "Erro ao conectar ao banco de dados PostgreSQL.";
    exit;
}

// Consulta para selecionar todos os registros da tabela "usuarios"
$query = "SELECT * FROM usuarios";
$result = pg_query($conn, $query);

// Verificar se a consulta foi executada com sucesso
if (!$result) {
    echo "Erro ao executar a consulta.";
    exit;
}

// Exibir os registros cadastrados
echo "<h2>Lista de Usuários Cadastrados</h2>";

if (pg_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nome</th><th>Email</th></tr>";

    while ($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum usuário cadastrado.";
}

// Fechar a conexão
pg_close($conn);
?>
