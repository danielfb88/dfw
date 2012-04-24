<?php
session_start();

require_once 'Helper.php';
$action = $_REQUEST['action'];

switch($action) {
    
    case 'login':
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        
        if(login($usuario, $senha)) {
            // Altere aqui:
            header("Location: http://localhost/dfw/logado.php");
        } else {
            // Altere aqui:
            header("Location: http://localhost/dfw/page1.php");
        }
        break;
    
    case 'logout':
        session_destroy();
        // direciona para tela de login        
        break;
    
    default:
        
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
        $_SESSION['DAOUSUARIO'] = serialize($usuario); // serializa o dao e coloca na sessao
        return true;
    } else {
        return false;
    }
}

// Função que gera um token, atribui-o à sessão e retorna-o
// Analizar Isto:
// http://php.net/manual/pt_BR/function.uniqid.php
// 1º Gera um número aleatório
// 2º Gera um ID único, cujo prefixo é o número gerado aleatoriamente
// 3º Calcula um hash MD5 do ID único gerado anteriormente
function gerarToken() {    
    return md5(uniqid(rand()));
}

// TODO: Continuar desenvolvimento do controle de acesso. Analizar Tokens
