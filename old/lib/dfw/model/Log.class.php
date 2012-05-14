<?php

/**
 * Registra açoes realizadas
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @since       22 de Abril de 2012
 * @version     1.0
 * 
 */
require_once 'DAO.class.php';

class Log extends DAO {

    public $id_log;
    public $id_usuario;
    public $ip;
    public $mensagem;
    public $sql;
    public $data_hora;

    public function __construct() {
        parent::__construct();
    }

    protected function config() {
        $this->tableName = "userlog";
        $this->configProps['primaryKey']['field'] = array("id_log");
        $this->configProps['primaryKey']['is_autoIncrement'] = true;
    }

}