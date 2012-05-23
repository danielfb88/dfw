<?php

require_once 'controller/command/Command.class.php';
require_once 'controller/request/Request.class.php';
require_once 'controller/SessionHelper.class.php';
require_once 'controller/classes/Auth.class.php';

/**
 * Para usar esta classe, o objeto Request deve conter os campos 'tx_user' e tx_password'
 * A página de login deve possuir o nome 'loginScreen' e estar no diretório da aplicação View/
 */
class AuthCommand extends Command {

    function doExecute(Request $request) {
         $sessionHelper = new SessionHelper();
                
        $tx_user = $request->getProperty('tx_user');
        $tx_password = $request->getProperty('tx_password');

        if (!empty($tx_user) && !empty($tx_password)) {

            $daoUsuario = Auth::login($tx_user, $tx_password);
            if ($daoUsuario != null) {
                // Autenticando usuário
                $sessionHelper->authenticate();
                // Colocando o DAOUsuario na SESSAO
                $sessionHelper->setDAOUsuario($daoUsuario);
                header("Location: index.php");
                
            } else {
                $request->addFeedback("Usuário não encontrado.");
                require_once 'View/loginScreen.php';
            }
        } else {
            $request->addFeedback("Dados incorretos.");
            require_once 'View/loginScreen.php';
        }
    }

}