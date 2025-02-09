<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo Pessoal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .curriculo {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Preencha seu currículo</h1>

    <form method="post" action="teste1.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="contato">Contato:</label>
        <input type="tel" id="contato" name="contato" required><br><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required><br><br>

        <label for="objetivo">Objetivo:</label>
        <input type="text" id="objetivo" name="objetivo" required><br><br>

        <label for="formacao">Formação Acadêmica (separe por vírgula):</label>
        <input type="text" id="formacao" name="formacao" required><br><br>

        <label for="cursos">Cursos Complementares (separe por vírgula):</label>
        <input type="text" id="cursos" name="cursos" required><br><br>

        <label for="experiencias">Experiências (formato: Cargo - Empresa - Tempo, separadas por vírgula):</label>
        <input type="text" id="experiencias" name="experiencias" required><br><br>

        <button type="submit">Gerar Currículo</button>
    </form>

    <?php
        // Captura os dados do formulário
        $nome = @$_POST['nome'];
        $email = @$_POST['email'];
        $contato = @$_POST['contato'];
        $endereco = @$_POST['endereco'];
        $objetivo = @$_POST['objetivo'];
        $formacao = @$_POST['formacao'];
        $cursos = @$_POST['cursos'];
        $experiencias = @$_POST['experiencias'];
        
        // Converte as strings em arrays
        $cursosArray = explode(',', $cursos);
        $formacaoArray = explode(',', $formacao);
        $experienciasArray = explode(',', $experiencias);
        
        // Exibe os dados do currículo
        echo "<div class='curriculo'>";
        echo "<h2>Currículo</h2>";
        echo "<p><strong>Nome:</strong> $nome</p>";
        echo "<p><strong>E-mail:</strong> $email</p>";
        echo "<p><strong>Contato:</strong> $contato</p>";
        echo "<p><strong>Endereço:</strong> $endereco</p>";
        echo "<p><strong>Objetivo:</strong> $objetivo</p>";

        // Exibindo formação acadêmica como uma lista
        echo "<p><strong>Formação Acadêmica:</strong></p>";
        echo "<ul>";
        foreach ($formacaoArray as $item) {
            echo "<li>" . trim($item) . "</li>";
        }
        echo "</ul>";

        // Exibindo cursos como uma lista
        echo "<p><strong>Cursos Complementares:</strong></p>";
        echo "<ul>";
        foreach ($cursosArray as $item) {
            echo "<li>" . trim($item) . "</li>";
        }
        echo "</ul>";

        // Exibindo experiências como uma lista
        echo "<p><strong>Experiências:</strong></p>";
        echo "<ul>";
        foreach ($experienciasArray as $item) {
            echo "<li>" . trim($item) . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    ?>

</body>
</html>
