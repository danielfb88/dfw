<?php
// TODO: Instalar versao mais estavel do netbenas. Versão 7.1 possui bugs de herança de atributos
require_once 'lib/dfw/model/Log.class.php';

class Controller {
    /**
     * Registra as ações no DB
     * @var Log 
     */
    protected static $log;
    
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