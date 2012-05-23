<?php

require_once 'controller/command/Command.class.php';
require_once 'controller/request/Request.class.php';
require_once 'controller/SessionHelper.class.php';

class LogoutCommand extends Command {

    function doExecute(Request $request) {
        $sessionHelper = new SessionHelper();
        $sessionHelper->session_destroy();
        
        echo '<br/> Logout <br/>';
        header("Location: index.php");
        
    }

}