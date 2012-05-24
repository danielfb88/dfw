<?php

/**
 * DAOConta
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @since       19 de Maio de 2012
 * @version     1.0
 * 
 */
require_once 'lib/framework/model/DAO.class.php';

class DAOConta extends DAO {

    public $id_conta;
    public $descricao;
    public $valor;
    public $tipo;
    public $dia_vencimento;
    public $observacao;

    public function __construct() {
        parent::__construct();
    }

    protected function config() {
        $this->tableName = "fin_renda";
        $this->configProps['primaryKey']['field'] = array("id_conta");
        $this->configProps['primaryKey']['is_autoIncrement'] = true;
        //$this->dtoClassName = "DTOUsuario";
    }

}