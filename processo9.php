<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "processo";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Adicionar evento
$nome_evento = "Desenvolvimento De Sistemas";
$data_evento = "09/10/2024";

$nome_evento = "Programação";
$data_evento = "09/10/2024";
$sql_evento = "INSERT INTO eventos (nome_evento, data) VALUES ('$nome_evento', '$data_evento')";
$conn->query($sql_evento);


$id_evento = $conn->insert_id;

 
$sql_create_table = "CREATE TABLE IF NOT EXISTS participantes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_evento INT(6) UNSIGNED,
    nome_participante VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_evento) REFERENCES eventos(id)
)";

$conn->query($sql_create_table);

// vai mostrar a Lista de participantes
$participantes = ["Gustavo", "Otavio", "Adler"];

// vai Adicionar participantes
foreach ($participantes as $nome_participante) {
    $sql_participante = "INSERT INTO participantes (id_evento, nome_participante) VALUES ('$id_evento', '$nome_participante')";
    $conn->query($sql_participante);
}

echo "Evento e participantes registrados com sucesso!"; // Evento e participantes registrados com sucesso, caso der certo.


$conn->close();
?>
