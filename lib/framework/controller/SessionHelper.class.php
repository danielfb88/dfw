<?php

session_start();

/**
 * Helper para Sessão.
 * Todo dado inserido na sessão atravéz desta classe é serializado e desserializado ao ser retornado.
 * Data de criação: 14 de Maio de 2012
 * 
 * @author Daniel Bonfim
 * @version 1.0 
 */
class SessionHelper {
    
    public function __construct() {
        
    }

    /**
     * Para uso interno.
     * @param string $key
     * @return mixed 
     */
    protected function get($key) {
        if (isset($_SESSION[__CLASS__][$key])) {
            return unserialize($_SESSION[__CLASS__][$key]);
        }
        return null;
    }

    /**
     * Para uso interno.
     * @param string $key
     * @param mixed $value 
     */
    protected function set($key, $value) {
        $_SESSION[__CLASS__][$key] = serialize($value);
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
        $authenticated = $this->get('authenticated');
        if ($authenticated != null)
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
     * @return DAOUsuario 
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