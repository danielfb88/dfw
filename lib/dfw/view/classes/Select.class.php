<?php

/**
 * Elemento Select XHTML
 * Data de Criação: 15 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'Element.class.php';
require_once 'Option.class.php';

class Select extends Element {

    protected $disabled;
    protected $multiple;
    protected $name;
    protected $size;
    protected $tabindex;
    protected $arrOptions;
    # Eventos Intrínsecos
    protected $onblur;
    protected $onchange;
    protected $onfocus;

    /**
     *
     * @param string $name
     * @param array $arrOptions
     * @param boolean $multiple 
     */
    public function __construct($nameId, $arrOptions = array(), $multiple = false) {
        $this->name = $nameId;
        $this->id = $nameId;
        $this->arrOptions = $arrOptions;
        $this->multiple = $multiple;
    }

    /**
     * Adiciona objeto Option
     * @param Option $option
     */
    public function addOption($option) {
        $this->arrOptions[] = $option;
    }

    /**
     * Insere array de Options
     * @param array $arrOptions
     */
    public function insertOptions(array $arrOptions) {
        if (!empty($arrOptions))
            $this->arrOptions = $arrOptions;
    }

    /**
     * Desabilita o controle de modo que o usuário não poderá interagir com ele
     * @param type $disabled
     */
    public function setDisabled($disabled) {
        $this->disabled = $disabled;
    }

    /**
     * Habilita a seleção com múltiplas opções
     * @param type $multiple
     */
    public function setMultiple($multiple) {
        $this->multiple = $multiple;
    }

    /**
     * Nome do controle que o identifica ao enviar o formulário
     * @param type $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Número de linhas em que as opções serão visíveis no controle
     * @param type $size
     */
    public function setSize($size) {
        $this->size = $size;
    }

    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @param type $tabindex
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
     * Monta o elemento
     * @return string 
     */
    private function mountElement() {
        $element = '<select ';

        if ($this->disabled)
            $element .= 'disabled=\'disabled\' ';

        if ($this->multiple)
            $element .= 'multiple=\'multiple\' ';

        if (!empty($this->name))
            $element .= 'name=\'' . $this->name . '\' ';

        if (!empty($this->size))
            $element .= 'size=\'' . $this->size . '\' ';

        if (!empty($this->tabindex))
            $element .= 'tabindex=\'' . $this->tabindex . '\' ';

        $element .= $this->returnAttributesAsString();

        # Eventos Intrínsecos
        if (!empty($this->onblur))
            $element .= 'onblur=\'' . $this->onblur . '\' ';

        if (!empty($this->onchange))
            $element .= 'onchange=\'' . $this->onchange . '\' ';

        if (!empty($this->onfocus))
            $element .= 'onfocus=\'' . $this->onfocus . '\' ';

        $element .= '>';

        // Inserindo options
        for ($i = 0; $i < count($this->arrOptions); $i++) {
            if ($this->arrOptions[$i] instanceof Option) {
                $option = $this->arrOptions[$i];
                $element .= $option->returnAsString();
            } else {
                throw $e = new Exception("A opção inserida não é um objeto Option.");
                $e->getTraceAsString();
            }
        }

        $element .= '</select>';

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
