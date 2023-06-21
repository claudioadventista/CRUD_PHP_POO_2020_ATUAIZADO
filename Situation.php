<?php
   	if($massa<19){
		$mensagem = "1 - Magro";							
	}
	if(($massa > 19) and ($massa< 25)){
		$mensagem = "2 - Ideal";						
	}
	if(($massa >= 25) and ($massa< 30)){
		$mensagem = "3 - Um pouco acima";						
	}
	if(($massa >= 30) and ($massa< 35)){
		$mensagem = "4 - Acima";							
	}
	if(($massa >= 35) and ($massa< 40)){
		$mensagem = "5 - Muito acima";								
	}
	if($massa >= 40){
		$mensagem = "7 - Morbida";
	}						
	echo $mensagem;
?>