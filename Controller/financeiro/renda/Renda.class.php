<?php

require_once 'controller/command/Command.class.php';
require_once 'controller/request/Request.class.php';
require_once 'controller/SessionHelper.class.php';
require_once 'Model/financeiro/DAORenda.class.php';
require_once 'Model/DAOUsuario.class.php';

class Renda extends Command {

    function doExecute(Request $request) {
        switch ($request->getProperty('action')) {

            case 'listAll':
                $this->listAll($request);
                break;

            case 'frmAdd':
                $this->frmAdd();
                break;

            case 'frmEdit':
                $this->frmEdit($request);
                break;

            case 'add':
                $this->add($request);
                break;

            case 'edit':
                $this->edit($request);
                break;

            case 'delete':
                $this->delete($request);
                break;

            default:
                $this->listAll($request);
        }
    }

    private function frmAdd() {
        require_once 'View/financeiro/renda/frm_addRenda.php';
    }

    private function frmEdit(Request $request) {
        require_once 'View/financeiro/renda/frm_editRenda.php';
    }

    private function listAll($request) {
        $sessionHelper = new SessionHelper();
        $daoUsuario = $sessionHelper->getDAOUsuario();
                
        $daoRenda = new DAORenda();
        $daoRenda->id_usuario = $daoUsuario->id_usuario;
        $arrRenda = $daoRenda->getAll();
        print_r($arrRenda);
    }

    private function add(Request $request) {
        $sessionHelper = new SessionHelper();
        $daoUsuario = $sessionHelper->getDAOUsuario();
        
        $daoRenda = new DAORenda();
        $daoRenda->id_usuario = $daoUsuario->id_usuario;
        $daoRenda->descricao = $request->getProperty('tx_descricao');
        $daoRenda->valor = $request->getProperty('tx_valor');
        $daoRenda->tipo = $request->getProperty('tx_tipo');
        $daoRenda->observacao = $request->getProperty('tx_observacao');
        $daoRenda->insert();

        echo '<br/>Renda Inserida com sucesso!<br/>';
    }

    private function edit(Request $request) {
        $daoRenda = new DAORenda();
        $daoRenda->id_renda = $request->getId();
        $daoRenda->descricao = $request->getProperty('tx_descricao');
        $daoRenda->valor = $request->getProperty('tx_valor');
        $daoRenda->tipo = $request->getProperty('tx_tipo');
        $daoRenda->observacao = $request->getProperty('tx_observacao');
        $daoRenda->update();

        echo '<br/>Renda Editada com sucesso!<br/>';
    }

    private function delete(Request $request) {
        $daoRenda = new DAORenda();
        // usuario_id
        $daoRenda->id_renda = $request->getId();
        $daoRenda->delete();

        echo '<br/>Renda Deletada com sucesso!<br/>';
    }

}