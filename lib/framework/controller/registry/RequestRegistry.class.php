<?php

require_once 'controller/request/Request.class.php';

/**
 * Registry de Request.
 * 
 * @author Daniel Bonfim
 * @since 14 de Maio de 2012
 * @version 1.0 
 */
class RequestRegistry extends Registry {

    /**
     * Valores do Registry
     * @var array 
     */
    private $values = array();

    /**
     * Instância RequestRegistry
     * @var RequestRegistry 
     */
    private static $instance;

    private function __construct() {
        
    }

    /**
     * Singleton RequestRegistry
     * @return RequestRegistry
     */
    public static function getInstance() {
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
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }
        return null;
    }

    /**
     * Para uso interno
     * @param string $key
     * @param mixed $value 
     */
    protected function set($key, $value) {
        $this->values[$key] = $value;
    }

    /**
     * Retorna objeto Request
     * @return Request
     */
    public static function getRequest() {
        return self::$instance->get('request');
    }

    /**
     * Seta objeto request
     * @param Request $request
     */
    public static function setRequest(Request $request) {
        self::$instance->set('request', $request);
    }

    /**
     * TODO: Definir métodos concretos que gerenciarão variáveis de Sessão. 
     */
}