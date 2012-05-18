<?php

class ApplicationHelper {

    private $commandsConfig = array();
    private static $instance;

    private function __construct() {
        $this->defineCommandsConfig();
    }
    
    /**
     *
     * @return ApplicationHelper 
     */
    public static function getInstance() {
        if(self::$instance == null)
            self::$instance = new self();
        return self::$instance;
    }

    private function defineCommandsConfig() {
        /*
         * Auth
         */
        $this->commandsConfig['auth'] = array();
        $this->commandsConfig['auth']['className'] = 'AuthCommand';
        $this->commandsConfig['auth']['filePath'] = 'lib/framework/controller/command/AuthCommand.class.php';

        /*
         * Logout
         */
        $this->commandsConfig['logout'] = array();
        $this->commandsConfig['logout']['className'] = 'LogoutCommand';
        $this->commandsConfig['logout']['filePath'] = 'lib/framework/controller/command/LogoutCommand.class.php';

        /*
         * LoginScreen
         */
        $this->commandsConfig['loginScreen'] = array();
        $this->commandsConfig['loginScreen']['className'] = 'LoginScreen';
        $this->commandsConfig['loginScreen']['filePath'] = 'Controller/LoginScreen.class.php';

        /*
         * Main
         */
        $this->commandsConfig['main'] = array();
        $this->commandsConfig['main']['className'] = 'MainCommand';
        $this->commandsConfig['main']['filePath'] = 'Controller/MainCommand.class.php';
    }
    
    /**
     *
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