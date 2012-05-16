<?php

require_once dirname(__FILE__) . '/../paths.php';
require_once 'command/Command.class.php';
require_once 'command/CommandResolver.class.php';
require_once 'request/Request.class.php';

/**
 * Front-Controller
 * 
 * @author Daniel Bonfim
 * @since 14 de Maio de 2012
 * @version 1.0 
 */
class FrontController {

    private function __construct() {
        
    }

    /**
     * Roda o Front-Controller
     * @param boolean $checkAuth - Verificar se o usuário precisa de autenticação no sistema 
     * para executar o command
     */
    public static function run($checkAuth = false) {
        $instance = new self();
        $instance->init($checkAuth);
        $instance->handleRequest();
    }

    /**
     * Executa operações de inicialização
     * @param type $checkAuth 
     */
    function init($checkAuth) {
        // Executar verificações de segurança
        // pode usar sessionRegistry
        //$this->applicationHelper = ApplicationHelper::getInstance();
        //$this->applicationHelper->init();
    }

    /**
     * Obtém o command com base na requisição e o executa 
     */
    private function handleRequest() {
        $request = new Request();
        $cmd_r = new CommandResolver();

        // Obtendo objeto Command
        $cmd = $cmd_r->getCommand($request);
        // Executando objeto Command
        $cmd->execute($request);
    }

}
