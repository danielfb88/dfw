<?php

require_once 'controller/command/Command.class.php';
require_once 'controller/request/Request.class.php';

class LoginScreen extends Command {

    function doExecute(Request $request) {
        require_once 'View/loginScreen.php';
    }

}