<?php

require_once 'request/Request.class.php';

/**
 * Classe base Command.
 * Data de criação: 14 de Maio de 2012
 * 
 * @author Daniel Bonfim
 * @version 1.0 
 */
abstract class Command {

    public final function __construct() {
        
    }

    /**
     * Método que deverá ser sobrescrito e inserido a lógica para cada Command
     * @param Request $request 
     */
    protected abstract function doExecute(Request $request);

    /**
     * Método que é chamado pelo Controller.
     * Executa o Command passando um objeto Request como parâmetro.
     * @param Request $request 
     */
    public function execute(Request $request) {
        $this->doExecute($request);
    }

}
