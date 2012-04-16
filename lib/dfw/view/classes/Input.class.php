<?php
/**
 * DFW Framework PHP - Classe Singleton Input
 * 
 * Elemento Input XHTML
 * Data de Criação: 14 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @final
 * 
 */

require_once 'Element.class.php';

final class Input extends Element {
    protected $type;
    protected $accept;
    protected $accesskey;
    protected $alt;
    protected $checked;
    protected $disabled;
    protected $maxlength;
    protected $name;
    protected $readonly;
    protected $size;
    protected $src;
    protected $tabindex;
    protected $value;
    # Eventos Intrínsecos
    protected $onblur;
    protected $onchange;
    protected $onfocus;
    protected $onselect;
    /**
     * Instância do Singleton
     * @var Label
     */
    private static $instance;
    
    private function __construct() { }
    
    /**
     * Retorna instância única do singleton
     * @return Input
     */
    public static function getInstance() {
        if(empty(self::$instance))
            self::$instance = new Input();
        
        return self::$instance;
    }
    
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

    /**
     * Tipos de conteúdo (MIME) que o servidor deve aceitar, usado quando type="text"
     * @param type $accept
     * @return \Input 
     */
    public function setAccept($accept) {
        $this->accept = $accept;
        return $this;
    }

    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @param type $accesskey
     * @return \Input 
     */
    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
        return $this;
    }

    /**
     * Texto alternativo
     * @param type $alt
     * @return \Input 
     */
    public function setAlt($alt) {
        $this->alt = $alt;
        return $this;
    }

    /**
     * Indica que um 'checkbox' ou um 'radio' estará previamente marcado
     * @param type $checked
     * @return \Input 
     */
    public function setChecked($checked) {
        $this->checked = $checked;
        return $this;
    }

    /**
     * Desabilita o controle de modo que o usuário não poderá interagir com ele
     * @param type $disabled
     * @return \Input 
     */
    public function setDisabled($disabled) {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * Número máximo de caracteres que o usuário pode inserir em um campo 'text' ou 'password’
     * @param type $maxlength
     * @return \Input 
     */
    public function setMaxlength($maxlength) {
        $this->maxlength = $maxlength;
        return $this;
    }   
    
    /**
     * Nome do controle que o identifica ao enviar o formulário
     * @param type $name
     * @return \Input 
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Indica que o controle será utilizado somente para leitura, impedindo alterações em seus valores
     * @param type $readonly
     * @return \Input 
     */
    public function setReadonly($readonly) {
        $this->readonly = $readonly;
        return $this;
    }

    /**
     * Tamanho inicial do controle 
     * (Pode ser expresso em pixels. Quando type="password" ou type="text" o tamanho indica o número de caracteres)
     * @param type $size
     * @return \Input 
     */
    public function setSize($size) {
        $this->size = $size;
        return $this;
    }

    /**
     * Quando type="image", indica a localização da imagem
     * @param type $src
     * @return \Input 
     */
    public function setSrc($src) {
        $this->src = $src;
        return $this;
    }

    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @param type $tabindex
     * @return \Input 
     */
    public function setTabindex($tabindex) {
        $this->tabindex = $tabindex;
        return $this;
    }

    /**
     * Valor previamente definido
     * @param type $value
     * @return \Input 
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    /**
     * Ocorre quando o elemento perde o foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onblur
     * @return \Input 
     */
    public function setOnblur($onblur) {
        $this->onblur = $onblur;
        return $this;
    }

    /**
     * Ocorre quando o conteúdo do controle é alterado
     * @param type $onchange
     * @return \Input 
     */
    public function setOnchange($onchange) {
        $this->onchange = $onchange;
        return $this;
    }

    /**
     * Ocorre quando o elemento entra em foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onfocus
     * @return \Input 
     */
    public function setOnfocus($onfocus) {
        $this->onfocus = $onfocus;
        return $this;
    }

    /**
     * Ocorre quando se seleciona algum texto dentro do controle
     * @param type $onselect
     * @return \Input 
     */
    public function setOnselect($onselect) {
        $this->onselect = $onselect;
        return $this;
    }
    
    /**
     * Exibe o elemento html na tela.
     * As variáveis do Singleton são sempre limpas ao final deste método. 
     */
    public function show() {
        $element = '<input ';
        
        if(!empty($this->type))
            $element .= 'type=\''.$this->type.'\' ';
                
        if(!empty($this->accept))
            $element .= 'accept=\''.$this->accept.'\' ';
        
        if(!empty($this->accesskey))
            $element .= 'accesskey=\''.$this->accesskey.'\' ';
        
        if(!empty($this->alt))
            $element .= 'alt=\''.$this->alt.'\' ';
        
        if($this->checked)
            $element .= 'checked=\'checked\' ';
        
        if(($this->type == 'radio' || $this->type == 'checkbox') && $this->disabled)
            $element .= 'disabled=\'disabled\' ';
        
        if(!empty($this->maxlength))
            $element .= 'maxlength=\''.$this->maxlength.'\' ';
        
        if(!empty($this->name))
            $element .= 'name=\''.$this->name.'\' ';
        
        if($this->readonly)
            $element .= 'readonly=\'readonly\' ';
        
        if(!empty($this->size))
            $element .= 'size=\''.$this->size.'\' ';
        
        if($this->type == 'image' && !empty($this->src))
            $element .= 'src=\''.$this->src.'\' ';
        
        if(!empty($this->tabindex))
            $element .= 'tabindex=\''.$this->tabindex.'\' ';
        
        if(!empty($this->value))
            $element .= 'value=\''.$this->value.'\' ';
        
        $element .= parent::show();
        
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
                
        
        // Limpando as configurações para uma nova chamada.
        $this->clear();
        
        // exibindo o resultado
        echo $element;        
    }
    
    protected function clear() {
        $this->accept = null;
        $this->accesskey = null;
        $this->alt = null;
        $this->checked = null;
        $this->disabled = null;
        $this->maxlength = null;
        $this->readonly = null;
        $this->size = null;
        $this->src = null;
        $this->tabindex = null;
        $this->type = null;
        $this->value = null;        
        $this->onblur = null;
        $this->onchange = null;
        $this->onfocus = null;
        $this->onselect = null;
        parent::clear();
    }
}
?>
