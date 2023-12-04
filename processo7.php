<?php
// Nome: Gustavo De Oliveira Vital.PHP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "processo";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

function adicionarFornecedorECompra($nome, $contato, $produtoComprado, $quantidade) {
    global $conn;

     // Adicionar fornecedor à tabela fornecedores
    $sqlInserirFornecedor = "INSERT INTO fornecedores (nome, contato) VALUES ('$nome', '$contato')";
    if ($conn->query($sqlInserirFornecedor) === TRUE) {
        $idFornecedor = $conn->insert_id;                

        // Registrar compra na tabela compras
        $sqlInserirCompra = "INSERT INTO compras (id_fornecedor, produto_comprado, quantidade) VALUES ('$idFornecedor', '$produtoComprado', '$quantidade')";
        if ($conn->query($sqlInserirCompra) === TRUE) {
            echo "Fornecedor e compra registrados com sucesso.";
        } else {
            echo "Erro ao registrar compra: " . $conn->error;     
        }
    } else {
        echo "Erro ao adicionar fornecedor: " . $conn->error;
    }
}

$nomeFornecedor = "Gustavo";
$contatoFornecedor = "Guilherme";
$produtoComprado = "Pc";
$quantidade = 10;

$nomeFornecedor = "Gabriel";
$contatoFornecedor = "Vinicius";
$produtoComprado = "Mouse";
$quantidade = 20;
adicionarFornecedorECompra($nomeFornecedor, $contatoFornecedor, $produtoComprado, $quantidade);


$conn->close();

?>
