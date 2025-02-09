<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expressão</title>
</head>
<body>
    <p style="font-weight: bold;">
    Por favor, forneça os três valores 'a', 'b' e 'c' na URL. <br>
    EX: http://localhost/ex4.php?a=10&b=5&c=3
    </p>


    <?php
    // Recebe os valores passados pela URL
    $a = @$_GET['a']; 
    $b = @$_GET['b']; 
    $c = @$_GET['c'];

    // Calcula a expressão ($a - $b) * $c
    $resultado = ($a - $b) * $c;

    // Exibe o resultado
    print "A expressão ($a - $b) * $c tem o valor: $resultado";
    ?>

</body> 
</html>