<?php
namespace core;

use \src\Config;
use \src\models\Usuario;

class Database {
    private static $_pdo;
    public static function getInstance() {

        self::checkDatabase();

        if(!isset(self::$_pdo)) {
            self::$_pdo = new \PDO(Config::DB_DRIVER.":dbname=".Config::DB_DATABASE.";host=".Config::DB_HOST, Config::DB_USER, Config::DB_PASS);

            self::checkTable(Config::TB_USER['name'],Config::TB_USER['culloms']);
            self::checkTable(Config::TB_PROJECT['name'],Config::TB_PROJECT['culloms']);
            self::checkTable(Config::TB_REVIEWS['name'], Config::TB_REVIEWS['culloms']);


            if (!Usuario::select()->where('id', 1)->execute() && !Usuario::select()->where('id', 2)->execute()){
                Usuario::insert([[
                        'uniqueName' => '@mariaGamer', 
                        'email' => 'maria@example.com', 
                        'nomeUsuario' => 'Maria', 
                        'senha' => password_hash('senhaSegura123', PASSWORD_DEFAULT), 
                        'about' => 'Eu sou a Maria e adoro jogos de aventura.',
                        'urlPortfolio' => 'https://portfolio.maria.com'
                    ]
                ])->execute();
    
                Usuario::insert([[
                        'uniqueName' => '@carlosDev', 
                        'email' => 'carlos@example.com', 
                        'nomeUsuario' => 'Carlos', 
                        'senha' => password_hash('senhaSegura456', PASSWORD_DEFAULT), 
                        'about' => 'Carlos, desenvolvedor e amante de programação.',
                        'urlPortfolio' => 'https://portfolio.carlos.com'
                    ]
                ])->execute();
            }
        }
        return self::$_pdo;
    }

    public static function checkDatabase(){
        $conn = new \PDO(Config::DB_DSN, Config::DB_USER, Config::DB_PASS);
    
        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
        $conn->exec("CREATE DATABASE IF NOT EXISTS ".Config::DB_DATABASE);
    }

    public static function checkTable($tableName, $tableCollums){
        try{
        
            self::$_pdo->exec("USE ".Config::DB_DATABASE);
        
            $sql = "CREATE TABLE IF NOT EXISTS ".$tableName." (".$tableCollums.") CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    
        
            self::$_pdo->exec($sql);
        }catch (\PDOException $e) {
            echo "Erro ao criar tabela: " . $e->getMessage();
        }
    }

    public static function dropTable($tableName) {
        try {
            self::$_pdo->exec("USE ".Config::DB_DATABASE);
    
            $sql = "DROP TABLE IF EXISTS ".$tableName;
    
            self::$_pdo->exec($sql);
            echo "Tabela ".$tableName." removida com sucesso.";
        } catch (\PDOException $e) {
            echo "Erro ao remover tabela: " . $e->getMessage();
        }
    }

    public static function dropDatabase($dbName) {
        try {
            self::$_pdo->exec("DROP DATABASE IF EXISTS ".$dbName);

            echo "Banco de dados ".$dbName." removido com sucesso.";
        } catch (\PDOException $e) {
            echo "Erro ao remover banco de dados: " . $e->getMessage();
        }
    }
    
    private function __construct() { }
    private function __clone() { }
    public function __wakeup() { }
}