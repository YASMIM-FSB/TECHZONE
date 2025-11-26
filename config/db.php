<?php
/**
 * Arquivo: config/db.php
 * Responsável pela conexão com o banco de dados usando PDO
 */

$host = "sql113.infinityfree.com";
$dbname = "if0_40410141_techzone";   // coloque aqui o nome do seu banco
$username = "if0_40410141";     // padrão do XAMPP
$password = "parkon123";         // padrão do XAMPP é vazio

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}