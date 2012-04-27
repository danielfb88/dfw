<?php
/**
 * DFW Framework PHP - Classe Option
 * 
 * Elemento Option usado pelo controle Select.  
 * Data de Criação: 15 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */

require_once 'Element.class.php';

class Option extends Element {
    protected $disabled;
    protected $selected;
    protected $value;
    protected $text;
    
    /**
     * 
     * @param string $value
     * @param string $text
     * @param boolean $selected
     */
    public function __construct($value, $text, $selected = false, $id = null) {
        $this->id = $id;
        $this->value = $value;
        $this->text = $text;
        $this->selected = $selected;      
    }
        
    /**
     * Desabilita o controle de modo que o usuário não poderá interagir com ele
     * @param boolean $disabled
     */
    public function setDisabled($disabled) {
        $this->disabled = $disabled;
    }

    /**
     * Opção selecionada previamente
     * @param boolean $selected
     */
    public function setSelected($selected) {
        $this->selected = $selected;
    }

    /**
     * Valor correspondente à opção e que será atribuído ao controle
     * @param type $value
     */
    public function setValue($value) {
        $this->value = $value;
    }
    
    /**
     * Texto do Option
     * @param type $text
     */
    public function setText($text) {
        $this->text = $text;
    }
    
    /**
     * Retorna a string de option para ser usado no select.
     * @return string 
     */
    public function returnAsString() {
        $element = '<option ';
        
        if($this->disabled)
            $element .= 'disabled=\'disabled\' ';
                
        if($this->selected)
            $element .= 'selected=\'selected\' ';
        
        if(!empty($this->value))
            $element .= 'value=\''.$this->value.'\' ';
        
        $element .= parent::returnAttributesAsString();
        
        $element .= '>';        
        $element .= $this->text;     
        $element .= '</option>';
        
        return $element;
    }
}