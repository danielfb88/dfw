<?php
require_once 'controller/config/ApplicationConfig.class.php';

/**
 * Classe de Autenticação, login e logoff
 * Data de Criação: 9 de Maio de 2012
 *  
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
class Auth {

    private static $error;
    
    public static function login($user, $password) {
        if ((empty($user) || is_null($user)) || (empty($password) || is_null($password)))
            return null;

        $applicationConfig = new ApplicationConfig();
        $configDao = $applicationConfig->getConfigDAO('daoUsuario');
        
        self::throwException($configDao == null, 'O dao "daoUsuario" parece não estar configurado corretamente em applicationConfig', __LINE__);
        
        require_once $configDao['filePath'];
                
        self::throwException(!class_exists($configDao['className']), 'A classe '.$configDao['className'].' não existe no arquivo '.$configDao['filePath'], __LINE__);
        
        
        $reflectionDao = new ReflectionClass($configDao['className']);                
        if(!$reflectionDao->isSubclassOf('DAO')) {
            throw $e = new Exception('A classe '.$configDao['className'].' não é uma classe DAO');
            $e->getTraceAsString();
        }        
        
        $varUserName = $configDao['varUserName'];
        $varPasswordName = $configDao['varPasswordName'];
        
        $usuario = new $configDao['className']();        
        $usuario->$varUserName = $user;
        $usuario->$varPasswordName = $password;
        $usuario->read();

        if ($usuario->found) {
            return $usuario;
        } else {
            self::$error = "Usuário não encontrado";
            return null;
        }
    }

    public static function getError() {
        return self::$error;
    }
    
    private static function throwException($condition, $msg, $line) {
        if($condition) {
            throw $e = new Exception($msg.' ## line '.$line.' ##');
            $e->getTraceAsString();
        }
    }

}