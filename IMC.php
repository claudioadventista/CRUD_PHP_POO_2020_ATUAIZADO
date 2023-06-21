<?php
   	$altura = $aluno-> altura;
	$peso = $aluno-> peso;
	$altura = $altura * $altura;
	$massa = $peso / $altura;
	$massa = number_format($massa,2,'.','');
	echo $massa;
?>