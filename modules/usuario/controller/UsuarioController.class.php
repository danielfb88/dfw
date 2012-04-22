<?php
//require_once PATH.'controller/Controller.class.php';
//require_once PATH.'model/DAO/DAOUsuario.class.php';

//class UsuarioController extends Controller {
class UsuarioController {
    
    /*
     * Açoes básicas
     */
    
    static function adicionar($data) {
        $daoUsuario = new DAOUsuario();
        $daoUsuario->setData($data);
        $daoUsuario->insert();
    }
    
    static function editar($data) {
        if(!$data['id_usuario']) {
            // trata o fluxo
        }
        $daoUsuario = new DAOUsuario();
        $daoUsuario->setData($data);
        $daoUsuario->update();
    }
    
    static function deletar($params) {
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
