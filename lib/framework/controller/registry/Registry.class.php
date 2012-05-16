<?php

/**
 * Classe abstrata Registry
 * Data de criação: 14 de Maio de 2012
 * 
 * @author Daniel Bonfim
 * @version 1.0
 * @abstract 
 */
abstract class Registry {

    /**
     * Retorna índice do array
     * @param string $key
     * @return mixed 
     */
    protected abstract function get($key);

    /**
     * Seta par chave-valor ao array
     * @param string $key
     * @param mixed $value
     */
    protected abstract function set($key, $value);
}