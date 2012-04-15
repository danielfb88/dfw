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

abstract class Element extends Event {
    /**
     * Identificador único e exclusivo
     * @var string 
     */
    protected $id;
    /**
     * Nome do controle que o identifica ao enviar o formulário
     * @var string
     */
    protected $name;
    /**
     * Classe ou classes do elemento
     * @var string
     */
    protected $class;
    /**
     * Título do elemento
     * @var string
     */
    protected $title;
    /**
     * Declaração de estilo para um elemento
     * @var string
     */
    protected $style;
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }    
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Único valor para o atributo name e id
     */
    public function setNameId($nameId) {
        $this->name = $nameId;
        $this->id = $nameId;
    }

    public function setClass($class) {
        $this->class = $class;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setStyle($style) {
        $this->style = $style;
        return $this;
    }
    
    public function show() {
        
        $element = '';
        if(!empty($this->id))
            $element .= ' id=\''.$this->id.'\' ';
        
        if(!empty($this->class))
            $element .= ' class=\''.$this->class.'\' ';
        
        if(!empty($this->title))
            $element .= ' title=\''.$this->title.'\' ';
        
        if(!empty($this->style))
            $element .= ' style=\''.$this->style.'\' ';
        
        $element .= parent::show();
        
        return $element;
    }
    
    /**
     * Limpa os valores dos atributos. 
     */
    protected function clear() {
        $this->class = null;
        $this->id = null;
        $this->name = null;
        $this->style = null;
        $this->title = null;
        parent::clear();
    }
}
?>
