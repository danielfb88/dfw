<?php
require_once 'lib/framework/controller/SessionHelper.class.php';
require_once 'Model/DAOUsuario.class.php';
require_once 'Model/DAORenda.class.php';

/**
 * Controlador de ações do módulo de Renda 
 * Data de criação: 27 de Maio de 2012
 * 
 * @author Daniel Bonfim <daniel.fb88@gmail.com>
 * @version 1.0
 */
class Renda_controller {

    /**
     * Insere o form para a criação de um novo registro 
     */
    public function frmAdd() {
        require_once 'View/financeiro/renda/frm_addRenda_view.php';
    }

    /**
     * Insere o form para a edição de um registro cujo o id foi passado por parâmetro no request
     * @param Request $request 
     */
    public function frmEdit(Request $request) {
        require_once 'View/financeiro/renda/frm_editRenda_view.php';
    }

    /**
     * Lista todos os registros
     * @param Request $request 
     */
    public function listAll(Request $request) {
        $sessionHelper = new SessionHelper();
        $daoUsuario = $sessionHelper->getDAOUsuario();

        $daoRenda = new DAORenda();
        $daoRenda->id_usuario = $daoUsuario->id_usuario;
        $arrRenda = $daoRenda->getAll();
        print_r($arrRenda);
    }

    /**
     * Salva o registro
     * @param Request $request 
     */
    public function add(Request $request) {
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

    /**
     * Edita o registro
     * @param Request $request 
     */
    public function edit(Request $request) {
        $daoRenda = new DAORenda();
        $daoRenda->id_renda = $request->getId();
        $daoRenda->descricao = $request->getProperty('tx_descricao');
        $daoRenda->valor = $request->getProperty('tx_valor');
        $daoRenda->tipo = $request->getProperty('tx_tipo');
        $daoRenda->observacao = $request->getProperty('tx_observacao');
        $daoRenda->update();

        echo '<br/>Renda Editada com sucesso!<br/>';
    }

    /**
     * Deleta o registro
     * @param Request $request 
     */
    public function delete(Request $request) {
        $daoRenda = new DAORenda();
        // usuario_id
        $daoRenda->id_renda = $request->getId();
        $daoRenda->delete();

        echo '<br/>Renda Deletada com sucesso!<br/>';
    }

}