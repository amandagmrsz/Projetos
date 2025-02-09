<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Combustível </title>
</head>
<body>  
    <h2>Cálculo de Combustível para Viagem</h2>
    <form action="ex5.php" method="POST">
    <label for="distancia">Distância (km):</label>
    <input type="number" name="distancia" step="any"><br><br>

    <label for="consumo">Consumo do Carro (km/litro):</label>
    <input type="number" name="consumo" step="any"><br><br>

    <label for="preco">Preço da Gasolina (R$/litro):</label>
    <input type="number" name="preco" step="any"><br><br>

    <button type="submit">Calcular</button>
    </form>
<?php 
    // Recebe os dados do formulário
    $distancia = @$_POST['distancia'];
    $consumo = @$_POST['consumo'];
    $preco = @$_POST['preco'];

    // Calcula a quantidade de litros necessários
    $litros = $distancia / $consumo;
    
    // Arredonda o valor de litros para 2 casas decimais
    $litros_arredondados = round($litros, 2);
 
    // Calcula o valor total gasto com gasolina
    $valor = $litros * $preco;

    // Exibe os resultados
    print "<h3>Resultado:</h3>";
    print "Maria vai gastar $litros litros de gasolina.<br>";
    print "O valor total que ela gastará será R$ " . number_format($valor, 2, ',', '.') . "<br>";

?>

</body>
</html>