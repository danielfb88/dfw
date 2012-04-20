<?php

require_once PATH.'lib/dfw/model/DAO.class.php';
require_once PATH.'model/DTO/DTOUsuario.php';

/**
 * Classe DAOUsuario.
 * 
 * Data de Criação: 31 de Março de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmai.com>
 * @version     1.0
 */

class DAOUsuario extends DAO {
    public $id_usuario;
    public $nome;
    public $email;
    public $password;
    public $status; 
    public $data_criacao;
        
    public function __construct() {
        parent::__construct();
        $this->tableName = "usuario";
        $this->configProps['primaryKey']['field'] = array("id_usuario");
        $this->configProps['primaryKey']['is_autoIncrement'] = true;
        $this->dtoClassName = "DTOUsuario";
    }
    
}
?>
