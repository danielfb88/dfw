<?php
/**
 * Array com as configurações dos Commands
 */
global $commandsConfig;

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
$commandsConfig['main']['className'] = 'MainCommand';
$commandsConfig['main']['filePath'] = 'Controller/MainCommand.class.php';


function getCommandsConfig() {
    global $commandsConfig;
    return $commandsConfig;
}