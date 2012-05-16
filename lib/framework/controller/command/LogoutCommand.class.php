<?php

require_once 'controller/command/Command.class.php';
require_once 'controller/request/Request.class.php';
require_once 'controller/registry/SessionRegistry.class.php';
require_once 'controller/classes/Auth.class.php';

class LogoutCommand extends Command {

    function doExecute(Request $request) {
        Auth::logout();
        echo '<br/> Logout <br/>';
        
    }

}