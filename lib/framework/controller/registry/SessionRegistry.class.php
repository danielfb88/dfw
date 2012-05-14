<?php

/**
 * Registry para SESSAO.
 * Esta classe Utiliza o padrão Registry para gerenciar sessões.
 * 
 * @author Daniel Bonfim
 * @since 14 de Maio de 2012
 * @version 1.0 
 */
class SessionRegistry extends Registry {

    /**
     * Instância SessionRegistry
     * @var SessionRegistry 
     */
    private static $instance;

    /**
     * Inicio da Sessão 
     */
    private function __construct() {
        session_start();
    }

    /**
     * Singleton SessionRegistry
     * @return SessionRegistry 
     */
    static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Para uso interno.
     * @param string $key
     * @return mixed 
     */
    protected function get($key) {
        if (isset($_SESSION[__CLASS__][$key])) {
            if (is_object($_SESSION[__CLASS__][$key])) {
                return unserialize($_SESSION[__CLASS__][$key]);
            } else {
                return $_SESSION[__CLASS__][$key];
            }
        }
        return null;
    }

    /**
     * Para uso interno.
     * @param string $key
     * @param mixed $value 
     */
    protected function set($key, $value) {
        if (is_object($value)) {
            $_SESSION[__CLASS__][$key] = serialize($value);
        } else {
            $_SESSION[__CLASS__][$key] = $value;
        }
    }
    
    public function session_destroy() {
        session_destroy();
    }

    /**
     * TODO: Definir métodos concretos que gerenciarão variáveis de Sessão. 
     */
}