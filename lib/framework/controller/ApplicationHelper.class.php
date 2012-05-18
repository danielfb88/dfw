<?php

require_once 'registry/PatchCommandRegistry.class.php';

/**
 * Carrega arquivos XML do FrameWork e da Aplicação e salva em cache no singleton PatchCommandRegistry
 * Data de criação: 17 de Maio de 2012
 * 
 * @author Daniel Bonfim
 * @version 1.0
 */
class ApplicationHelper {

    /**
     * XML com as configurações dos commands do framework
     * @var string 
     */
    private static $frameworkConfig = "/frameworkConfig.xml";

    /**
     * XML com as configurações dos commands da aplicação
     * @var string
     */
    private static $applicationConfig = "/../commandConfig.xml";

    public static function init() {
        if (!PatchCommandRegistry::getInstance()->is_initialized())
            self::loadOptions();
    }

    private static function loadOptions() {
        self::$frameworkConfig = dirname(__FILE__) . self::$frameworkConfig;
        self::$applicationConfig = dirname(__FILE__) . self::$applicationConfig;

        // Verificando se os arquivos de configuração existem
        self::throwException(
                !file_exists(self::$frameworkConfig), "Arquivo XML '" . self::$frameworkConfig . "' não encontrado.", __LINE__
        );
        self::throwException(
                !file_exists(self::$applicationConfig), "Arquivo XML '" . self::$applicationConfig . "' não encontrado.", __LINE__
        );

        // Carregando o arquivos xml
        $xmlFrameworkConfig = @simplexml_load_file(self::$frameworkConfig);
        $xmlApplicationConfig = @simplexml_load_file(self::$applicationConfig);

        /*
         * Verificando objetos SimpleXMLElement
         */
        self::throwException(
                !($xmlFrameworkConfig instanceof SimpleXMLElement), "Não foi possível identificar o arquivo '" . self::$frameworkConfig, __LINE__
        );
        self::throwException(
                !($xmlApplicationConfig instanceof SimpleXMLElement), "Não foi possível identificar o arquivo '" . self::$applicationConfig, __LINE__
        );

        /*
         * Array que será inserido ao PatchCommandRegistry 
         */
        $patchCommand = array();

        /*
         * Carregando configurações do Framework
         */
        for ($i = 0; $i < count($xmlFrameworkConfig); $i++) {

            $commandName = (string) $xmlFrameworkConfig->command[$i]->commandname;
            $patchCommand[$commandName]['classname'] = (string) $xmlFrameworkConfig->command[$i]->classname;
            $patchCommand[$commandName]['filePatch'] = (string) $xmlFrameworkConfig->command[$i]->filepath;
            $patchCommand[$commandName]['commandcontext'] = "framework";

            /*
             * Verificando se filepath existe
             */
            self::throwException(
                    !file_exists($patchCommand[$commandName]['filepath']), "O arquivo '{$patchCommand[$commandName]['filepath']}' não foi encontrado.", __LINE__
            );
        }

        /*
         * Carregando configurações da Aplicação
         */
        for ($i = 0; $i < count($xmlApplicationConfig); $i++) {

            $commandName = (string) $xmlApplicationConfig->command[$i]->commandname;
            $patchCommand[$commandName]['classname'] = (string) $xmlApplicationConfig->command[$i]->classname;
            $patchCommand[$commandName]['filepath'] = (string) $xmlApplicationConfig->command[$i]->filepath;
            $patchCommand[$commandName]['includeview'] = (string) $xmlApplicationConfig->command[$i]->includeview;
            $patchCommand[$commandName]['commandcontext'] = "application";

            /*
             * Verificando se filepath e includeview existem
             */
            self::throwException(
                    !file_exists($patchCommand[$commandName]['filepath']), "O arquivo '{$patchCommand[$commandName]['filepath']}' não foi encontrado.", __LINE__
            );
            self::throwException(
                    !file_exists($patchCommand[$commandName]['includeview']), "O arquivo '{$patchCommand[$commandName]['includeview']}' não foi encontrado.", __LINE__
            );
        }
        // TODO: Isso não ta dando certo. O consumo de memória tá foda. Acho que vou colocar esse conteudo
        // de cache em um arquivo.
        print_r($patchCommand);die;
        
        /*
         * Inserindo Patchs do sistema ao Registry
         */
        PatchCommandRegistry::getInstance()->setPatchs($patchCommand);
    }

    private static function throwException($condition, $message, $line) {
        if ($condition) {
            throw $e = new Exception($message . " ## Line: " . $line . " ##");
            $e->getTraceAsString();
        }
    }

}