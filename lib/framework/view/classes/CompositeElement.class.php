<?php

/**
 * Super classe para elementos compostos
 * 
 * Data de Criação: 28 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @abstract
 * 
 */
require_once 'HtmlElement_Interface.php';
require_once 'CompositeElement_Interface.php';

abstract class CompositeElement implements CompositeElement_Interface, HtmlElement_Interface {

    /**
     * Método que transforma atributos em métodos set
     * @param string $attribute
     * @return string 
     */
    protected function parseAttributeToSetMethod($attribute) {
        $attribute[0] = strtoupper($attribute[0]); // transformando a primeira letra em maiúscula
        return "set" . $attribute;
    }
    
    /**
     * Executa o método especificado com 1 parâmetro de entrada
     * @param object $obj
     * @param string $method
     * @param string $value
     * @throws type 
     */
    protected function executeMethod(&$obj, $method, $value) {
        $objReflected = new ReflectionObject($obj);
        if ($objReflected->hasMethod($method)) {
            $obj->$method($value);  // executando o método
            unset($objReflected);
        } else {
            throw $e = new Exception('O método especificado não existe na classe ' . $objReflected->getName());
        }
    }
}