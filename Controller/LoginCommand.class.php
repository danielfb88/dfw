<?php
require_once 'lib/framework/controller/command/Command.class.php';
require_once 'lib/framework/controller/request/Request.class.php';

class LoginCommand extends Command {
    function doExecute(Request $request) {
        die("Login Command!");
    }
}