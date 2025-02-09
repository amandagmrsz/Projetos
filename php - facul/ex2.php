<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXERCÍCIO 2</title>
</head>
<body>
    <P>Informe três números e direi qual é o maior e o menor.</P><br>
    <form action="ex2.php" method="GET">
    A <input type="number" name="a">
    B <input type="number" name="b">
    C <input type="number" name="c">
    <button type="submit">Enviar</button>
    </form>

    <?php  
    $a = @$_GET['a']; 
    $b = @$_GET['b']; 
    $c = @$_GET['c']; 
 
    // Verifica qual é o maior e o menor número
    $maior = max($a, $b, $c);
    $menor = min($a, $b, $c);

    // Exibe os resultados
    print "$maior é o MAIOR. <br> E $menor é o menor.<br>";

    // Caso haja números iguais
    if ($a == $b && $b == $c) {
        echo "Todos os números são iguais!";
    } elseif ($a == $b) {
        echo "$a e $b são iguais e maiores que $c.";
    } elseif ($b == $c) {
        echo "$b e $c são iguais e maiores que $a.";
    } elseif ($a == $c) {
        echo "$a e $c são iguais e maiores que $b.";
    }

    ?>


</body>
</html>