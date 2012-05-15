<?php
require_once 'lib/framework/controller/command/Command.class.php';
require_once 'lib/framework/controller/request/Request.class.php';

class TesteCommand extends Command {
    function doExecute(Request $request) {
        die("Command de teste OK!");
    }
}