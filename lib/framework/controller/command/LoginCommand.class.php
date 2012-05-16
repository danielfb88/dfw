<?php

require_once 'controller/command/Command.class.php';
require_once 'controller/request/Request.class.php';
require_once 'controller/registry/SessionRegistry.class.php';
require_once 'controller/classes/Auth.class.php';

class LoginCommand extends Command {

    function doExecute(Request $request) {
        $tx_user = $request->getProperty('tx_user');
        $tx_password = $request->getProperty('tx_password');

        if (!empty($tx_user) && !empty($tx_password)) {
            
            $daoUsuario = Auth::login($tx_user, $tx_password);
            if ($daoUsuario != null) {
                // Autenticando usuário
                SessionRegistry::getInstance()->authenticate();
                // Colocando o DAOUsuario na SESSAO
                SessionRegistry::getInstance()->setDAOUsuario($daoUsuario);
                die("LoginCommand: Logado");

                // TODO: PAra LOGINCOMMAND acho que é melhor dar um header ao invés de include. 
                // Vamos direciona-lo para um novo lugar, provavelmente terá um novo design.
                // Depois usaremos apenas os templates.
                
                // header para index.php?cmd=main
            } else {
                $request->addFeedback("Usuário não encontrado.");
                // header para index.php?cmd=login
                die("LoginCommand: Usuário não encontrado.");
            }
            
        } else {
            $request->addFeedback("Dados incorretos.");
            die("LoginCommand: Dados incorretos.");
        }
    }

}