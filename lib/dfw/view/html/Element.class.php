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
    public $id;
    public $class;    
    public $title;
    public $style;
    
    public function show() {
        
        if(!empty($this->id))
            $element = ' id=\''.$this->id.'\' ';
        
        if(!empty($this->class))
            $element .= ' class=\''.$this->class.'\' ';
        
        if(!empty($this->title))
            $element .= ' title=\''.$this->title.'\' ';
        
        if(!empty($this->style))
            $element .= ' style=\''.$this->style.'\' ';
        
        $element .= parent::show();
        
        return $element;
        
    }
}
?>
