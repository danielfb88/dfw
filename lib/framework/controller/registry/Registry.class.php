<?php

/**
 * Classe abstrata Registry
 * 
 * @author Daniel Bonfim
 * @version 1.0
 * @since 14 de Maio de 2012
 * @abstract 
 */
abstract class Registry {

    /**
     * Retorna índice do array
     * @param string $key
     * @return mixed 
     */
    protected abstract protected function get($key);

    /**
     * Seta par chave-valor ao array
     * @param string $key
     * @param mixed $value
     */
    protected abstract protected function set($key, $value);
}