<?php

require_once PATH.'lib/DAO.class.php';
require_once PATH.'model/DTO/DTOUsuario.php';


class DAOTeste extends DAO {
    public $id1;
    public $id2;
    public $campo1;
    public $campo2;
    public $campo3;
    public $campo4;
    public $numero;
        
    public function __construct() {
        parent::__construct();
        $this->tableName = "teste";
        $this->configProps['primaryKey'] = array('id1', 'id2');
        $this->configProps['notNull'] = array('numero', 'campo4');
        //$this->primaryKey = "id";
        //$this->dtoClassName = "DTOUsuario";
    }
    
}
?>
