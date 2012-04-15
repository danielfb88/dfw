<?php
require_once 'Element.class.php';
/**
 * ****************************************************************
 * Classe Input                                                    *
 *----------------------------------------------------------------*
 * Elemento de Input XHTML
 * 
 * Data de Criação: 14 de Abril de 2012                           *
 *                                                                *
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>             *
 * @version     1.0                                               *
 *                                                                *
 * ****************************************************************
 */
class Input extends Element {    
    public $type;
    public $accept;
    public $accesskey;
    public $alt;
    public $checked;
    public $disabled;
    public $maxlength;
    public $name;
    public $readonly;
    public $size;
    public $src;
    public $tabindex;
    public $value;
    
    # Eventos específicos
    # Ocorre quando o elemento perde o foco
    public $onblur;
    # Ocorre quando o elemento ganha foco
    public $onfocus;
    
    public function show() {
        $input = '<input ';
        
        if(!empty($this->type)) {
            switch ($this->type) {
                case 'text':
                case 'password':
                case 'checkbox':
                case 'button':
                case 'radio':
                case 'submit':
                case 'reset':
                case 'file':
                case 'hidden':
                case 'image':
                    $input .= ' type=\''.$this->type.'\' ';
                    break;
                default:
                    throw $e = new Exception('Tipo do Input inválido');
                    $e->getTraceAsString();
            }
            
        }
        
        if(!empty($this->accept))
            $input .= ' accept=\''.$this->accept.'\' ';
        
        if(!empty($this->accesskey))
            $input .= ' accesskey=\''.$this->accesskey.'\' ';
        
        if(!empty($this->alt))
            $input .= ' alt=\''.$this->alt.'\' ';
        
        if($this->checked)
            $input .= ' checked=\'checked\' ';
        
        if(($this->type == 'radio' || $this->type == 'checkbox') && $this->disabled)
            $input .= ' disabled=\'disabled\' ';
        
        if(!empty($this->maxlength))
            $input .= ' maxlength=\''.$this->maxlength.'\' ';
        
        if($this->readonly)
            $input .= ' readonly=\'readonly\' ';
        
        if(!empty($this->size))
            $input .= ' size=\''.$this->size.'\' ';
        
        if($this->type == 'image' && !empty($this->src))
            $input .= ' src=\''.$this->src.'\' ';
        
        if(!empty($this->tabindex))
            $input .= ' tabindex=\''.$this->tabindex.'\' ';
        
        if(!empty($this->value))
            $input .= ' value=\''.$this->value.'\' ';
        
        if(!empty($this->name))
            $input .= ' name=\''.$this->name.'\' ';
        
        $input .= parent::show();
        
        # Eventos
        if(!empty($this->onblur))
            $input .= ' onblur=\''.$this->onblur.'\' ';
        
        if(!empty($this->onfocus))
            $input .= ' onfocus=\''.$this->onfocus.'\' ';
        
        $input .= ' />';
                
        echo $input;
    }
}
?>
