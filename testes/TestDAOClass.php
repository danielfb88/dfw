<?php
// Caminhos incorretos.
require_once '../lib/config.php';
require_once PATH.'tests/simpletest/autorun.php';
require_once PATH.'usuario/DAOUsuario.php';

class TestDAOClass extends UnitTestCase {
    /**
     * Todos os métodos e atributos da classe DAOUsuario herdada de DAO devem ser publicos para o correto 
     * funcionamento destes testes. 
     */
    
    function testConstruct() {
        $usuario = new DAOUsuario();
        $this->assertEqual($usuario->className, "DAOUsuario", "Construtor: Nome da subclasse incorreta.");        
    }
    
    function testPegaTodasPropriedadesEValoresDaSubClasse() {
        $usuario = new DAOUsuario();
        $this->assertEqual($usuario->getChildProperties(), array("id_usuario" => null, "nome"  => null, "email" => null, "password"  => null, "status"  => null, "data_criacao"  => null), "getChildProperties");
    }
    
    function testPegaPropriedadesDaSubClasseQuePossuaValorDefinidoPeloUsuario() {
        $usuario = new DAOUsuario();
        $usuario->id_usuario = 1;
        $usuario->nome = "Daniel";
        $usuario->password = "1234";
        $properties = $usuario->getChildProperties();
        $filterValues = $usuario->getFilterValues($properties);
        $this->assertEqual($filterValues, array("id_usuario" => 1, "nome"  => "Daniel", "password"  => "1234"), "getFilterValues");
    }
    
    function testSQLParaSELECT() {
        $usuario = new DAOUsuario();
        $usuario->id_usuario = 1;
        $usuario->nome = "Daniel";
        $usuario->password = "1234";
        $properties = $usuario->getChildProperties();
        $filterValues = $usuario->getFilterValues($properties);
        
        $this->assertNotNull($usuario->select($properties, $filterValues, "like"), "Deu erro em 'select'");        
    }
    
    function testSQLParaINSERT() {
        $usuario = new DAOUsuario();
        $usuario->id_usuario = 1;
        $usuario->nome = "Daniel";
        $usuario->password = "1234";
        $properties = $usuario->getChildProperties();
        $filterValues = $usuario->getFilterValues($properties);
        
        $this->assertNotNull($usuario->insert($filterValues, false), "Deu erro em 'insert'");        
    }
    
    function testVerificaSeCamposPrimaryKeyDefinidoSubClasse() {
        $usuario = new DAOUsuario();                
        $this->assertTrue($usuario->checkFieldPrimaryKeyExists(), "checkFieldPrimaryKeyExists");        
    }
    
    function testVerificaSeValoresDosCamposPrimaryKeyDefinidos() {
        $usuario = new DAOUsuario();        
        $usuario->id_usuario = 1;
        //$usuario->nome = null;
        $properties = $usuario->getChildProperties();
        $this->assertTrue($usuario->checkValuePrimaryKeyExists($properties), "checkFieldPrimaryKeyExists");        
    }
    
    function testSQLParaUPDATE() {
        $usuario = new DAOUsuario();
        $usuario->id_usuario = 4;
        $usuario->nome = "Daniel";
        $usuario->password = "1234";
        $properties = $usuario->getChildProperties();
        //print_r($properties);die;
                
        $this->assertNotNull($usuario->update($properties, false), "Deu erro em 'update'");        
    }
    
    function testRecuperaRegistroNoDAO() {
        $usuario = new DAOUsuario();
        $usuario->id_usuario = 12;
        $usuario->password = "1234";
        $usuario->read(false);
                
        $this->assertEqual($usuario->nome, "Daniel");        
    }
    
    function testRecuperaArrayDeDTO() {
        $usuario = new DAOUsuario();
        $usuario->id_usuario = 12;
        $usuario->password = "1234";
        $arr = $usuario->getAll();
        print_r($arr);
                
        $this->assertIsA($arr, "array");        
    }
    
    function testResetaCamposDoDAO() {
        $usuario = new DAOUsuario();
        $usuario->id_usuario = 12;
        $usuario->password = "1234";
        $usuario->read(false);
                
        $this->assertEqual($usuario->nome, "Daniel");   
        
        $usuario->reset();
        
        $properties = $usuario->getChildProperties();
        $isAllNull = true;
        foreach($properties as $prop) {
            if($prop != null) 
                $isAllNull = true;
        }
        $this->assertTrue($isAllNull);
    }

    
}
?>
