<?php
// Configuração do banco de dados
$host = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$nome_bd = "processo";

// Conexão com o banco de dados
$conexao = new mysqli($host, $usuario_bd, $senha_bd);

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

// Criação da base de dados se não existir
$criarBanco = "CREATE DATABASE IF NOT EXISTS $nome_bd";
$conexao->query($criarBanco);

// Seleciona o banco de dados
$conexao->select_db($nome_bd);

// Criação da tabela resultados_exames se não existir
$criarTabelaResultadosExames = "CREATE TABLE IF NOT EXISTS resultados_exames (
    id_resultado INT AUTO_INCREMENT PRIMARY KEY,
    tipo_exame VARCHAR(255) NOT NULL,
    resultado TEXT NOT NULL
)";
$conexao->query($criarTabelaResultadosExames);

// Criação da tabela pacientes se não existir
$criarTabelaPacientes = "CREATE TABLE IF NOT EXISTS pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    nome_paciente VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL
)";
$conexao->query($criarTabelaPacientes);

// Função para adicionar novo resultado de exame e associar paciente
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

    // Associando o paciente ao resultado de exame
    $associarPacienteExame = "INSERT INTO pacientes_resultados_exames (id_paciente, id_resultado) VALUES ($idPaciente, $idResultadoExame)";
    $conexao->query($associarPacienteExame);

    echo "Exame adicionado e paciente associado com sucesso!";
}

// Exemplo de uso
$tipoExame = "Hematologia";
$resultadoExame = "Normal";
$nomePaciente = "Maria";
$dataNascimentoPaciente = "1990-05-15"; // Formato: AAAA-MM-DD

adicionarExameEPaciente($tipoExame, $resultadoExame, $nomePaciente, $dataNascimentoPaciente);

// Fechar a conexão com o banco de dados
$conexao->close();
?>
