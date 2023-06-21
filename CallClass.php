<?php   
	require 'AllClasses.php'; 
	
	/*================================================================================
	 
	      					PÁGINA QUE CHAMA A MAIORIA DAS CLASSES  
	  
	  ================================================================================*/

// ********** RETORNAR ALUNO INDIVIDUAL usa método get porque o id vem por um link href
if(isset($_GET['idExcluido'])){
	 
		Classe::RetornaAlunoIndividual($_GET['idExcluido'],0); // Chama a classe retornar aluno individual 
    	header("Location: html/Home.php"); 
   		exit;	
	}

// ********** REDIRECIONA PARA A PÁGINA DOS EXCLUÍDOS
	if(isset($_POST['retornarExcluidos'])){
		
		header('Location:html/Deleted.php'); // Redireciona para a página dos excluidos
		exit;	
	} 
	
// ********** RETORNAR TODOS OS ALUNOS 
	if(isset($_POST['retornarTodos'])){
			
		Classe::RetornaAluno(); // Chama a classe RetornaAluno
		header('Location:html/Home.php');
		exit;
	}
	
// ********** RETORNA ALUNO MARCADO COM CHECKBOX
	if(isset($_POST['numeros'])){
			
		Classe::RetornaAlunoMarcado($_POST['numeros'],0); // Chama a classe RetornaAlunoMarcado
		header('Location:html/Home.php');
		exit;
	}
		
// ********** CADASTRA O ALUNO
	//if(isset($_POST,$_POST['nome'],$_POST['altura'])){
	if(($_POST['nome']<>"")and($_POST['altura']<>"")){
	  
		Classe::CadastraAluno($_POST['nome'],$_POST['altura'],$_POST['peso'],$_POST['id_turma']); // Chama a classe CadastroAluno       
		header("Location: html/Home.php");    	
	}
	else 
	{
		header("Location: html/Home.php"); 
	} 

// ********** ALTERA O ALUNO
 	if(isset($_POST, $_POST['idAlt'], $_POST['nome'],$_POST['altura'])){
			       
		Classe::AlteraAluno($_POST['idAlt'], $_POST['nome'],$_POST['altura'],$_POST['peso'],$_POST['turma']); // Chama a classe AlteraAluno     
		header("Location: html/Home.php");
 	}
 
// ********** EXCLUI O ALUNO usa método get porque o id vem por um link href 
 	if(isset($_GET, $_GET['id'])){
 		
    	Classe::ExcluiAluno($_GET['id'],1); // Chama a classe ExcluiAluno 
    	header("Location: html/Home.php");  
	}
 
 