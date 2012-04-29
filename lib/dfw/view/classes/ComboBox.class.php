<?php

/**
 * Elemento ComboBox
 * Data de Criação: 29 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'CompositeElement.class.php';
require_once 'Label.class.php';
require_once 'Select.class.php';
require_once 'Option.class.php';

class ComboBox extends CompositeElement {

    private $label;
    private $select;
    private $element = array();

    /**
     *
     * @param string $nameId - O nome do elemento principal. Caso haja um label, o seu nome será: lb_$nameId
     * @param array $arrValues - Array com os valores. Deverá estar neste formato ex: array("1" => "Option1");
     * @param string $defaultValue - Valor que será definido como checked. Inserir o valor da chave.
     * @param string $dummy - Manequim. A primeira opção.
     * @param string $text - Texto do label
     */
    public function __construct($nameId, array $arrValues, $defaultValue = null, $dummy = null, $text = null) {
        if (!empty($text)) {
            $this->label = new Label("lb_" . $nameId, $text, $nameId);
            $this->element[] = &$this->label;
        }

        $arrOptions = array();

        if ($dummy != null)
            $arrOptions[] = new Option('', $dummy, false);

        foreach ($arrValues as $value => $optionText) {
            $selected = ($value == $defaultValue);
            $arrOptions[] = new Option($value, $optionText, $selected);
        }

        $this->select = new Select($nameId, $arrOptions, false);
        $this->element[] = &$this->select;
    }

    public function getElements() {
        return $this->element;
    }

    /**
     * Adiciona atributos ao elemento
     * @param string $attribute
     * @param string $value 
     */
    public function addAttribute($attribute, $value) {
        $method = $this->parseAttributeToSetMethod($attribute);
        $this->executeMethod($this->select, $method, $value);
    }

    private function mountElement() {
        $element = '';
        if ($this->label != null)
            $element .= $this->label->returnAsString();

        $element .= $this->select->returnAsString();

        return $element;
    }

    public function returnAsString() {
        return $this->mountElement();
    }

    public function show() {
        echo $this->mountElement();
    }

}