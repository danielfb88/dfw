<?php

session_start();

/**
 * Direcionamentos
 */
define("LOGIN_SCREEN", "http://localhost/dfw/page1.php");
define("MAIN", "http://localhost/dfw/logado.php");

require_once 'Helper.php';
require_once 'security_functions.php';

$action = $_REQUEST['a'];

switch ($action) {
    case 'login':

        if (isset($_POST['usuario']) && isset($_POST['senha'])) {

            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];

            if (login($usuario, $senha)) {
                header("Location: " . MAIN);
            } else {
                header("Location: " . LOGIN_SCREEN);
            }
        } else {
            header("Location: " . LOGIN_SCREEN);
        }
        break;

    case 'logout':
        session_destroy();
        header("Location: " . LOGIN_SCREEN);
        break;

    default:
        header("Location: " . LOGIN_SCREEN);
}

/**
 * Efetua o login do usuário
 * @param string $user
 * @param string $password
 * @return boolean 
 */
function login($user, $password) {
    require_once 'model/Usuario.class.php';

    $usuario = new Usuario();
    $usuario->usuario = $user;
    $usuario->senha = md5($password);
    $usuario->read();

    /**
     * Dados que serão escritos na SESSÃO:
     *  $_SESSION['SESS_TOKEN']: Token para permitir maior segurança em formulários
     *  $_SESSION['USER']['logado']: Informa se o usuário está logado no sistema
     *  $_SESSION['USER']['DAOUSUARIO']: Informações sobre o usuário logado
     */
    if ($usuario->found) {
        $_SESSION['SESS_TOKEN'] = gerarToken(); // cria token
        $_SESSION['USER'] = serialize($usuario); // serializa o dao e coloca-o na sessao
        return true;
    } else {
        return false;
    }
}