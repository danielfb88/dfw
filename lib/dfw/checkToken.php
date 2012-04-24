<?php

/**
 * Verifica se o token recebido é válido e libera o acesso em caso positivo
 * @param type $token
 * @return boolean 
 */
function checkToken($token) {
    if(isset($_SESSION['SESS_TOKEN'])) {
        if($_SESSION['SESS_TOKEN'] == $token) {
            return true;
        } 
        // Modifique aqui:
        header("Location: http://localhost/dfw/page1.php");
    }
}
?>
