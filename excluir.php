<?php
require 'config.php'; // Inclui o arquivo de configuração, onde a conexão com o banco de dados é feita

// Verifica se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Converte o valor do parâmetro 'id' para um inteiro para garantir que seja um número válido

    // Prepara a consulta SQL para deletar a tarefa com o ID especificado
    $stmt = $pdo->prepare("DELETE FROM Tarefas WHERE id = ?"); // Usa um prepared statement para evitar SQL injection
    $stmt->execute([$id]); // Executa a consulta passando o ID da tarefa a ser excluída
}

// Redireciona o usuário de volta para a página principal (index.php) onde a lista de tarefas é exibida
header('Location: index.php');
exit; // Encerra a execução do script
?>
