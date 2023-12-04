<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "processo";


$conexao = new mysqli($host, $usuario, $senha);


if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}


$sql_create_db = "CREATE DATABASE IF NOT EXISTS $banco";
if ($conexao->query($sql_create_db) === TRUE) {
    echo "Banco de dados criado ou já existente. <br>";

   
    $conexao->select_db($banco);

    // Criar tabela 'alunos'. caso nao existir.
    $sql_create_alunos = "CREATE TABLE IF NOT EXISTS alunos (
        id_aluno INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(50) NOT NULL,
        turma VARCHAR(20) NOT NULL
    )";
    if ($conexao->query($sql_create_alunos) === TRUE) {
        echo "Tabela 'alunos' criada ou já existente. <br>";

        // Criar tabela 'cursos'. caso nao existir.
        $sql_create_cursos = "CREATE TABLE IF NOT EXISTS cursos (
            id_curso INT AUTO_INCREMENT PRIMARY KEY,
            nome_curso VARCHAR(50) NOT NULL,
            instrutor VARCHAR(50) NOT NULL
        )";
        if ($conexao->query($sql_create_cursos) === TRUE) {
            echo "Tabela 'cursos' criada ou já existente. <br>";

            // Criar tabela 'aluno_curso'. caso nao existir.
            $sql_create_relacionamento = "CREATE TABLE IF NOT EXISTS aluno_curso (
                id INT AUTO_INCREMENT PRIMARY KEY,
                id_aluno INT,
                id_curso INT,
                FOREIGN KEY (id_aluno) REFERENCES alunos(id_aluno),
                FOREIGN KEY (id_curso) REFERENCES cursos(id_curso)
            )";
            if ($conexao->query($sql_create_relacionamento) === TRUE) {
                echo "Tabela 'aluno_curso' criada ou já existente. <br>";

                // Dados do aluno
                $nome_aluno = "Gustavo De Oliveira Vital";
                $turma_aluno = "2";

                $nome_aluno = "Guilherme De Oliveira Vital"; // nome do meu irmao
                $turma_aluno = "3"; // sala inventei


                
                $sql_aluno = "INSERT INTO alunos (nome, turma) VALUES ('$nome_aluno', '$turma_aluno')";
                if ($conexao->query($sql_aluno) === TRUE) {
                    $id_aluno = $conexao->insert_id;

                    // Dados do curso
                    $nome_curso = "Desenvolvimento De Sistemas";
                    $instrutor_curso = "Lenon_Yuri";

                    $nome_curso = "Engenharia da computação";
                    $instrutor_curso = "Bruno"; // nome que inventei por nao saber qual o meu irmao guilherme faz na faculdade

                    
                    $sql_curso = "INSERT INTO cursos (nome_curso, instrutor) VALUES ('$nome_curso', '$instrutor_curso')";
                    if ($conexao->query($sql_curso) === TRUE) {
                        $id_curso = $conexao->insert_id;

                        $relacionamento_sql = "INSERT INTO aluno_curso (id_aluno, id_curso) VALUES ('$id_aluno', '$id_curso')";
                        if ($conexao->query($relacionamento_sql) === TRUE) {
                            echo "Dados adicionados com sucesso!";
                        } else {
                            echo "Erro ao relacionar aluno e curso: " . $conexao->error;
                        }
                    } else {
                        echo "Erro ao adicionar dados do curso: " . $conexao->error;
                    }
                } else {
                    echo "Erro ao adicionar dados do aluno: " . $conexao->error;
                }
            } else {
                echo "Erro ao criar a tabela 'aluno_curso': " . $conexao->error;
            }
        } else {
            echo "Erro ao criar a tabela 'cursos': " . $conexao->error;
        }
    } else {
        echo "Erro ao criar a tabela 'alunos': " . $conexao->error;
    }
} else {
    echo "Erro ao criar o banco de dados: " . $conexao->error;
}

$conexao->close();
?>
