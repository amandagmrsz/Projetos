<?php
// Requer o arquivo de configuração, que deve conter a conexão com o banco de dados
require 'config.php';

// Obtém todas as tarefas ordenadas pela ordem de apresentação (ordem_apresentacao)
$stmt = $pdo->query("SELECT * FROM Tarefas ORDER BY ordem_apresentacao");
// Armazena as tarefas obtidas em um array associativo
$tarefas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Definindo o charset do documento para UTF-8, suportando caracteres especiais -->
    <meta charset="UTF-8">
    
    <!-- Tornando o site responsivo, adaptando-o ao tamanho da tela (dispositivos móveis) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Definindo o título da página -->
    <title>Lista de Tarefas</title>

    <!-- Favicon da página -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />

    <!-- Importando a biblioteca de ícones do Bootstrap para adicionar ícones à interface -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Importando a biblioteca Font Awesome para ícones adicionais -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Importando o Bootstrap CSS para estilização dos componentes -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Link para o arquivo de estilo customizado da página -->
    <link rel="stylesheet" href="style.css">

    <script>
        // Função que confirma a exclusão da tarefa
        function confirmarExclusao(tarefaId) {
            // Exibe uma caixa de confirmação
            if (confirm("Tem certeza que deseja excluir esta tarefa?")) {
                // Se confirmado, redireciona para a página de exclusão
                window.location.href = 'excluir.php?id=' + tarefaId;
            }
        }
    </script>
</head>

<body>
    <!-- Título principal da página -->
    <h1 class="font-weight-bold" style="color: black;">Lista de Tarefas</h1>

    <!-- Início da tabela que lista as tarefas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <!-- Cabeçalho da tabela com os nomes das colunas -->
                <th> </th> <!-- Coluna para os ícones de movimentação -->
                <th>Nome da Tarefa</th>
                <th>Custo (R$)</th>
                <th>Data Limite</th>
                <th>Comentários</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tarefas-list">
            <?php 
            // Loop que percorre todas as tarefas e exibe seus dados na tabela
            foreach ($tarefas as $tarefa): 
            ?>
                <tr id="tarefa-<?= $tarefa['id'] ?>" data-id="<?= $tarefa['id'] ?>" style="<?= $tarefa['custo'] >= 1000 ? 'background-color: #C6D9B4;' : '' ?>">
                    <!-- Coluna para os ícones de movimentação (subir e descer) -->
                    <td>
                        <!-- Ícones para mover a tarefa para cima ou para baixo -->
                        <i class="fas fa-arrow-up" style="cursor: pointer;" onclick="window.location.href='mover.php?id=<?= $tarefa['id'] ?>&direcao=up'"></i>
                        <i class="fas fa-arrow-down" style="cursor: pointer;" onclick="window.location.href='mover.php?id=<?= $tarefa['id'] ?>&direcao=down'"></i>
                    </td>

                    <!-- Exibindo os dados da tarefa: nome, custo, data limite e comentários -->
                    <td><?= htmlspecialchars($tarefa['nome']) ?></td>
                    <td><?= number_format($tarefa['custo'], 2, ',', '.') ?></td>
                    <td><?= date('d-m-Y', strtotime($tarefa['data_limite'])) ?></td>
                    <td><?= htmlspecialchars($tarefa['comentarios']) ?></td>

                    <!-- Coluna para as ações: editar e excluir -->
                    <td>
                        <!-- Botão para editar a tarefa -->
                        <button class="btn btn-primary" onclick="window.location.href='editar.php?id=<?php echo $tarefa['id']; ?>'" title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <!-- Botão para excluir a tarefa -->
                        <button class="btn btn-danger" onclick="confirmarExclusao(<?php echo $tarefa['id']; ?>)" title="Excluir">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Link para a página de cadastro de uma nova tarefa -->
    <a href="cadastrar.php" class="incluir-tarefa">Incluir Nova Tarefa</a>
    
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
