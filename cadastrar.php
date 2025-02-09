<?php
// Requer o arquivo de configuração para a conexão com o banco de dados
require 'config.php';

// Inicializa a variável de erro como uma string vazia
$erro = ""; // Variável para armazenar a mensagem de erro

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $custo = $_POST['custo'];
    $data_limite = $_POST['data_limite'];
    $comentarios = $_POST['comentarios'];

    // Verifica se já existe uma tarefa com o mesmo nome no banco de dados
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Tarefas WHERE nome = ?");
    $stmt->execute([$nome]);
    $nomeExistente = $stmt->fetchColumn();

    // Se a tarefa com o nome já existir, exibe um erro
    if ($nomeExistente > 0) {
        $erro = "Uma tarefa com este nome já existe. Por favor, escolha outro nome.";
    } else {
        // Se o nome não existir, define a ordem de apresentação da nova tarefa
        $ordem = $pdo->query("SELECT MAX(ordem_apresentacao) + 1 AS nova_ordem FROM Tarefas")->fetchColumn() ?? 1;

        // Insere os dados da nova tarefa no banco de dados
        $stmt = $pdo->prepare("INSERT INTO Tarefas (nome, custo, data_limite, comentarios, ordem_apresentacao) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $custo, $data_limite, $comentarios, $ordem]);

        // Redireciona para a página principal (index.php) após o cadastro
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Tarefa</title>
    <!-- Favicon (ícone que aparece na aba do navegador) -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
    
    <!-- Estilo do Bootstrap para formatação rápida -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Arquivo de estilo customizado -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Cabeçalho da página -->
    <h1 class="text-center font-weight-bold" style="color: black;">Cadastrar Nova Tarefa</h1>

    <div class="container mt-4">
        <!-- Formulário de cadastro -->
        <form method="POST" action="cadastrar.php" class="bg-light p-4 rounded shadow">
            <!-- Exibe a mensagem de erro se existir -->
            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger text-center">
                    <?= $erro; ?>
                </div>
            <?php endif; ?>
            
            <!-- Campo para o nome da tarefa -->
            <div class="form-group">
                <label for="nome">Nome da Tarefa:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            
            <!-- Campo para o custo da tarefa -->
            <div class="form-group">
                <label for="custo">Custo (R$):</label>
                <input type="number" name="custo" class="form-control" required>
            </div>
            
            <!-- Campo para a data limite -->
            <div class="form-group">
                <label for="data_limite">Data Limite:</label>
                <input type="date" name="data_limite" class="form-control" required>
            </div>
            
            <!-- Campo para os comentários -->
            <div class="form-group">
                <label for="comentarios">Comentários:</label>
                <textarea name="comentarios" class="form-control"></textarea>
            </div>
            
            <!-- Botão de envio do formulário -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Cadastrar Tarefa</button>
            </div>
        </form>
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
