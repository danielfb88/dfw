<?php

require_once 'lib/framework/controller/command/Command.class.php';
require_once 'lib/framework/controller/request/Request.class.php';

class LoginScreen extends Command {

    function doExecute(Request $request) {
        require_once 'View/loginScreen.php';
    }

}