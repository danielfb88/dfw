<?php

/**
 * Aquivo que efetua verificações de segurança 
 */
require_once 'auth_location.php';

/**
 * Verifica se o usuário está logado
 * @return boolean 
 */
function loggedUser() {
    if (isset($_SESSION['USER'])) {
        return true;
    }
    // falhou
    header("Location: " . LOGIN_SCREEN);
    return false;
}

/**
 * Função que gera um token
 * @return string 
 */
function gerarToken() {
    return md5(uniqid(rand()));
}

/**
 * Verifica se o token recebido é válido e libera o acesso em caso positivo.
 * 
 * Este método é utilizado em redução de riscos para Spoofing de formulário.
 * No formulário conterá um hidefield com o valor do SESS_TOKEN obtido pela SESSÃO. Na página para onde estes dados
 * serão enviados será executado este método comparando o token da sessão com o token recebido.
 * Este token estará sempre sendo atualizado.
 * 
 * @return boolean 
 */
function checkToken() {
    if (isset($_SESSION['SESS_TOKEN'])) {
        if ($_SESSION['SESS_TOKEN'] == $_REQUEST['SESS_TOKEN']) {
            $_SESSION['SESS_TOKEN'] == gerarToken();    // novo token
            return true;
        }
    }
    // falhou
    $_SESSION['SESS_TOKEN'] == gerarToken();    // novo token
    header("Location: " . LOGIN_SCREEN);
    return false;
}