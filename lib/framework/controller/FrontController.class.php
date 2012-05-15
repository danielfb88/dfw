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

    public static function run() {
        $instance = new self();
        //$instance->init();
        $instance->handleRequest();
    }

    function init() {
        // Executar verificações de segurança
        // pode usar sessionRegistry
        //$this->applicationHelper = ApplicationHelper::getInstance();
        //$this->applicationHelper->init();
    }

    private function handleRequest() {
        $request = new Request();
        $cmd_r = new CommandResolver();

        // Obtendo objeto Command
        $cmd = $cmd_r->getCommand($request);
        // Executando objeto Command
        $cmd->execute($request);
    }

}
