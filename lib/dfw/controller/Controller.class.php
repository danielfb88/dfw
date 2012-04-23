<?php
// TODO: Trabalhar no controller. métodos de autenticação.
// TODO: Como instalar plugin no vim?
require_once 'lib/dfw/model/Log.class.php';
require_once 'Auth.class.php';

abstract class Controller {
    /**
     * Registra as ações no DB
     * @var Log 
     */
    protected static $log;
    /**
     * Autenticação
     * @var Auth
     */
    public static $auth;
    
    public static function log($id_usuario, $ip, $sql, $mensagem = null) {
        // TODO: Usar lastQuery para pegar o sql
        if(self::$log == null)
            self::$log = new Log();
        
        self::$log->id_usuario = $id_usuario;
        self::$log->ip = $ip;
        self::$log->sql = $sql;
        self::$log->mensagem = $mensagem;
        self::$log->data_hora = date("Y-m-d h:i:s");
        
        self::$log->insert();
    }
    
    public static function login($user, $password) {
        if(self::$auth == null)
            self::$auth = new Auth();
        
        if(self::$auth->login($user, $password)) {
            // logado
        } else {
            // nao logado
        }
    }
    
    abstract function adicionar();
    abstract function editar();
    abstract function excluir();
    
    
    
    /*
    // Função que gera um token, atribui-o à sessão e retorna-o
    function gerarToken() { 
        // Analizar Isto:
        // http://php.net/manual/pt_BR/function.uniqid.php
            // 1º Gera um número aleatório
            // 2º Gera um ID único, cujo prefixo é o número gerado aleatoriamente
            // 3º Calcula um hash MD5 do ID único gerado anteriormente
            $token = md5( uniqid( rand() ) );
            // Atribui o token à sessão
            $_SESSION[SESS_TOKEN] = $token;
            // Retorna o token
            return $token;
    }
     * 
     */
    
    
    
}