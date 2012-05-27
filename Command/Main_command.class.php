<?php
require_once 'lib/framework/controller/command/Command.class.php';
require_once 'lib/framework/controller/request/Request.class.php';

class Main_command extends Command {
    function doExecute(Request $request) {
        die("It works!");
    }
}