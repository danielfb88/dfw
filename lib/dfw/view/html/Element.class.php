<?php
require_once 'Event.class.php';

/**
 * ****************************************************************
 * Classe Element                                                 *
 *----------------------------------------------------------------*
 * Elemento XHTML
 * 
 * Data de Criação: 14 de Abril de 2012                           *
 *                                                                *
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>             *
 * @version     1.0                                               *
 * @abstract                                                      *
 *                                                                *
 * ****************************************************************
 */

abstract class Element extends Event{
    public $class;
    public $id;
    public $title;
    public $style;
}
?>
