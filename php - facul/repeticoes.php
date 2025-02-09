<?php
	print "<h1>While</h1>";

	$i = 1;
	while ($i <= 5) {
		print $i." ";
		$i++;
	}




	print "<h1>Do While</h1>";

	$j = 1;
	do{
		print $j." ";
		$j++;
	}while($j <= 5);




	print "<h1>For</h1>";

	for ($i=1; $i <= 5; $i++) { 
		print $i." ";
	}



	print "<h1>Foreach</h1>";

	$frutas = array("Abacaxi","Banana","Caju","Damasco","Emburana","Framboesa","Goiaba");

	foreach ($frutas as $nome_fruta) {
		print $nome_fruta."<br>";
	}

	print "<hr>";

	$alfabeto = range("A", "Z"); //ou números

	foreach($alfabeto as $letra){
		print $letra." ";
	}


