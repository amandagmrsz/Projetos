<?php
require 'config.php'; // Inclui o arquivo de configuração para a conexão com o banco de dados

// Obtém o ID da tarefa e a direção (up ou down) da URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // ID da tarefa a ser movida
$direcao = isset($_GET['direcao']) ? $_GET['direcao'] : ''; // Direção (up ou down)

// Busca a tarefa atual no banco de dados
$stmt = $pdo->prepare("SELECT * FROM Tarefas WHERE id = :id");
$stmt->bindParam(':id', $id); // Vincula o ID à consulta SQL
$stmt->execute(); // Executa a consulta
$tarefaAtual = $stmt->fetch(PDO::FETCH_ASSOC); // Armazena os dados da tarefa encontrada

// Verifica se a tarefa foi encontrada
if (!$tarefaAtual) {
    die("Tarefa não encontrada."); // Se a tarefa não existir, o script é interrompido
}

// Obtém a ordem de apresentação da tarefa atual
$ordemAtual = $tarefaAtual['ordem_apresentacao']; // A ordem da tarefa no banco de dados

// Verifica a direção para saber se é para mover para cima ou para baixo
if ($direcao == 'up') {
    // Se for para cima, busca a tarefa diretamente acima da tarefa atual
    $stmt = $pdo->prepare("SELECT * FROM Tarefas WHERE ordem_apresentacao < :ordemAtual ORDER BY ordem_apresentacao DESC LIMIT 1");
} elseif ($direcao == 'down') {
    // Se for para baixo, busca a tarefa diretamente abaixo da tarefa atual
    $stmt = $pdo->prepare("SELECT * FROM Tarefas WHERE ordem_apresentacao > :ordemAtual ORDER BY ordem_apresentacao ASC LIMIT 1");
} else {
    die("Direção inválida."); // Se a direção não for nem 'up' nem 'down', termina o script com erro
}

$stmt->bindParam(':ordemAtual', $ordemAtual); // Vincula a ordem atual à consulta SQL
$stmt->execute(); // Executa a consulta
$tarefaAdjacente = $stmt->fetch(PDO::FETCH_ASSOC); // Armazena os dados da tarefa adjacente (acima ou abaixo)

// Verifica se a tarefa adjacente foi encontrada
if ($tarefaAdjacente) {
    // Usa um valor temporário para evitar conflitos de ordem
    $tempOrdem = -1; // Define um valor temporário único

    // Atualiza a ordem da tarefa atual para o valor temporário
    $stmt = $pdo->prepare("UPDATE Tarefas SET ordem_apresentacao = :tempOrdem WHERE id = :id");
    $stmt->bindParam(':tempOrdem', $tempOrdem); // Vincula o valor temporário à consulta
    $stmt->bindParam(':id', $id); // Vincula o ID da tarefa à consulta
    $stmt->execute(); // Executa a atualização

    // Atualiza a ordem da tarefa adjacente para a ordem atual da tarefa
    $stmt = $pdo->prepare("UPDATE Tarefas SET ordem_apresentacao = :ordemAtual WHERE id = :idAdjacente");
    $stmt->bindParam(':ordemAtual', $ordemAtual); // Vincula a ordem atual à consulta
    $stmt->bindParam(':idAdjacente', $tarefaAdjacente['id']); // Vincula o ID da tarefa adjacente
    $stmt->execute(); // Executa a atualização

    // Atualiza a ordem da tarefa atual para a ordem da tarefa adjacente
    $stmt = $pdo->prepare("UPDATE Tarefas SET ordem_apresentacao = :novaOrdem WHERE id = :id");
    $stmt->bindParam(':novaOrdem', $tarefaAdjacente['ordem_apresentacao']); // Vincula a ordem da tarefa adjacente à consulta
    $stmt->bindParam(':id', $id); // Vincula o ID da tarefa atual
    $stmt->execute(); // Executa a atualização
}

// Redireciona o usuário de volta para a lista de tarefas
header("Location: index.php");
exit(); // Finaliza a execução do script
?>  
