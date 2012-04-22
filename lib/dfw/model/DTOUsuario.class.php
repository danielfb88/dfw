<?php

class DTOUsuario {
    public $id_usuario;
    public $nome;
    public $email;
    public $login;
    public $password;
    public $status; 
    public $data_criacao;
    
    function __construct($id_usuario = null, $nome = null, $email = null, $login = null, 
            $password = null, $status = null, $data_criacao = null) {
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->email = $email;
        $this->login = $login;
        $this->password = $password;
        $this->status = $status;
        $this->data_criacao = $data_criacao;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getData_criacao() {
        return $this->data_criacao;
    }

    public function setData_criacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }
}