<?php
/**
 * DFW Framework PHP - Classe Singleton Option
 * 
 * Elemento Option usado pelo controle Select.  
 * Data de Criação: 15 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @final
 * 
 */

require_once 'Element.class.php';

final class Option extends Element {
    protected $disabled;
    protected $label;
    protected $selected;
    protected $value;
    protected $text;
        
    /**
     * Instância do Singleton
     * @var Select
     */
    private static $instance;
    
    private function __construct() { }
    
    /**
     * Retorna instância única do singleton
     * @return Option
     */
    public static function getInstance() {
        if(empty(self::$instance)) 
            self::$instance = new Option();
        
        return self::$instance;
    }
    
    /**
     * Desabilita o controle de modo que o usuário não poderá interagir com ele
     * @param type $disabled
     * @return \Option 
     */
    public function setDisabled($disabled) {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * Rótulo vinculado à opção
     * @param type $label
     * @return \Option 
     */
    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }

    /**
     * Opção selecionada previamente
     * @param type $selected
     * @return \Option 
     */
    public function setSelected($selected) {
        $this->selected = $selected;
        return $this;
    }

    /**
     * Valor correspondente à opção e que será atribuído ao controle
     * @param type $value
     * @return \Option 
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }
    
    /**
     * Texto do Option
     * @param type $text
     * @return \Option 
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }
    
    /**
     * Retorna a string de option para ser inserido no select.
     * As variáveis do Singleton são sempre limpas ao final deste método. 
     * @return string 
     */
    public function returnAsString() {
        $element = '<option ';
        
        if($this->disabled)
            $element .= 'disabled=\'disabled\' ';
        
        if(!empty($this->label))
            $element .= 'label=\''.$this->label.'\' ';
        
        if($this->selected)
            $element .= 'selected=\'selected\' ';
        
        if(!empty($this->value))
            $element .= 'value=\''.$this->value.'\' ';
        
        $element .= parent::show();
        
        $element .= '>';        
        $element .= $this->text;        
        $element .= '</option>';
                
        // Limpando as configurações para uma nova chamada.
        $this->clear();
        
        // exibindo o resultado
        return $element;
    }
    
    protected function clear() {
        $this->disabled = null;
        $this->label = null;
        $this->selected = null;
        $this->value = null;
        $this->text = null;
        parent::clear();
    }

}
?>
