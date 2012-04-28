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
require_once 'HtmlElement.inter.php';

abstract class CompositeElement implements HtmlElement {

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