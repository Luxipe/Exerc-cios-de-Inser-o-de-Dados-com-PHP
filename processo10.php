<?php
// Nome: Gustavo De Oliveira Vital.PHP
$host = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$nome_bd = "processo";

$conexao = new mysqli($host, $usuario_bd, $senha_bd);

if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

$criarBanco = "CREATE DATABASE IF NOT EXISTS $nome_bd";
$conexao->query($criarBanco);

$conexao->select_db($nome_bd);

// Criação da tabela resultados_exames caso nao existir
$criarTabelaResultadosExames = "CREATE TABLE IF NOT EXISTS resultados_exames (
    id_resultado INT AUTO_INCREMENT PRIMARY KEY,
    tipo_exame VARCHAR(255) NOT NULL,
    resultado TEXT NOT NULL
)";
$conexao->query($criarTabelaResultadosExames);

// Criação da tabela pacientes caso nao existir
$criarTabelaPacientes = "CREATE TABLE IF NOT EXISTS pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    nome_paciente VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL
)";
$conexao->query($criarTabelaPacientes);

function adicionarExameEPaciente($tipoExame, $resultadoExame, $nomePaciente, $dataNascimentoPaciente) {
    global $conexao;

    // Inserindo novo paciente
    $inserirPaciente = "INSERT INTO pacientes (nome_paciente, data_nascimento) VALUES ('$nomePaciente', '$dataNascimentoPaciente')";
    $conexao->query($inserirPaciente);

    // Obtendo o ID do último paciente inserido
    $idPaciente = $conexao->insert_id;

    // Inserindo resultado de exame associado ao paciente
    $inserirExame = "INSERT INTO resultados_exames (tipo_exame, resultado) VALUES ('$tipoExame', '$resultadoExame')";
    $conexao->query($inserirExame);

    // Obtendo o ID do último resultado de exame inserido
    $idResultadoExame = $conexao->insert_id;

    $associarPacienteExame = "INSERT INTO pacientes_resultados_exames (id_paciente, id_resultado) VALUES ($idPaciente, $idResultadoExame)";
    $conexao->query($associarPacienteExame);

    echo "Exame adicionado e paciente associado com sucesso!";
}

$tipoExame = "Hematologia";
$resultadoExame = "Normal";
$nomePaciente = "Giovanne";
$dataNascimentoPaciente = "1990-12-06"; 

$tipoExame = "Febre";
$resultadoExame = "Baixa";
$nomePaciente = "Gabriel";
$dataNascimentoPaciente = "1990-12-04";


adicionarExameEPaciente($tipoExame, $resultadoExame, $nomePaciente, $dataNascimentoPaciente);

$conexao->close();
?>
