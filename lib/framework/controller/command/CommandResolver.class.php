<?php

// TODO: Essa classe ta foda...
class CommandNotFoundException extends Exception {
    
}

require_once 'request/Request.class.php';
require_once 'command/Command.class.php';

/**
 * Classe CommandResolver
 *  Define o Command a ser executado baseado no objeto Request recebido pelo método getCommand()
 * 
 * @author Daniel Bonfim
 * @since 14 de Maio de 2012
 * @version 1.0
 */
class CommandResolver {

    /**
     * XML com as configurações do Command
     * @var string
     */
    private static $configCommand;

    /**
     * Objeto SimpleXMLElement
     * @var SimpleXMLElement 
     */
    private static $xmlCommand;

    /**
     * Classe base para o uso de Reflexão
     * @var type 
     */
    private static $base_cmd;

    /**
     * Command Padrão
     * @var Command
     */
    private static $defaultCommand = null;

    public function __construct() {
        self::$configCommand = dirname(__FILE__) . "/configCommand.xml";
        // Lendo o arquivo xml
        self::$xmlCommand = @simplexml_load_file(self::$configCommand);

        if (!self::$xmlCommand) {
            throw $e = new Exception("Arquivo XML '" . self::$configCommand . "' não encontrado.");
            $e->getTraceAsString();
        }
        if (!(self::$xmlCommand instanceof SimpleXMLElement)) {
            throw $e = new Exception("Não foi possível identificar o arquivo '" . self::$configCommand);
            $e->getTraceAsString();
        }

        // Criando classe base para o uso de Reflexão
        self::$base_cmd = new ReflectionClass("Command");
    }

    /**
     * Retorna o command definido pelo atributo 'cmd' do objeto Request.
     * 
     * @param Request $request 
     * @return Command
     */
    public function getCommand(Request $request) {
        $requestCommandName = $request->getCommandName();
        if (!empty($requestCommandName))
            return $this->getCommandInstance($requestCommandName);
        else
            return $this->getCommandInstance();
    }

    /**
     * Instancia o Command efetuando operações de segurança
     * @param string $commandName
     * @return Command
     * @throws CommandNotFoundException 
     */
    private function getCommandInstance($commandName = 'default') {
        $command = null;
        $className = '';
        $filePath = '';

        for ($i = 0; $i < count(self::$xmlCommand); $i++) {

            if ((string) self::$xmlCommand->command[$i]['name'] == $commandName) {
                $className = (string) self::$xmlCommand->command[$i]->classname;
                $filePath = (string) self::$xmlCommand->command[$i]->filepath;

                // Verificando se o arquivo existe
                if (!file_exists($filePath)) {
                    throw $e = new CommandNotFoundException("O arquivo '{$filePath}' não foi encontrado.");
                    $e->getTraceAsString();
                }

                require_once $filePath;

                // Verificando se a classe existe
                if (!class_exists($className)) {
                    throw $e = new CommandNotFoundException("A classe '{$className}' não foi encontrada no arquivo '{$filePath}'.");
                    $e->getTraceAsString();
                }

                $command = new $className();
                break;
            }
        }

        // Verificando se é um Command
        $cmd_class = new ReflectionClass($className);
        if (!$cmd_class->isSubclassOf(self::$base_cmd)) {
            throw $e = new CommandNotFoundException("A classe '{$className}' não é um Command.");
            $e->getTraceAsString();
        }

        if ($command == null)
            throw new Exception("Command não encontrado no arquivo de configuracao '" . self::$configCommand);
        else
            return $command;
    }

}