<?php

class CommandNotFoundException extends Exception {
    
}

require_once 'controller/request/Request.class.php';
require_once 'controller/command/Command.class.php';
require_once 'controller/registry/SessionRegistry.class.php';
require_once 'controller/config/ApplicationConfig.class.php';

/**
 * Classe CommandResolver
 *  Define o Command a ser executado baseado no objeto Request recebido pelo método getCommand()
 * Data de criação: 14 de Maio de 2012
 * 
 * @author Daniel Bonfim
 * @version 1.0
 */
class CommandResolver {

    public function __construct() {
        
    }

    /**
     * Retorna o command definido pelo atributo 'cmd' do objeto Request.
     * 
     * @param Request $request 
     * @param boolean $checkAuth - Para todo command chamado, antes de instancia-lo é verificado se deve-se
     * checar a autenticação. Se sim usa a SessionRegistry e libera o acesso caso ele esteja autenticado. Caso
     * não esteja, é chamado o command 'vwlogin'
     * @return Command
     */
    public function getCommand(Request $request, $checkAuth) {
        // Pegando o command definido na Query String através da requisição
        $commandName = $request->getCommandName();

        if ($checkAuth) {
            // Se o usuário não estiver autenticado, ele será redirecionado para o command de vwlogin
            if (!SessionRegistry::getInstance()->is_authenticated()) {
                // Se o request for post leve para o command de autenticação
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $commandName = "auth";
                } else {
                    $commandName = "loginScreen";
                }
            }
        }

        if (!empty($commandName))
        // Retorna command especificado 
            return $this->getCommandInstance($commandName);
        else
        // Retorna command padão
            return $this->getCommandInstance();
    }

    /**
     * Instancia o Command efetuando operações de segurança
     * @param string $commandName
     * @return Command
     * @throws CommandNotFoundException 
     */
    private function getCommandInstance($commandName = 'main') {
        $commandConf = ApplicationConfig::getInstance()->getConfigCommand($commandName);

        if ($commandConf != null) {
            require_once $commandConf['filePath'];

            // Verificando se a classe existe
            $this->throwException((!empty($commandConf['className']) && !class_exists($commandConf['className'])), "A classe '{$commandConf['className']}' não foi encontrada.", __LINE__);

            // Instanciando o Objeto
            $objCommand = new $commandConf['className']();

            // Verificando se o objeto instanciado é um Command
            $this->throwException(!($objCommand instanceof Command), "A classe {$commandConf['className']} não é um Command.", __LINE__);

            // Retornando o objeto Command
            return $objCommand;
        } else {
            // instancia um novo main command e retorna-o
            return $this->getCommandInstance();
        }
    }

    private function throwException($condition, $message, $line) {
        if ($condition) {
            throw $e = new Exception($message . " ## Line: " . $line . " ##");
            $e->getTraceAsString();
        }
    }

}