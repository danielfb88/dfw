<?php
/**
 * Arquivo que registra as açoes realizadas no Banco de dados 
 */

// Mensagens do Log
define("NOVO_USUARIO", "Novo Usuário criado");


/**
 * Função que registra ação realizada no Banco
 * @param type $id_usuario
 * @param type $sql
 * @param type $mensagem 
 */
function registraLog($id_usuario, $sql, $mensagem = null) {
    require_once 'lib/dfw/model/Log.class.php';
    
    $log = new Log();
    $log->id_usuario = $id_usuario;
    $log->ip = $_SERVER['REMOTE_ADDR'];
    $log->sql = $sql; // usar lastQuery do DAO para pegar o sql
    $log->mensagem = $mensagem;
    $log->data_hora = date("Y-m-d h:i:s");

    $log->insert();
    return true;
}