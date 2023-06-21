<?php 
    date_default_timezone_set('America/Sao_Paulo');
    abstract class BancoDados{

        const host = 'localhost';
        const dbname = 'aula';
        const user = 'root';
        const password = '';

        static function conectar(){
            try {
                $pdo = new PDO("mysql:
                host=".self::host.";
                dbname=".self::dbname.";
                charset=utf8",
                self::user,
                self::password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            } catch (PDOException $e) {
                echo 'Error: '. $e->getMessage();
            }
        }
    }
    
