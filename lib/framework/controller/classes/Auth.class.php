<?php
// TODO: Analizar Requires
require_once 'lib/framework/paths.php';

/**
 * Classe de Autenticação, login e logoff
 * Data de Criação: 9 de Maio de 2012
 *  
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
class Auth {

    private static $error;

    public static function login($user, $password) {
        if ((empty($user) || is_null($user)) || (empty($password) || is_null($password)))
            return null;

        require_once 'model/DAOUsuario.class.php';

        $usuario = new DAOUsuario();
        $usuario->usuario = $user;
        $usuario->senha = $password;
        $usuario->read();

        if ($usuario->found) {
            return $usuario;
        } else {
            self::$error = "Usuário não encontrado";
            return null;
        }
    }

    public static function logout() {
        session_destroy();
    }

    public static function getError() {
        return self::$error;
    }

}