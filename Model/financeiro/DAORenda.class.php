<?php

/**
 * DAORenda
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @since       19 de Maio de 2012
 * @version     1.0
 * 
 */
require_once 'model/DAO.class.php';

class DAORenda extends DAO {

    public $id_renda;
    public $descricao;
    public $valor;
    public $tipo;
    public $observacao;

    public function __construct() {
        parent::__construct();
    }

    protected function config() {
        $this->tableName = "fin_renda";
        $this->configProps['primaryKey']['field'] = array("id_renda");
        $this->configProps['primaryKey']['is_autoIncrement'] = true;
        //$this->dtoClassName = "DTOUsuario";
    }

}