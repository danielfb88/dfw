<?php

require_once 'lib/framework/controller/command/Command.class.php';
require_once 'lib/framework/controller/request/Request.class.php';
require_once 'Controller/Renda_controller.class.php';

/**
 * Command do módulo de Renda.
 * Data de criação: 27 de Maio de 2012
 * 
 * @author Daniel Bonfim <daniel.fb88@gmail.com>
 * @version 1.0
 */
class Renda_command extends Command {

    function doExecute(Request $request) {
        $renda_controller = new Renda_controller();

        /*
         * a = Action
         */
        switch ($request->getProperty('a')) {

            case 'listAll':
                $renda_controller->listAll($request);
                break;

            case 'frmAdd':
                $renda_controller->frmAdd();
                break;

            case 'frmEdit':
                $renda_controller->frmEdit($request);
                break;

            case 'add':
                $renda_controller->add($request);
                break;

            case 'edit':
                $renda_controller->edit($request);
                break;

            case 'delete':
                $renda_controller->delete($request);
                break;

            default:
                $renda_controller->listAll($request);
        }
    }

}