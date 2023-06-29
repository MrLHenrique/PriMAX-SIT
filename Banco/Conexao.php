<?php
$dbhost = '192.168.92.207';
$dbuser = 'fgmaiss';
$pass = '*!!**#!@@#?@@ZKyzi0951*%$@';
$dbname = 'bdconvenio';

// Estabelecer a conexão com o banco de dados
$conn = pg_connect("host=$dbhost port=5432 dbname=$dbname user=$dbuser password=$pass");

// Verificar se a conexão foi estabelecida com sucesso
if (!$conn) {
    echo "Erro ao conectar ao banco de dados PostgreSQL.";
    exit;
}

echo "Conexão bem-sucedida com o banco de dados PostgreSQL.";

// Agora você pode executar consultas ou realizar outras operações no banco de dados

// Fechar a conexão
pg_close($conn);
?>

