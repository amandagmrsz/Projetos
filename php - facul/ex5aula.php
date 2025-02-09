<form action="ex5.php" method="GET">
    Informe sua idade: <input type="text" name="idade">
    <button type="submit">Enviar</button>
</form>
<?php
$idade = @$_GET['idade'];

if ($idade >= 18 and $idade <= 60) {
    print "Você é maior de idade.";
} elseif ($idade >= 60) {
    print "Você já está na terceira idade, rs.";
} else {
    print "Você é menor de idade.";
}
