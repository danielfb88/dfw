<?php
/**
 * DFW Framework PHP - TextField
 * 
 * Elemento TextField
 * Data de Criação: 14 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @final
 * 
 */

require_once 'Element.class.php';

class TextField extends Element {
    # Atributos do Label
    protected $for;
    protected $text;
    
    # Atributos do Input
    protected $type;
    protected $accept;
    protected $accesskey;
    protected $alt;
    protected $disabled;
    protected $maxlength;
    protected $name;
    protected $readonly;
    protected $size;
    protected $tabindex;
    protected $value;
    # Eventos Intrínsecos
    protected $onblur;
    protected $onchange;
    protected $onfocus;
    protected $onselect;
    
    public function __construct() {
        // criar contrutor p/ label e input
    }
    
    /*
     * ################ Métodos do Label ################
     */
    
    /**
     * Texto do Label
     * @param type $text
     * @return \Label 
     */
    public function setLabel($label) {
        $this->text = $label;
    }
    
    /**
     * Monta o elemento
     * @return string 
     */
    private function mountLabel() {
        $element = '<label ';
                
        if(!empty($this->for))
            $element .= 'for=\''.$this->for.'\' ';        
        
        $element .= parent::show();
        
        # Eventos Intrínsecos
        if(!empty($this->onblur))
            $element .= 'onblur=\''.$this->onblur.'\' ';
        
        if(!empty($this->onfocus))
            $element .= 'onfocus=\''.$this->onfocus.'\' ';
        
        $element .= '>';
        $element .= $this->text;
        $element .= '</label>';
        
        return $element;
    }
    
    /*
     * ################ Métodos do Input ################
     */
    
    /**
     * Tipo do controle
     * @param type $type
     * @return \Input
     * @throws type 
     */
    public function setType($type = 'text') {        
        switch ($type) {
            case 'text':
            case 'password':
                $this->type = $type;
                break;
            default:
                throw $e = new Exception('Tipo do TextField inválido');
                $e->getTraceAsString();
        }
    }

    /**
     * Tipos de conteúdo (MIME) que o servidor deve aceitar, usado quando type="text"
     * @param type $accept
     * @return \Input 
     */
    public function setAccept($accept) {
        $this->accept = $accept;
    }

    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @param type $accesskey
     * @return \Input 
     */
    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
    }

    /**
     * Texto alternativo
     * @param type $alt
     * @return \Input 
     */
    public function setAlt($alt) {
        $this->alt = $alt;
    }

    /**
     * Desabilita o controle de modo que o usuário não poderá interagir com ele
     * @param boolean $disabled
     * @return \Input 
     */
    public function setDisabled($disabled) {
        if($disabled)
            $this->disabled = "disabled";
    }

    /**
     * Número máximo de caracteres que o usuário pode inserir em um campo 'text' ou 'password’
     * @param type $maxlength
     * @return \Input 
     */
    public function setMaxlength($maxlength) {
        $this->maxlength = $maxlength;
    }   
    
    /**
     * Nome do controle que o identifica ao enviar o formulário
     * @param type $name
     * @return \Input 
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Indica que o controle será utilizado somente para leitura, impedindo alterações em seus valores
     * @param type $readonly
     * @return \Input 
     */
    public function setReadonly($readonly) {
        $this->readonly = $readonly;
    }

    /**
     * Tamanho inicial do controle 
     * (Pode ser expresso em pixels. Quando type="password" ou type="text" o tamanho indica o número de caracteres)
     * @param type $size
     * @return \Input 
     */
    public function setSize($size) {
        $this->size = $size;
    }

    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @param type $tabindex
     * @return \Input 
     */
    public function setTabindex($tabindex) {
        $this->tabindex = $tabindex;
    }

    /**
     * Valor previamente definido
     * @param type $value
     * @return \Input 
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * Ocorre quando o elemento perde o foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onblur
     * @return \Input 
     */
    public function setOnblur($onblur) {
        $this->onblur = $onblur;
    }

    /**
     * Ocorre quando o conteúdo do controle é alterado
     * @param type $onchange
     * @return \Input 
     */
    public function setOnchange($onchange) {
        $this->onchange = $onchange;
    }

    /**
     * Ocorre quando o elemento entra em foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onfocus
     * @return \Input 
     */
    public function setOnfocus($onfocus) {
        $this->onfocus = $onfocus;
    }

    /**
     * Ocorre quando se seleciona algum texto dentro do controle
     * @param type $onselect
     * @return \Input 
     */
    public function setOnselect($onselect) {
        $this->onselect = $onselect;
    }
        
    /**
     * Monta o elemento Input
     * @return string 
     */
    private function mountInput() {
        $element = '<input ';
        
        if(!empty($this->type))
            $element .= 'type=\''.$this->type.'\' ';
                
        if(!empty($this->accept))
            $element .= 'accept=\''.$this->accept.'\' ';
        
        if(!empty($this->accesskey))
            $element .= 'accesskey=\''.$this->accesskey.'\' ';
        
        if(!empty($this->alt))
            $element .= 'alt=\''.$this->alt.'\' ';
                
        if(!empty($this->disabled))
            $element .= 'disabled=\''.$this->disabled.'\' ';
        
        if(!empty($this->maxlength))
            $element .= 'maxlength=\''.$this->maxlength.'\' ';
        
        if(!empty($this->name))
            $element .= 'name=\''.$this->name.'\' ';
        
        if($this->readonly)
            $element .= 'readonly=\'readonly\' ';
        
        if(!empty($this->size))
            $element .= 'size=\''.$this->size.'\' ';
                
        if(!empty($this->tabindex))
            $element .= 'tabindex=\''.$this->tabindex.'\' ';
        
        if(!empty($this->value))
            $element .= 'value=\''.$this->value.'\' ';
        
        $element .= parent::returnAttributesAsString();
        
        # Eventos Intrínsecos
        if(!empty($this->onblur))
            $element .= ' onblur=\''.$this->onblur.'\' ';
        
        if(!empty($this->onchange))
            $element .= ' onchange=\''.$this->onchange.'\' ';
        
        if(!empty($this->onfocus))
            $element .= ' onfocus=\''.$this->onfocus.'\' ';
        
        if(!empty($this->onselect))
            $element .= ' onselect=\''.$this->onselect.'\' ';
        
        $element .= '/>';
        
        return $element;
    }
    
    /**
     * Retorna o elemento html como uma string
     * @return string 
     */
    public function returnAsString() {
        $input = $this->mountInput(); 
        return $element;
    }
}