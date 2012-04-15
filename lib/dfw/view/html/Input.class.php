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
    /**
     * Tipo do controle
     * @var string 
     */
    protected $type;
    /**
     * Tipos de conteúdo (MIME) que o servidor deve aceitar, usado quando type="text"
     * @var string 
     */
    protected $accept;
    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @var string 
     */
    protected $accesskey;
    /**
     * Texto alternativo
     * @var string 
     */
    protected $alt;
    /**
     * Indica que um 'checkbox' ou um 'radio' estará previamente marcado
     * @var boolean
     */
    protected $checked;
    /**
     * Desabilita o controle de modo que o usuário não poderá interagir com ele
     * @var boolean 
     */
    protected $disabled;
    /**
     * Número máximo de caracteres que o usuário pode inserir em um campo 'text' ou 'password’
     * @var int 
     */
    protected $maxlength;
    /**
     * Nome do controle que o identifica ao enviar o formulário
     * @var string
     */
    protected $name;
    /**
     * Indica que o controle será utilizado somente para leitura, impedindo alterações em seus valores
     * @var boolean 
     */
    protected $readonly;
    /**
     * Tamanho inicial do controle 
     * (Pode ser expresso em pixels. Quando type="password" ou type="text" o tamanho indica o número de caracteres)
     * @var int 
     */
    protected $size;
    /**
     * Quando type="image", indica a localização da imagem
     * @var string
     */
    protected $src;
    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @var int
     */
    protected $tabindex;
    /**
     * Valor previamente definido
     * @var string
     */
    protected $value;
    /**
     * Ocorre quando o elemento perde o foco
     * @var string 
     */
    protected $onblur;
    /**
     * Ocorre quando o elemento ganha foco
     * @var string 
     */
    protected $onfocus;
    
    public function setType($type) {        
        switch ($type) {
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
                $this->type = $type;
                break;
            default:
                throw $e = new Exception('Tipo do Input inválido');
                $e->getTraceAsString();
        }
        
        return $this;
    }

    public function setAccept($accept) {
        $this->accept = $accept;
        return $this;
    }

    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
        return $this;
    }

    public function setAlt($alt) {
        $this->alt = $alt;
        return $this;
    }

    public function setChecked($checked) {
        $this->checked = $checked;
        return $this;
    }

    public function setDisabled($disabled) {
        $this->disabled = $disabled;
        return $this;
    }

    public function setMaxlength($maxlength) {
        $this->maxlength = $maxlength;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setReadonly($readonly) {
        $this->readonly = $readonly;
        return $this;
    }

    public function setSize($size) {
        $this->size = $size;
        return $this;
    }

    public function setSrc($src) {
        $this->src = $src;
        return $this;
    }

    public function setTabindex($tabindex) {
        $this->tabindex = $tabindex;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function setOnblur($onblur) {
        $this->onblur = $onblur;
        return $this;
    }

    public function setOnfocus($onfocus) {
        $this->onfocus = $onfocus;
        return $this;
    }
    
    public function show() {
        $input = '<input ';
        
        if(!empty($this->type))
            $input .= 'type=\''.$this->type.'\' ';
        
        
        if(!empty($this->accept))
            $input .= 'accept=\''.$this->accept.'\' ';
        
        if(!empty($this->accesskey))
            $input .= 'accesskey=\''.$this->accesskey.'\' ';
        
        if(!empty($this->alt))
            $input .= 'alt=\''.$this->alt.'\' ';
        
        if($this->checked)
            $input .= 'checked=\'checked\' ';
        
        if(($this->type == 'radio' || $this->type == 'checkbox') && $this->disabled)
            $input .= 'disabled=\'disabled\' ';
        
        if(!empty($this->maxlength))
            $input .= 'maxlength=\''.$this->maxlength.'\' ';
        
        if($this->readonly)
            $input .= 'readonly=\'readonly\' ';
        
        if(!empty($this->size))
            $input .= 'size=\''.$this->size.'\' ';
        
        if($this->type == 'image' && !empty($this->src))
            $input .= 'src=\''.$this->src.'\' ';
        
        if(!empty($this->tabindex))
            $input .= 'tabindex=\''.$this->tabindex.'\' ';
        
        if(!empty($this->value))
            $input .= 'value=\''.$this->value.'\' ';
        
        if(!empty($this->name))
            $input .= 'name=\''.$this->name.'\' ';
        
        $input .= parent::show();
        
        # Eventos
        if(!empty($this->onblur))
            $input .= ' onblur=\''.$this->onblur.'\' ';
        
        if(!empty($this->onfocus))
            $input .= ' onfocus=\''.$this->onfocus.'\' ';
        
        $input .= '/>';
                
        echo $input;
    }
}
?>
