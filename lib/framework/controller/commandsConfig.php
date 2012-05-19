<?php

/**
 * Retorna Array com as configurações dos Commands
 * @return array
 */
function getCommandsConfig() {
    $commandsConfig = array();

    /*
     * Auth
     */
    $commandsConfig['auth'] = array();
    $commandsConfig['auth']['className'] = 'AuthCommand';
    $commandsConfig['auth']['filePath'] = 'lib/framework/controller/command/AuthCommand.class.php';

    /*
     * Logout
     */
    $commandsConfig['logout'] = array();
    $commandsConfig['logout']['className'] = 'LogoutCommand';
    $commandsConfig['logout']['filePath'] = 'lib/framework/controller/command/LogoutCommand.class.php';

    /*
     * LoginScreen
     */
    $commandsConfig['loginScreen'] = array();
    $commandsConfig['loginScreen']['className'] = 'LoginScreen';
    $commandsConfig['loginScreen']['filePath'] = 'Controller/LoginScreen.class.php';

    /*
     * Main
     */
    $commandsConfig['main'] = array();
    $commandsConfig['main']['className'] = 'Main';
    $commandsConfig['main']['filePath'] = 'Controller/Main.class.php';


    return $commandsConfig;
}