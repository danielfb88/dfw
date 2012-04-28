<?php

/**
 * Elemento TextArea XHTML
 * Data de Criação: 14 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'Element.class.php';

class TextArea extends Element {

    protected $accesskey;
    protected $cols;
    protected $disabled;
    protected $name;
    protected $readonly;
    protected $rows;
    protected $tabindex;
    protected $text;
    # Eventos Intrínsecos
    protected $onblur;
    protected $onchange;
    protected $onfocus;
    protected $onselect;

    /**
     * 
     * @param string $nameId
     * @param string $text
     * @param string $readonly 
     */
    function __construct($nameId, $text, $readonly = false) {
        $this->name = $nameId;
        $this->id = $nameId;
        $this->text = $text;
        $this->readonly = $readonly;
    }

    /**
     * Número de colunas para a área de inserção de texto (uma coluna corresponde ao tamanho médio de um caractere)
     * @param int $cols 
     */
    public function setCols($cols) {
        $this->cols = $cols;
    }

    /**
     * Número de linhas para a área de inserção de texto
     * @param int $rows 
     */
    public function setRows($rows) {
        $this->rows = $rows;
    }

    /**
     * Texto do elemento
     * @param string $text 
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @param char $accesskey
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
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Indica que o controle será utilizado somente para leitura, impedindo alterações em seus valores
     * @param boolean $readonly
     */
    public function setReadonly($readonly) {
        $this->readonly = $readonly;
    }

    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @param int $tabindex
     */
    public function setTabindex($tabindex) {
        $this->tabindex = $tabindex;
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
        $element = '<textarea ';

        if (!empty($this->name))
            $element .= 'name=\'' . $this->name . '\' ';

        if (!empty($this->accesskey))
            $element .= 'accesskey=\'' . $this->accesskey . '\' ';

        if (!empty($this->cols))
            $element .= 'cols=\'' . $this->cols . '\' ';

        if (!empty($this->disabled))
            $element .= 'disabled=\'' . $this->disabled . '\' ';

        if (!empty($this->readonly))
            $element .= 'readonly=\'' . $this->readonly . '\' ';

        if (!empty($this->rows))
            $element .= 'rows=\'' . $this->rows . '\' ';

        if (!empty($this->tabindex))
            $element .= 'tabindex=\'' . $this->tabindex . '\' ';

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

        $element .= '>';
        $element .= $this->text;
        $element .= '</textarea>';

        return $element;
    }

    /**
     * Exibe o elemento html na tela.
     */
    public function show() {
        echo $this->mountElement();
    }

    /**
     * Retorna o elemento html como uma string
     * @return string 
     */
    public function returnAsString() {
        return $this->mountElement();
    }

}
