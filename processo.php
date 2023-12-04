<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "processo";


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sqlCreateDB) === TRUE) {
    echo "Banco de dados criado com sucesso ou já existente.<br>";
} else {
    die("Erro ao criar o banco de dados: " . $conn->error);
}


$conn->select_db($dbname);

// Criar tabela usuarios
$sqlCreateUsuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
)";
if ($conn->query($sqlCreateUsuarios) === TRUE) {
    echo "Tabela 'usuarios' criada com sucesso ou já existente.<br>";
} else {
    die("Erro ao criar a tabela 'usuarios': " . $conn->error);
}

// Criar tabela pedidos
$sqlCreatePedidos = "CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    produto VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
)";
if ($conn->query($sqlCreatePedidos) === TRUE) {
    echo "Tabela 'pedidos' criada com sucesso ou já existente.<br>";
} else {
    die("Erro ao criar a tabela 'pedidos': " . $conn->error);
}

// Função para inserir um novo usuário e registrar um pedido
function inserirUsuarioEPedido($conn, $nome, $email, $produto, $quantidade) {
    // Inserir na tabela usuarios
    $sqlInserirUsuario = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";
    $conn->query($sqlInserirUsuario);

  
    $idUsuario = $conn->insert_id;

    // Inserir na tabela pedidos
    $sqlInserirPedido = "INSERT INTO pedidos (id_usuario, produto, quantidade) VALUES ($idUsuario, '$produto', $quantidade)";
    $conn->query($sqlInserirPedido);

    echo "Usuário e pedido inseridos com sucesso.<br>";
}


$nome = "Gustavo";
$email = "Gustavo@example.com";
$produto = "PC";
$quantidade = 3;

$nome = "guilherme";
$email = "Guilherme@example.com";
$produto = "Teclado";
$quantidade = 4;

inserirUsuarioEPedido($conn, $nome, $email, $produto, $quantidade);

$conn->close();
?>
