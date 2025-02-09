<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabuada</title>
    <style>
        table {
            margin: 20px auto;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <p>Escreva um número e te darei a tabuada dele.</p>
    <form action="ex3.php" method="GET">
        <label for="numero">Informe um número:</label>
        <input type="number" id="numero" name="numero" >
        <button type="submit">Gerar Tabuada</button>
    </form>

    <?php 
    
    $numero = @$_GET['numero'];


        // Exibe a tabuada
        echo "<h3>Tabuada de $numero:</h3>";
        echo "<table>";

        // Loop para exibir a tabuada
        for ($i = 1; $i <= 10; $i++) {
            $resultado = $numero * $i;
            echo "<tr>
                    <td>$numero x $i</td>
                    <td>=</td>
                    <td>$resultado</td>
                </tr>";
        }

        echo "</table>";
    ?>

</body>
</html>
