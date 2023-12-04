<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "processo";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criação da tabela 'projetos'
$sql_create_projetos = "CREATE TABLE IF NOT EXISTS projetos (
    id_projeto INT PRIMARY KEY,
    nome_projeto VARCHAR(255),
    descricao VARCHAR(255)
)";

if ($conn->query($sql_create_projetos) === TRUE) {
    echo "Tabela 'projetos' criada com sucesso ou já existe.\n";
} else {
    echo "Erro ao criar tabela 'projetos': " . $conn->error . "\n";
}

// Criação da tabela 'atribuicoes'
$sql_create_atribuicoes = "CREATE TABLE IF NOT EXISTS atribuicoes (
    id_atribuicao INT PRIMARY KEY,
    id_projeto INT,
    id_funcionario INT,
    FOREIGN KEY (id_projeto) REFERENCES projetos(id_projeto)
)";

if ($conn->query($sql_create_atribuicoes) === TRUE) {
    echo "Tabela 'atribuicoes' criada com sucesso ou já existe.\n";
} else {
    echo "Erro ao criar tabela 'atribuicoes': " . $conn->error . "\n";
}

// Detalhes do projeto
$id_projeto = 1; 
$nome_projeto = "Xman";
$descricao_projeto = "Esse projeto ajuda a compreender o filme e melhorar";


$id_projeto= 2;
$nome_projeto = "Programação";
$descricao_projeto = "Esse projeto ajuda a melhorar e compreender a base da programação";

$sql_projeto = "INSERT INTO projetos (id_projeto, nome_projeto, descricao) VALUES ($id_projeto, '$nome_projeto', '$descricao_projeto')";

if ($conn->query($sql_projeto) === TRUE) {
    echo "Detalhes do projeto inseridos com sucesso.\n";
} else {
    echo "Erro ao inserir detalhes do projeto: " . $conn->error . "\n";
}

// Detalhes da atribuição
$id_atribuicao = 1; 
$id_funcionario = 1; 

$id_atribuicao = 2;
$id_funcionario = 2;


$sql_atribuicao = "INSERT INTO atribuicoes (id_atribuicao, id_projeto, id_funcionario) VALUES ($id_atribuicao, $id_projeto, $id_funcionario)";

if ($conn->query($sql_atribuicao) === TRUE) {
    echo "Funcionário associado ao projeto com sucesso.\n";
} else {
    echo "Erro ao associar funcionário ao projeto: " . $conn->error . "\n";
}


$conn->close();
?>
