<?php
namespace core;

use \src\Config;
use \core\Database;
use \ClanCats\Hydrahon\Builder;
use \ClanCats\Hydrahon\Query\Sql\FetchableInterface;

class Model {

    protected static $_h;
    
    public function __construct() {
        self::_checkH();
    }

    public static function _checkH() {
        if(self::$_h == null) {
            $connection = Database::getInstance();
            self::$_h = new Builder('mysql', function($query, $queryString, $queryParameters) use($connection) {
                $statement = $connection->prepare($queryString);
                $statement->execute($queryParameters);

                if ($query instanceof FetchableInterface)
                {
                    return $statement->fetchAll(\PDO::FETCH_ASSOC);
                }
            });
        }
        
        self::$_h = self::$_h->table( self::getTableName() );
    }

    public static function getTableName() {
        $className = explode('\\', get_called_class());
        $className = end($className);
        return strtolower($className).'s';
    }

    public static function select($fields = []) {
        self::_checkH();
        return self::$_h->select($fields);
    }

    public static function insert($fields = []) {
        self::_checkH();
        return self::$_h->insert($fields);
    }

    public static function update($fields = []) {
        self::_checkH();
        return self::$_h->update($fields);
    }

    public static function delete($id) {
        self::_checkH();
        return self::$_h->delete()->where('id', $id)->execute();
    }

    
    private static function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    
    private static function base64UrlDecode($data) {
        $data .= str_repeat('=', (4 - strlen($data) % 4) % 4); // Adiciona padding
        return base64_decode(strtr($data, '-_', '+/'));
    }

    public static function encryptData($data) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedData = openssl_encrypt($data, 'aes-256-cbc', Config::ENCRYPT_KEY, 0, $iv);
        return self::base64UrlEncode($encryptedData . '::' . $iv);
    }
    
    public static function decryptData($data) {
        $decodedData = self::base64UrlDecode($data);
        list($encryptedData, $iv) = explode('::', $decodedData, 2);
        return openssl_decrypt($encryptedData, 'aes-256-cbc', Config::ENCRYPT_KEY, 0, $iv);
    }
    
}