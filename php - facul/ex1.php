<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXERCÍCIO 1</title>
</head>
<body>
    <form action="ex1.php" method="GET">
        A <input type="number" name="a">
        +
        B <input type="number" name="b">
        <button type="submit">Enviar</button>
    </form>
    <?php 
    $a = @$_GET['a'];
    $b = @$_GET['b'];
    $soma = $a + $b;

        // Verificar se a soma é maior que 20
        if ($soma > 20) {
            // Se maior que 20, somar 8
            $resultado = $soma + 8;
            print "<p>A soma de $a e $b é $soma. Como é maior que 20, somamos 8 e o resultado final é $resultado.</p>";
        } else {
            // Se menor ou igual a 20, subtrair 5
            $resultado = $soma - 5;
            print "<p>A soma de $a e $b é $soma. Como é menor ou igual a 20, subtraímos 5 e o resultado final é $resultado.</p>";
        }   
    
    ?>
</body>
</html>