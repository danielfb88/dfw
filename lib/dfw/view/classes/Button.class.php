<?php

/**
 * Elemento Button XHTML
 * Data de Criação: 16 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'Element.class.php';

final class Button extends Element {

    protected $accesskey;
    protected $disabled;
    protected $name;
    protected $tabindex;
    protected $type;
    protected $value;
    protected $text;
    # Eventos Intrínsecos
    protected $onblur;
    protected $onfocus;

    /**
     *
     * @param string $nameId
     * @param string $text
     * @param string $type
     * @param string $value 
     */
    public function __construct($nameId, $text, $type = 'button', $value = null) {
        $this->name = $nameId;
        $this->id = $nameId;
        $this->text = $text;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @param type $accesskey
     */
    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
    }

    /**
     * Desabilita o controle de modo que o usuário não poderá interagir com ele
     * @param boolean $disabled
     */
    public function setDisabled($disabled) {
        $this->disabled = $disabled;
    }

    /**
     * Nome do controle que o identifica ao enviar o formulário
     * @param type $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @param type $tabindex
     */
    public function setTabindex($tabindex) {
        $this->tabindex = $tabindex;
    }

    /**
     * Tipo do botão 
     * button:genérico; 
     * submit: para envio do formulário, submetendo os dados; 
     * reset: para restaurar o conteúdo original do formulário
     * @param type $type
     */
    public function setType($type) {
        switch ($type) {
            case 'button':
            case 'submit':
            case 'reset':
                $this->type = $type;
                break;
            default:
                throw $e = new Exception('Tipo do Button inválido');
                $e->getTraceAsString();
        }
    }

    /**
     * Valor previamente definido
     * @param type $type
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * Texto do Elemento
     * @param type $text
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * Ocorre quando o elemento perde o foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onblur
     */
    public function setOnblur($onblur) {
        $this->onblur = $onblur;
    }

    /**
     * Ocorre quando o elemento entra em foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onfocus
     */
    public function setOnfocus($onfocus) {
        $this->onfocus = $onfocus;
    }

    /**
     * Monta o elemento
     * @return string 
     */
    private function mountElement() {
        $element = '<button ';

        if (!empty($this->accesskey))
            $element .= 'accesskey=\'' . $this->accesskey . '\' ';

        if ($this->disabled)
            $element .= 'disabled=\'disabled\' ';

        if (!empty($this->name))
            $element .= 'name=\'' . $this->name . '\' ';

        if (!empty($this->tabindex))
            $element .= 'tabindex=\'' . $this->tabindex . '\' ';

        if (!empty($this->type))
            $element .= 'type=\'' . $this->type . '\' ';

        if (!empty($this->value))
            $element .= 'value=\'' . $this->value . '\' ';

        $element .= $this->returnAttributesAsString();

        # Eventos Intrínsecos
        if (!empty($this->onblur))
            $element .= 'onblur=\'' . $this->onblur . '\' ';

        if (!empty($this->onfocus))
            $element .= 'onfocus=\'' . $this->onfocus . '\' ';

        $element .= '>';
        $element .= $this->text;
        $element .= '</button>';

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