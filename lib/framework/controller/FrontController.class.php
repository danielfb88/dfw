<?php

require_once dirname(__FILE__) . '/../path.php';
require_once 'command/Command.class.php';
require_once 'command/CommandResolver.class.php';
require_once 'request/Request.class.php';

/**
 * Front-Controller
 * Data de criação: 14 de Maio de 2012
 * 
 * @author Daniel Bonfim
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
        $instance->init();
        $instance->handleRequest($checkAuth);
    }

    /**
     * Executa operações de inicialização
     */
    private function init() {
        
    }

    /**
     * Obtém o command com base na requisição e o executa 
     * @param type $checkAuth - É passado para o CommandResolver
     * Se for true, verifica na Sessão se o usuário está autenticado
     * antes de chamar o command
     */
    private function handleRequest($checkAuth) {
        $request = new Request();
        $cmd_r = new CommandResolver($checkAuth);

        // Obtendo objeto Command
        $cmd = $cmd_r->getCommand($request, $checkAuth);
        // Executando objeto Command
        $cmd->execute($request);
    }

}
