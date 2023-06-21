<?php
	require 'ClassConn.php';
	
	/*================================================================================
	 
	       					PÁGINA QUE CRIA TODAS AS CLASSES  
	  
	  ================================================================================*/
	
	abstract class Classe{
		
// ********** 1 Classe que lista todos os alunos que não foram excluidos para mostrar na tabela da página index.php    
		static function ListaAluno(){   
			try {           
				$conexao = BancoDados::conectar();                   
				$lista = $conexao->prepare('SELECT *,turma.nome as nome_turma, aluno.nome as aluno FROM aluno INNER JOIN turma ON aluno.id_turma = turma.id_turma WHERE statu = 0 ORDER By aluno.nome ASC');
				$lista->execute();          
				$lista = $lista->fetchAll(PDO::FETCH_OBJ);       
				return $lista;  	
	     	} 
			catch (PDOException $e) {          
			echo "Error: ".$e->getMessage();        
			}
		}
		
// ********** 2 Classe que lista todos os alunos excluidos para mostrar na tabela da página Excluidos  
		static function ListaAlunoExcluido(){   
			try {           
				$conexao = BancoDados::conectar();                  
				$lista = $conexao->prepare('SELECT *,turma.nome as nome_turma, aluno.nome as aluno FROM aluno INNER JOIN turma ON aluno.id_turma = turma.id_turma WHERE statu = 1 ORDER By aluno.nome ASC');
				$lista->execute();          
				$lista = $lista->fetchAll(PDO::FETCH_OBJ);       
				return $lista;  	
	     	} 
			catch (PDOException $e) {          
			echo "Error: ".$e->getMessage();        
			}
		}
	
// ********** 3 Classe que faz a contagem dos alunos que não foram excluídos e mostra na index 
	    static function ContaAluno(){   
			try {           
				$conexao = BancoDados::conectar();          
				$contagem = $conexao->prepare('SELECT * FROM aluno WHERE statu = 0');        
				$contagem->execute(); 
				$contagem = $contagem->rowCount();           
				return $contagem;  
	     	} 
			catch (PDOException $e) {          
			echo "Error: ".$e->getMessage(); 
			}
		}
	
// ********** 4 Classe que conta os alunos excluidos 
	    static function ContaAlunoExcluido(){   
			try {           
				$conexao = BancoDados::conectar();          
				$contagem = $conexao->prepare('SELECT * FROM aluno WHERE statu = 1');        
				$contagem->execute(); 
				$contagem = $contagem->rowCount();           
				return $contagem;  
	     	} 
			catch (PDOException $e) {          
			echo "Error: ".$e->getMessage(); 
			}
		}
		
// ********** 5 Classe que seleciona aluno pela id para preencher os dados na página de alteração do aluno 
		static function AlunoUnico($id){      
			try {          
				$conexao = BancoDados::conectar();          
				//$usuario = $conexao->prepare('SELECT * FROM aluno WHERE id_aluno = :id AND statu = 0');          
				$usuario = $conexao->prepare('SELECT *,turma.nome as nome_turma, aluno.nome as aluno FROM aluno INNER JOIN turma ON aluno.id_turma = turma.id_turma WHERE aluno.id_aluno = :id AND aluno.statu = 0');
				$usuario->bindValue(':id', $id);          
				$usuario->execute();
				$usuario = $usuario->fetch(PDO::FETCH_OBJ);           
				return $usuario;  
	     	} 
			catch (PDOException $e) {          
			echo "Error: ".$e->getMessage();
	        }
	    }
	
// ********** 6 Classe para cadastrar um novo aluno
		static function CadastraAluno($nome, $altura, $peso, $id_turma){
	        try {
	            $conexao = BancoDados::conectar();
	            $inserir = $conexao->prepare('INSERT INTO aluno (nome, altura, peso, id_turma, statu)
	            VALUES (:nome, :altura, :peso, :turma, :statu)');
				$inserir->bindValue(':nome', $nome);
				$inserir->bindValue(':altura', $altura);
				$inserir->bindValue(':peso', $peso);
	            $inserir->bindValue(':turma', $id_turma);
	            $inserir->bindValue(':statu', 0);
	            $inserir->execute(); 
	        } 
			catch (PDOException $e) {
	       		echo "Error: ".$e->getMessage();
	        }
	    }
	
// ********** 7 Classe para alterar o aluno
	    static function AlteraAluno($id, $nome, $altura, $peso, $id_turma){
	    	$conexao = BancoDados::conectar();
	        $alterar = $conexao->prepare('
	        UPDATE aluno SET nome = :nome, altura = :altura, peso = :peso, id_turma = :id_turma WHERE id_aluno = :id');
	        $alterar->bindValue(':id', $id);
	        $alterar->bindValue(':nome', $nome);
	        $alterar->bindValue(':altura', $altura);
			$alterar->bindValue(':peso', $peso);
	        $alterar->bindValue(':id_turma', $id_turma);
	        $alterar->execute();
			exit;
	    }
	 
// ********** 8 Classe para excluir 'altera o statu' do aluno pelo id
	    static function ExcluiAluno($id, $statu){
	    	$conexao = BancoDados::conectar();
	        $delete = $conexao->prepare('UPDATE aluno SET statu = :statu WHERE id_aluno = :id');
	        $delete->bindValue(':id', $id);
	        $delete->bindValue(':statu', $statu);
	        $delete->execute();
	    }
		
// ********** 9 Classe que lista todas as turmas 
		static function ListaTurma(){   
			try {           
				$conexao = BancoDados::conectar();          
				$ListaTurma = $conexao->prepare('SELECT * FROM turma');          
				$ListaTurma->execute();          
				$ListaTurma = $ListaTurma->fetchAll(PDO::FETCH_OBJ);          
				return $ListaTurma;
	     	} 
			catch (PDOException $e) {          
			echo "Error: ".$e->getMessage();     
			}
		}
	
// ********** 10 Classe para Retorna todos os alunos que foram excluídos 
	    static function RetornaAluno(){
	    	$conexao = BancoDados::conectar();
	        $retorne = $conexao->prepare('UPDATE aluno SET statu = 0 WHERE statu = 1');
	        $retorne->execute();
	    }
		
// ********** 11 Classe para retorna o aluno individualmente
	    static function RetornaAlunoIndividual($idExcluido, $statu){
	    	$conexao = BancoDados::conectar();
			$retorne = $conexao->prepare('UPDATE aluno SET statu = :statu WHERE id_aluno = :id');
	        $retorne->bindValue(':id', $idExcluido);
	        $retorne->bindValue(':statu', $statu);
	        $retorne->execute();
	    }
		
// ********** 12 Classe para retorna o aluno marcado pelo checkbox
		 static function RetornaAlunoMarcado($idExcluido, $statu){	
		 	$conexao = BancoDados::conectar();
			foreach ($idExcluido as $id) {
				$retorne = $conexao->prepare('UPDATE aluno SET statu = :statu WHERE id_aluno = :id');
		        $retorne->bindValue(':id', $id);
		        $retorne->bindValue(':statu', $statu);
		        $retorne->execute();
			}
		 }
		
// ********** 13 Classe que pasquisa aluno pelo nome 
		static function PesquisaAluno($buscaAluno){      
			try {          
				$conexao = BancoDados::conectar();          
				//$usuario = $conexao->prepare('SELECT * FROM aluno WHERE nome Like :nome AND statu = 0');          
				$usuario = $conexao->prepare('SELECT *,turma.nome as nome_turma, aluno.nome as aluno FROM aluno INNER JOIN turma ON aluno.id_turma = turma.id_turma WHERE aluno.nome Like :nome AND statu = 0 ORDER By aluno.nome ASC');
				$usuario->bindValue(':nome', "%".$buscaAluno."%", PDO::PARAM_STR);          
				$usuario->execute();
				$usuario = $usuario->fetchAll(PDO::FETCH_OBJ);           
				return $usuario; 
	     	} 
			catch (PDOException $e) {          
				echo "Error: ".$e->getMessage();
	        }
	    }
		
// ********** 14 Classe que faz acontagem dos alunos da pesquisa 
	    static function ContaAlunoBusca($buscaAluno){   
			try {           
				$conexao = BancoDados::conectar();          
				$contaBusca = $conexao->prepare('SELECT * FROM aluno WHERE nome Like :nome AND statu = 0');
				$contaBusca->bindValue(':nome', "%".$buscaAluno."%", PDO::PARAM_STR);               
				$contaBusca->execute(); 
				$contaBusca = $contaBusca->rowCount();           
				return $contaBusca;  
	     	} 
			catch (PDOException $e) {          
			echo "Error: ".$e->getMessage(); 
			}
		}
}