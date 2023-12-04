<?php
// Nome: Gustavo De Oliveira Vital.PHP
function conectarBancoDados() {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "processo";

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    return $conexao;
}

// Função para criar as tabelas caso não existam.
function criarTabelas() {
    $conexao = conectarBancoDados();

    $sqlAutores = "CREATE TABLE IF NOT EXISTS autores (
        id_autor INT AUTO_INCREMENT PRIMARY KEY,
        nome_autor VARCHAR(255) NOT NULL
    )";

    $sqlLivros = "CREATE TABLE IF NOT EXISTS livros (
        id_livro INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        ano_publicacao INT
    )";

    $sqlRelacionamento = "CREATE TABLE IF NOT EXISTS livro_autor (
        id_relacao INT AUTO_INCREMENT PRIMARY KEY,
        id_livro INT,
        id_autor INT,
        FOREIGN KEY (id_livro) REFERENCES livros(id_livro),
        FOREIGN KEY (id_autor) REFERENCES autores(id_autor)
    )";

    $conexao->query($sqlAutores);
    $conexao->query($sqlLivros);
    $conexao->query($sqlRelacionamento);

    $conexao->close();
}

// Função para inserir dados na tabela autores
function inserirAutor($nomeAutor) {
    $conexao = conectarBancoDados();
    criarTabelas();  // Chama a função para criar as tabelas caso não existam

    $sql = "INSERT INTO autores (nome_autor) VALUES ('$nomeAutor')";

    if ($conexao->query($sql) === TRUE) {
        echo "Autor inserido com sucesso!";
    } else {
        echo "Erro ao inserir autor: " . $conexao->error;
    }

    $conexao->close();
}

function inserirLivro($titulo, $anoPublicacao, $idAutor) {
    $conexao = conectarBancoDados();
    criarTabelas();  // Chama a função para criar as tabelas se não existirem

    $sql = "INSERT INTO livros (titulo, ano_publicacao) VALUES ('$titulo', '$anoPublicacao')";

    if ($conexao->query($sql) === TRUE) {
        $idLivro = $conexao->insert_id;

        // Insere a relação entre livro e autor na tabela de relacionamento
        $sqlRelacionamento = "INSERT INTO livro_autor (id_livro, id_autor) VALUES ('$idLivro', '$idAutor')";
        $conexao->query($sqlRelacionamento);

        echo "Livro inserido com sucesso!";
    } else {
        echo "Erro ao inserir livro: " . $conexao->error;
    }

    $conexao->close();
}

$nomeAutor = "William Shakespeare";
inserirAutor($nomeAutor);

$tituloLivro = "Hamlet";
$anoPublicacao = 1599;
$idAutor = 1;

inserirLivro($tituloLivro, $anoPublicacao, $idAutor);

$nomeAutor = "Clarice Lispector";
inserirAutor($nomeAutor);

$tituloLivro = "A Maça no escuro";
$anoPublicacao = 1964;
$idAutor = 2;

inserirLivro($tituloLivro, $anoPublicacao, $idAutor);
?>
