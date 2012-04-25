<?php
session_start();

require_once 'Helper.php';
require_once 'location.php';

$action = $_REQUEST['action'];

switch($action) {
    
    case 'login':
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        
        if(login($usuario, $senha)) {
            header("Location: ".MAIN);
            
        } else {
            header("Location: ".LOGIN_SCREEN);
        }
        break;
    
    case 'logout':
        session_destroy();
        header("Location: ".LOGIN_SCREEN); 
        break;
    
    default:
        header("Location: ".LOGIN_SCREEN);
        
}

/**
 * Faz o login do usuário
 * @param string $user
 * @param string $password
 * @return boolean 
 */
function login($user, $password) {
    require_once 'model/Usuario.class.php';
    
    $usuario = new Usuario();
    $usuario->usuario = $user;
    $usuario->senha = $password;
    $usuario->read();
    
    if($usuario->found) { 
        $_SESSION['SESS_TOKEN'] = gerarToken(); // cria token
        $_SESSION['DAOUSUARIO'] = serialize($usuario); // serializa o dao e coloca-o na sessao
        return true;
    } else {
        return false;
    }
}

/**
 * Função que gera um token
 * @return type 
 */
function gerarToken() {    
    return md5(uniqid(rand()));
}