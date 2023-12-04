<?php

// Nome: Gustavo De Oliveira Vital.PHP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "processo";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$categoria_table_query = "CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome_categoria VARCHAR(255) NOT NULL
)";

$produtos_table_query = "CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
)";

// Executar queries para criar tabelas
$conn->query($categoria_table_query);
$conn->query($produtos_table_query);

// Informações do produto,
$produto_nome = "Piano";
$produto_preco = 100;

// Informações da categoria.
$categoria_nome = "Instrumento";

$produto_nome = "Mouse";
$produto_preco = 200;

$categoria_nome = "Computador";

// Inserir dados na tabela 'categorias'
$query_categoria = "INSERT INTO categorias (nome_categoria) VALUES ('$categoria_nome')";
$result_categoria = $conn->query($query_categoria);

if ($result_categoria) {
   
    $id_categoria = $conn->insert_id;

    // Inserir dados na tabela 'produtos' com o ID de categoria atribuído
    $query_produto = "INSERT INTO produtos (nome_produto, preco, id_categoria) VALUES ('$produto_nome', $produto_preco, $id_categoria)";
    $result_produto = $conn->query($query_produto);

    if ($result_produto) {
        echo "Produto adicionado com sucesso com a categoria!";
    } else {
        echo "Erro ao adicionar produto: " . $conn->error;
    }
} else {
    echo "Erro ao adicionar categoria: " . $conn->error;
}


$conn->close();
?>
