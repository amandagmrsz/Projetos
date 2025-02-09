<?php
// config.php

// Definindo as variáveis de configuração para o banco de dados
$host = 'localhost';           
$dbname = 'lista_tarefas';   // Nome do banco de dados
$user = 'root';                
$password = '';                

try {
    // Estabelecendo a conexão com o banco de dados utilizando PDO (PHP Data Objects)
    // A string de conexão usa o formato 'mysql:host=localhost;dbname=sistema_tarefas'
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    
    // Configura o modo de erro do PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Caso ocorra algum erro ao tentar conectar, o script é interrompido e uma mensagem é exibida
    die("Erro de conexão: " . $e->getMessage());
}
?>
