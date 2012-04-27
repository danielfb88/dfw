<?php

/**
 * DFW Framework PHP - Classe Input
 * 
 * Elemento Input XHTML
 * Data de Criação: 14 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'Element.class.php';

class Input extends Element {

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
     *
     * @param string $nameId Este parâmetro será usado para definir os atributos name e id do elemento.
     * @param string $value
     * @param string $type
     * @param int $maxlength 
     */
    public function __construct($nameId, $value, $type = 'text', $maxlength = null) {
        $this->name = $nameId;
        $this->id = $nameId;
        $this->value = $value;
        $this->type = $type;
        $this->maxlength = $maxlength;
    }

    /**
     * Tipo do controle
     * @param type $type
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
    }

    /**
     * Tipos de conteúdo (MIME) que o servidor deve aceitar, usado quando type="text"
     * @param type $accept
     */
    public function setAccept($accept) {
        $this->accept = $accept;
    }

    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @param type $accesskey
     */
    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
    }

    /**
     * Texto alternativo
     * @param type $alt
     */
    public function setAlt($alt) {
        $this->alt = $alt;
    }

    /**
     * Indica que um 'checkbox' ou um 'radio' estará previamente marcado
     * @param type $checked
     */
    public function setChecked($checked) {
        $this->checked = $checked;
    }

    /**
     * Desabilita o controle de modo que o usuário não poderá interagir com ele
     * @param type $disabled
     */
    public function setDisabled($disabled) {
        $this->disabled = $disabled;
    }

    /**
     * Número máximo de caracteres que o usuário pode inserir em um campo 'text' ou 'password’
     * @param type $maxlength
     */
    public function setMaxlength($maxlength) {
        $this->maxlength = $maxlength;
    }

    /**
     * Nome do controle que o identifica ao enviar o formulário
     * @param type $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Indica que o controle será utilizado somente para leitura, impedindo alterações em seus valores
     * @param type $readonly
     */
    public function setReadonly($readonly) {
        $this->readonly = $readonly;
    }

    /**
     * Tamanho inicial do controle 
     * (Pode ser expresso em pixels. Quando type="password" ou type="text" o tamanho indica o número de caracteres)
     * @param type $size
     */
    public function setSize($size) {
        $this->size = $size;
    }

    /**
     * Quando type="image", indica a localização da imagem
     * @param type $src
     */
    public function setSrc($src) {
        $this->src = $src;
    }

    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @param type $tabindex
     */
    public function setTabindex($tabindex) {
        $this->tabindex = $tabindex;
    }

    /**
     * Valor previamente definido
     * @param type $value
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * Ocorre quando o elemento perde o foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onblur
     */
    public function setOnblur($onblur) {
        $this->onblur = $onblur;
    }

    /**
     * Ocorre quando o conteúdo do controle é alterado
     * @param type $onchange
     */
    public function setOnchange($onchange) {
        $this->onchange = $onchange;
    }

    /**
     * Ocorre quando o elemento entra em foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onfocus
     */
    public function setOnfocus($onfocus) {
        $this->onfocus = $onfocus;
    }

    /**
     * Ocorre quando se seleciona algum texto dentro do controle
     * @param type $onselect
     */
    public function setOnselect($onselect) {
        $this->onselect = $onselect;
    }

    /**
     * Monta o elemento
     * @return string 
     */
    private function mountElement() {
        $element = '<input ';

        if (!empty($this->type))
            $element .= 'type=\'' . $this->type . '\' ';

        if (!empty($this->accept))
            $element .= 'accept=\'' . $this->accept . '\' ';

        if (!empty($this->accesskey))
            $element .= 'accesskey=\'' . $this->accesskey . '\' ';

        if (!empty($this->alt))
            $element .= 'alt=\'' . $this->alt . '\' ';

        if ($this->checked)
            $element .= 'checked=\'checked\' ';

        if (($this->type == 'radio' || $this->type == 'checkbox') && $this->disabled)
            $element .= 'disabled=\'disabled\' ';

        if (!empty($this->maxlength))
            $element .= 'maxlength=\'' . $this->maxlength . '\' ';

        if (!empty($this->name))
            $element .= 'name=\'' . $this->name . '\' ';

        if ($this->readonly)
            $element .= 'readonly=\'readonly\' ';

        if (!empty($this->size))
            $element .= 'size=\'' . $this->size . '\' ';

        if ($this->type == 'image' && !empty($this->src))
            $element .= 'src=\'' . $this->src . '\' ';

        if (!empty($this->tabindex))
            $element .= 'tabindex=\'' . $this->tabindex . '\' ';

        if (!empty($this->value))
            $element .= 'value=\'' . $this->value . '\' ';

        $element .= $this->returnAttributesAsString();

        # Eventos Intrínsecos
        if (!empty($this->onblur))
            $element .= ' onblur=\'' . $this->onblur . '\' ';

        if (!empty($this->onchange))
            $element .= ' onchange=\'' . $this->onchange . '\' ';

        if (!empty($this->onfocus))
            $element .= ' onfocus=\'' . $this->onfocus . '\' ';

        if (!empty($this->onselect))
            $element .= ' onselect=\'' . $this->onselect . '\' ';

        $element .= '/>';

        return $element;
    }

    /**
     * Exibe o elemento html na tela.
     */
    public function show() {
        $element = $this->mountElement();
        echo $element;
    }

    /**
     * Retorna o elemento html como uma string
     * @return string 
     */
    public function returnAsString() {
        $element = $this->mountElement();
        return $element;
    }

}
