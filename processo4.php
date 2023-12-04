<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "processo";


$conn = new mysqli($servername, $username, $password, $dbname);


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

// Criar a tabela 'departamentos'
$sql_create_departamentos = "CREATE TABLE IF NOT EXISTS departamentos (
    id_departamento INT AUTO_INCREMENT PRIMARY KEY,
    nome_departamento VARCHAR(255) NOT NULL
)";
if ($conn->query($sql_create_departamentos) === TRUE) {
    echo "Tabela 'departamentos' criada com sucesso!";
} else {
    die("Erro ao criar tabela 'departamentos': " . $conn->error);
}

// Criar a tabela 'funcionarios'
$sql_create_funcionarios = "CREATE TABLE IF NOT EXISTS funcionarios (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cargo VARCHAR(255) NOT NULL,
    id_departamento INT,
    FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento)
)";
if ($conn->query($sql_create_funcionarios) === TRUE) {
    echo "Tabela 'funcionarios' criada com sucesso!";
} else {
    die("Erro ao criar tabela 'funcionarios': " . $conn->error);
}

// Inserir dados na tabela 'departamentos'
$nome_departamento = "TI";
$query_departamento = "INSERT INTO departamentos (nome_departamento) VALUES ('$nome_departamento')";
$result_departamento = $conn->query($query_departamento);

if ($result_departamento) {
    echo "Departamento registrado com sucesso!";
} else {
    echo "Erro ao registrar departamento: " . $conn->error;
}

// Informações do funcionário.
$funcionario_nome = "Gustavo";
$funcionario_cargo = "Desenvolvedor De Sistemas";

$funcionario_nome = "Guilherme";
$funcionario_cargo = "Desenvolvedor De Sistemas";

// Recuperar o ID do departamento inserido
$id_departamento = $conn->insert_id;

// Inserir dados na tabela 'funcionarios'
$query_funcionario = "INSERT INTO funcionarios (nome, cargo, id_departamento) VALUES ('$funcionario_nome', '$funcionario_cargo', $id_departamento)";
$result_funcionario = $conn->query($query_funcionario);

if ($result_funcionario) {
    echo "Funcionário registrado com sucesso!";
} else {
    echo "Erro ao registrar funcionário: " . $conn->error;
}


$conn->close();
?>
