<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "processo";


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Banco de dados criado com sucesso!";
} else {
    die("Erro ao criar banco de dados: " . $conn->error);
}


$conn->select_db($dbname);

// Criar a tabela 'clientes'
$sql_create_clientes = "CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
)";
if ($conn->query($sql_create_clientes) === TRUE) {
    echo "Tabela 'clientes' criada com sucesso!";
} else {
    die("Erro ao criar tabela 'clientes': " . $conn->error);
}

// Criar a tabela 'vendas'
$sql_create_vendas = "CREATE TABLE IF NOT EXISTS vendas (
    id_venda INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    produto_vendido VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
)";
if ($conn->query($sql_create_vendas) === TRUE) {
    echo "Tabela 'vendas' criada com sucesso!";
} else {
    die("Erro ao criar tabela 'vendas': " . $conn->error);
}

// Informações do cliente.
$cliente_nome = "Gustavo";
$cliente_email = "Gustavo@email.com";

// Informações da venda.
$produto_vendido = "PC Gamer";
$valor_venda = 1500;

$cliente_nome = "Guilherme";
$cliente_email = "Guilherme@email.com";

$produto_vendido = "Teclado";
$valor_venda = 700;

// Inserir dados na tabela 'clientes'
$query_cliente = "INSERT INTO clientes (nome, email) VALUES ('$cliente_nome', '$cliente_email')";
$result_cliente = $conn->query($query_cliente);

if ($result_cliente) {
    
    $id_cliente = $conn->insert_id;

    // Inserir dados na tabela 'vendas' com o ID do cliente
    $query_venda = "INSERT INTO vendas (id_cliente, produto_vendido, valor) VALUES ($id_cliente, '$produto_vendido', $valor_venda)";
    $result_venda = $conn->query($query_venda);

    if ($result_venda) {
        echo "Venda registrada com sucesso para o cliente!";
    } else {
        echo "Erro ao registrar venda: " . $conn->error;
    }
} else {
    echo "Erro ao adicionar cliente: " . $conn->error;
}


$conn->close();
?>
