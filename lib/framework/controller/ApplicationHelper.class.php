<?php

class ApplicationHelper_Exception extends Exception {
    
}

/** 
 * Singleton responsável por carregar as configurações do XML
 * 
 * @author Daniel Bonfim
 * @version 1.0
 */
class ApplicationHelper {

    private static $instance;
    private $config = "config.xml";

    private function __construct() {
        
    }

    /**
     * Singleton
     * @return ApplicationHelper 
     */
    static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function init() {
        
    }

    private function getOptions() {
        if (!file_exists($this->config)) {
            throw $e = new ApplicationHelper_Exception("Could not find options file");
            $e->getTraceAsString();
        }

        $options = simplexml_load_file($this->config);

        if (!($options instanceof SimpleXMLElement)) {
            throw $e = new ApplicationHelper_Exception("Could not resolve options file");
            $e->getTraceAsString();
        }

        $dsn = (string) $options->dsn;

        if (!$dsn) {
            throw $e = new ApplicationHelper_Exception("No DSN found");
            $e->getTraceAsString();
        }

        // buscar informações necessárias para a aplicação. 
        // É interessante colocar tudo o que for da aplicaçào neste arquivo xml que por conseguinte 
        // será alocado em um resgistry
        ApplicationRegistry::setDSN($dsn);
    }

}