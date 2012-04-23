<?php

require_once 'lib/dfw/model/Usuario.class.php';

class Auth {    
    public static function login($login, $password) {
        $usuario = new Usuario();
        $usuario->login = $login;
        $usuario->password = $password;
        $usuario->read();
        return $usuario->found;
    }

    /*
     * acho q esses metodos n serao necessarios
    public static function logout() {

    }
	
    public static function permission($flag) {
            //if(!$flag) 
                    // redireciona para login
            //else
                    // redireciona para adm.php
    }
     * 
     */

	
}
