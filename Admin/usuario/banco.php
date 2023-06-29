<?php
$host = 'seu_host';
$port = 5432;
$banco = 'seu_banco';
$usuario = 'seu_usuario';
$senha = 'sua_senha';

try {
  $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$banco", $usuario, $senha);
} catch (PDOException $e) {
  die("Erro de conexão com o banco de dados: " . $e->getMessage());
}
?>