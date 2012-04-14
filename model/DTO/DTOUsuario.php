<?php

class DTOUsuario {
    private $id_usuario;
    private $nome;
    private $email;
    private $password;
    private $status; 
    private $data_criacao;
    
    function __construct($id_usuario = null, $nome = null, $email = null, $password = null, 
            $status = null, $data_criacao = null) {
        
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->data_criacao = $data_criacao;
    }

    
    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getData_criacao() {
        return $this->data_criacao;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setData_criacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }

}
?>
