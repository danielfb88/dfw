<?php

class CommandNotFoundException extends Exception {
    
}

require_once 'request/Request.class.php';
require_once 'command/Command.class.php';
require_once 'registry/SessionRegistry.class.php';

/**
 * Classe CommandResolver
 *  Define o Command a ser executado baseado no objeto Request recebido pelo método getCommand()
 * Data de criação: 14 de Maio de 2012
 * 
 * @author Daniel Bonfim
 * @version 1.0
 */
class CommandResolver {

    /**
     * XML com as configurações do Command
     * @var string
     */
    private static $configCommand = "/configCommand.xml";

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
    private static $mainCommand = null;

    public function __construct() {
        self::$configCommand = dirname(__FILE__) . self::$configCommand;
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
     * @param boolean $checkAuth - Para todo command chamado, antes de instancia-lo é verificado se deve-se
     * checar a autenticação. Se sim usa a SessionRegistry e libera o acesso caso ele esteja autenticado. Caso
     * não esteja, é chamado o command 'login'
     * @return Command
     */
    public function getCommand(Request $request, $checkAuth) {
        // Pegando o command definido na Query String através da requisição
        $commandName = $request->getCommandName();

        if ($checkAuth) {
            // Se o usuário não estiver autenticado, ele será redirecionado para o command de login
            if (!SessionRegistry::getInstance()->is_authenticated()) {
                //$request->addFeedback("Usuário não autenticado");
                $commandName = "login";
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
        $objCommand = null;
        $found = false;
        $className = '';
        $filePath = '';

        for ($i = 0; $i < count(self::$xmlCommand); $i++) {

            if ((string) self::$xmlCommand->command[$i]['name'] == $commandName) {
                // Caso o command main seja requisitado e o mesmo esteja em cache, retorne-o
                if ($commandName == "main") {
                    if (self::$mainCommand != null) {
                        return self::$mainCommand;
                    }
                }

                $found = true;
                $className = (string) self::$xmlCommand->command[$i]->classname;
                $filePath = (string) self::$xmlCommand->command[$i]->filepath;
                break;
            }
        }

        //Verifica se o Command requisitado foi encontrado no XML
        if ($found) {
            // Verificando se o arquivo realmente existe
            if (!file_exists($filePath)) {
                throw $e = new CommandNotFoundException("O arquivo '{$filePath}' não foi encontrado.");
                $e->getTraceAsString();
            }

            // requerindo o qrquivo
            require_once $filePath;

            // Verificando se a classe existe dentro do arquivo
            if (!class_exists($className)) {
                throw $e = new CommandNotFoundException("A classe '{$className}' não foi encontrada no arquivo '{$filePath}'.");
                $e->getTraceAsString();
            }

            // Instanciando o Objeto
            $objCommand = new $className();

            // Verificando se o objeto instanciado é um Command
            $cmd_class = new ReflectionClass($className);
            if (!$cmd_class->isSubclassOf(self::$base_cmd)) {
                throw $e = new CommandNotFoundException("A classe '{$className}' não é um Command.");
                $e->getTraceAsString();
            }

            // Caso o command requerido seja o main, na primeira execução desta
            // requisição, é salvo o objeto em cache
            if ($commandName == "main") {
                self::$mainCommand = $objCommand;
            }

            // Retornando o objeto Command
            return $objCommand;
        } else {

            // Retorna o mainCommand
            if (self::$mainCommand != null)
                return self::$mainCommand;
            else
                return $this->getCommandInstance();
        }
    }

}