<?php
/**
 * Aquivo que efetua verificações de segurança 
 */

require_once 'location.php';

/**
 * Função que gera um token
 * @return type 
 */
function gerarToken() {
    return md5(uniqid(rand()));
}

/**
 * Verifica se o usuário está logado
 * @return type 
 */
function loggedUser() {
    require_once 'model/Usuario.class.php';
    $daoUsuario = unserialize($_SESSION['DAOUSUARIO']);
    if($daoUsuario->found) {
        return true;
    } else {
        header("Location: ".LOGIN_SCREEN);
    }
}
?>
