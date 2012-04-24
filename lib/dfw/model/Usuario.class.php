<?php
/**
 * DFW Framework PHP
 * 
 * Classe Usuário padrão
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @since       22 de Abril de 2012
 * @version     1.0
 * 
 */

require_once 'DAO.class.php';

class Usuario extends DAO {
    public $id_usuario;
    public $nome;
    public $email;
    public $usuario;
    public $senha;
    public $status; 
    public $data_criacao;
    
    public function __construct() {
        parent::__construct();
        // não é para gravar a hora que o objeto é construído, é na hora q é gravado
        //$this->data_criacao = date("Y-m-d H:i:s");
    }
        
    protected function config() {
        $this->tableName = "usuario";
        $this->configProps['primaryKey']['field'] = array("id_usuario");
        $this->configProps['primaryKey']['is_autoIncrement'] = true;
        //$this->dtoClassName = "DTOUsuario";
    }
}