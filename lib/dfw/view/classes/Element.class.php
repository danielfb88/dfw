<?php
/**
 * DFW Framework PHP - Classe abstrata Element
 * 
 * Possui atributos HTML comum para todos os elementos.
 * Data de Criação: 14 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @abstract
 * 
 */

require_once 'Event.class.php';

abstract class Element extends Event {
    protected $id;
    protected $class;
    protected $title;
    protected $style;
    
    /**
     * Identificador único e exclusivo
     * @param type $id
     * @return \Element 
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Classe ou classes do elemento
     * @param type $class
     * @return \Element 
     */
    public function setClass($class) {
        $this->class = $class;
        return $this;
    }

    /**
     * Título do elemento
     * @param type $title
     * @return \Element 
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * Declaração de estilo para um elemento
     * @param type $style
     * @return \Element 
     */
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
        $this->style = null;
        $this->title = null;
        parent::clear();
    }
}
?>
