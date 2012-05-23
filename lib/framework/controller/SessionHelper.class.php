<?php

/**
 * Helper para Sessão
 * Data de criação: 14 de Maio de 2012
 * 
 * @author Daniel Bonfim
 * @version 1.0 
 */
class SessionHelper {

    /**
     * Inicio da Sessão 
     */
    public function __construct() {
        session_start();
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
    
    /**
     * Autentica usuário na Sessão 
     */
    public function authenticate() {
        $this->set('authenticated', true);
    }
    
    /**
     * Verifica se o usuário está autenticado
     * @return boolean 
     */
    public function is_authenticated() {
        $authenticated =  $this->get('authenticated');
        if($authenticated != null)
            return $authenticated;
        else
            return false;
    }
    
    /**
     * Insere o DaoUsuario na Sessão
     * @param DAOUsuario $daoUsuario 
     */
    public function setDAOUsuario(DAOUsuario $daoUsuario) {
        $this->set("daoUsuario", $daoUsuario);
    }
    
    /**
     * Retorna o DaoUsuario da Sessão
     * @return type 
     */
    public function getDAOUsuario() {
        return $this->get("daoUsuario");
    }
    
    /**
     * Destroi a Sessão 
     */
    public function session_destroy() {
        session_destroy();
    }
}