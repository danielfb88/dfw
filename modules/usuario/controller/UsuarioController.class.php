<?php
require_once PATH.'controller/Controller.class.php';
require_once PATH.'model/DAO/DAOUsuario.class.php';

class UsuarioController extends Controller {
    
    /*
     * Açoes básicas
     */
    
    static function add($data) {
        $daoUsuario = new DAOUsuario();
        $daoUsuario->setData($data);
        $daoUsuario->save();
    }
    
    static function edit($data) {
        if(!$data['id_usuario']) {
            // trata o fluxo
        }
        $daoUsuario = new DAOUsuario();
        $daoUsuario->setData($data);
        $daoUsuario->save();
    }
    
    static function delete($params) {
        if(!$data['id_usuario']) {
            // trata o fluxo
        }
        $daoUsuario = new DAOUsuario();
        $daoUsuario->id_usuario = $id_usuario;
        $daoUsuario->delete();
    }
  
    static function get($params) {
        
        // devolve um DTO para view
    }
    
    static function getAll($params) {
        
        // devolve array de dto para view
    }
    
    /*
     * Ações customizadas
     */

}
?>
