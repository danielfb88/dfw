<?php

/**
 * Classe Singleton responsável pelas configurações dos Commans e dos DAO's padrão usados pelo sistema.
 * 
 * @author Daniel Bonfim
 * @version 1.0 
 */
class ApplicationConfig {

    private $commandsConfig = array();
    private $daosConfig = array();
    private static $instance = null;

    private function __construct() {
        $this->initDaosConfig();
        $this->initCommandsConfig();
    }

    /**
     * Singleton ApplicationConfig
     * @return ApplicationConfig 
     */
    public static function getInstance() {
        if (self::$instance == null)
            self::$instance = new self();
        return self::$instance;
    }

    /**
     * Apenas DAOs que serão utilizados por padrão pelo framework deverão ser registrados aqui.
     */
    private function initDaosConfig() {
        /*
         * DAOUsuario
         * O DAOUsuario padrão pode ser encontrado em "lib/framework/model/DAOUsuario". 
         * Altere-o conforme a sua necessidade.
         */
        $this->daosConfig['daoUsuario'] = array();
        $this->daosConfig['daoUsuario']['className'] = 'DAOUsuario';
        $this->daosConfig['daoUsuario']['filePath'] = 'Model/DAOUsuario.class.php';
        // Nome do campo de usuario
        $this->daosConfig['daoUsuario']['varUserName'] = 'usuario';
        // Nome do campo de password
        $this->daosConfig['daoUsuario']['varPasswordName'] = 'senha';
    }

    /**
     * Configuração de Todos os Commands do sistema.
     * Todos os commans devem estar registrados aqui. Essa abordagem foi preferida porcausa da velocidade
     * em relação a usar um arquivo de configuração XML
     */
    private function initCommandsConfig() {
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
        $this->commandsConfig['main']['className'] = 'Main';
        $this->commandsConfig['main']['filePath'] = 'Controller/Main.class.php';
    }

    /**
     * Retorna configurações do DAO informado
     * @param string $daoName Nome do Dao. ex: DaoUsuario
     * @return array|null
     * @throws Exception 
     */
    public function getConfigDAO($daoName) {
        if (isset($this->daosConfig[$daoName])) {
            if (isset($this->daosConfig[$daoName]['filePath'])) {
                // Testando o caminho informado no filePath
                if (!file_exists($this->daosConfig[$daoName]['filePath'])) {
                    throw $e = new Exception('O arquivo ' . $this->daosConfig[$daoName]['filePath'] . ' não existe');
                    $e->getTraceAsString();
                }
                // Retornando configuraçoes do DAO solicitado
                return $this->daosConfig[$daoName];
            } else {
                throw $e = new Exception("O filePath do DAO não foi setado.");
                $e->getTraceAsString();
            }
        } else {
            return null;
        }
    }

    /**
     * Retorna configurações do Command informado
     * @param string $commandName. ex: auth
     * @return array|null
     * @throws type 
     */
    public function getConfigCommand($commandName) {
        if (isset($this->commandsConfig[$commandName])) {
            if (isset($this->commandsConfig[$commandName]['filePath'])) {
                // Testando o caminho informado no filePath
                if (!file_exists($this->commandsConfig[$commandName]['filePath'])) {
                    throw $e = new Exception('O arquivo ' . $this->commandsConfig[$commandName]['filePath'] . ' não existe');
                    $e->getTraceAsString();
                }
                // Retornando configuraçoes do Command solicitado
                return $this->commandsConfig[$commandName];
            } else {
                throw $e = new Exception("O filePath do Command não foi setado.");
                $e->getTraceAsString();
            }
        } else {
            return null;
        }
    }

}