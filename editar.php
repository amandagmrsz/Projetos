<?php
// editar.php
require 'config.php'; // Inclui o arquivo de configuração que contém a conexão com o banco de dados

// Verifica se o ID da tarefa foi fornecido na URL
if (!isset($_GET['id'])) {
    die("ID da tarefa não fornecido."); // Se não foi fornecido o ID, encerra o script com uma mensagem de erro
}

// Obtém o ID da tarefa da URL
$id = (int)$_GET['id']; // Converte o ID para um número inteiro para evitar falhas de segurança
$stmt = $pdo->prepare("SELECT * FROM Tarefas WHERE id = ?"); // Prepara a consulta para buscar a tarefa pelo ID
$stmt->execute([$id]); // Executa a consulta passando o ID
$tarefa = $stmt->fetch(); // Obtém o resultado da consulta

if (!$tarefa) {
    die("Tarefa não encontrada."); // Se a tarefa não for encontrada, encerra o script com uma mensagem de erro
}

// Processa o formulário de edição quando ele é submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $custo = $_POST['custo'];
    $data_limite = $_POST['data_limite'];
    $comentarios = $_POST['comentarios'];

    // Verifica se o novo nome da tarefa já existe no banco de dados (exceto para o próprio ID)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Tarefas WHERE nome = ? AND id != ?"); 
    $stmt->execute([$nome, $id]);
    $exists = $stmt->fetchColumn(); // Obtém o número de tarefas com o mesmo nome, excluindo a tarefa atual

    if ($exists > 0) {
        // Se o nome já existir, exibe uma mensagem de erro
        $error_message = "O nome da tarefa já existe. Por favor, escolha outro nome.";
    } else {
        // Caso contrário, atualiza os dados da tarefa no banco de dados
        $stmt = $pdo->prepare("UPDATE Tarefas SET nome = ?, custo = ?, data_limite = ?, comentarios = ? WHERE id = ?");
        $stmt->execute([$nome, $custo, $data_limite, $comentarios, $id]); // Executa a atualização
        header("Location: index.php"); // Redireciona para a página principal
        exit; // Encerra a execução do script
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
    <!-- Link para o Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Link para o CSS customizado -->
</head>
<body>
    <h1 style="text-align: center; font-weight: bold; color: black; padding: 10px;">Editar Tarefa</h1>
    
    <div class="container mt-4">
        <!-- Exibe uma mensagem de erro caso o nome já exista -->
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
        
        <!-- Formulário para editar a tarefa -->
        <form method="POST" action="editar.php?id=<?= $id ?>" class="bg-light p-4 rounded shadow">
            <div class="form-group">
                <label for="nome">Nome da Tarefa:</label>
                <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($tarefa['nome']) ?>" required>
            </div>
            <div class="form-group">
                <label for="custo">Custo (R$):</label>
                <input type="number" name="custo" class="form-control" value="<?= htmlspecialchars($tarefa['custo']) ?>" required>
            </div>
            <div class="form-group">
                <label for="data_limite">Data Limite:</label>
                <input type="date" name="data_limite" class="form-control" value="<?= htmlspecialchars($tarefa['data_limite']) ?>" required>
            </div>
            <div class="form-group">
                <label for="comentarios">Comentários:</label>
                <textarea name="comentarios" class="form-control"><?= htmlspecialchars($tarefa['comentarios']) ?></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>

        <!-- Botão para voltar para a página principal -->
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-black">
                    <!-- Direitos autorais do site -->
                    <p>&copy; Copyright 2024 Todos os direitos reservados | Desenvolvido por Ämanda Guimarães®</p>
    </footer>

    <!-- Scripts do Bootstrap necessários para a funcionalidade de componentes interativos -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
