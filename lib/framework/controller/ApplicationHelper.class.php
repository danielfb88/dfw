<?php
/**
 * Classe ApplicationHelper. Singleton Responsável por disponibilizar configurações para a aplicação 
 * Data de criação: 18 de Maio de 2012
 * 
 * @author Daniel Bonfim
 * @version 1.0
 */
class ApplicationHelper {

    /**
     * Array com as configurações dos commands
     * @var array 
     */
    private $commandsConfig = array();
    /**
     * Instância do singleton ApplicationHelper
     * @var ApplicationHelper 
     */
    private static $instance;

    private function __construct() {
        $this->defineCommandsConfig();
    }
    
    /**
     * Singleton
     * @return ApplicationHelper 
     */
    public static function getInstance() {
        if(self::$instance == null)
            self::$instance = new self();
        return self::$instance;
    }

    /**
     * Define as configurações no array $commandsConfig
     */
    private function defineCommandsConfig() {
        require_once 'controller/commandsConfig.php';
        $this->commandsConfig = getCommandsConfig();
    }
    
    /**
     * Executado para recuperar as configurações de um Command em particular 
     * @param string $commandName
     * @return array|null 
     */
    public function getCommandConfig($commandName) {
        if(isset($this->commandsConfig[$commandName])) {
            // testando o filepath
            if(!file_exists($this->commandsConfig[$commandName]['filePath']))
                throw $e = new Exception("Arquivo ".$this->commandsConfig[$commandName]['filePath']." não existe.");
                        
            return $this->commandsConfig[$commandName];
            
        } else {
            return null;
        }
    }

}