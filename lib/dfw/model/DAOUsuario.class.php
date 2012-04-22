<?php
require_once 'DAO.class.php';

class DAOUsuario extends DAO {
    public $id_usuario;
    public $nome;
    public $email;
    public $login;
    public $password;
    public $status; 
    public $data_criacao;
    
    public function __construct() {
        parent::__construct();
        $this->data_criacao = date("d-m-Y H:i:s");
    }
        
    protected function config() {
        $this->tableName = "usuario";
        $this->configProps['primaryKey']['field'] = array("id_usuario");
        $this->configProps['primaryKey']['is_autoIncrement'] = true;
        $this->dtoClassName = "DTOUsuario";
    }
}
?>
