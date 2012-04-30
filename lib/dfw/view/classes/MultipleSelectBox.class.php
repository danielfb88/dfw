<?php

/**
 * Elemento MultipleSelectBox
 * Data de Criação: 29 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'CompositeElement.class.php';
require_once 'Button.class.php';
require_once 'Select.class.php';
require_once 'Option.class.php';

class MultipleSelectBox extends CompositeElement {

    /**
     * Posiçoes do array element criadas no construtor:
     *      'btn_add' => Button - Botão adicionar
     *      'btn_remove' => Button - Botão remover
     *      'select1' => Select - Select carregado
     *      'select2' => Select - Select com valores selecionados
     * @var array 
     */
    private $element = array();

    /**
     *
     * @param type $nameId - O nome do Select que comportará as opções selecionadas
     * @param array $arrValues - Array com os valores. Deverá estar neste formato ex: array("1" => "Option1");
     */
    public function __construct($nameId, array $arrValues) {
        $this->element['btn_add'] = new Button($nameId . "_btn_add", "Adicionar", 'button');
        $this->element['btn_add']->setOnclick('addOption()');

        $this->element['btn_remove'] = new Button($nameId . "_btn_remove", "Remover", 'button');
        $this->element['btn_remove']->setOnclick('removeOption()');

        $this->element['select2'] = new Select($nameId . "[]", array(), true);

        $arrOptions = array();

        foreach ($arrValues as $value => $optionText) {
            $arrOptions[] = new Option($value, $optionText);
        }

        // Select das opçoes a serem escolhidas
        $this->element['select1'] = new Select($nameId . "_select1[]", $arrOptions, true);
    }

    public function getElements() {
        return $this->element;
    }

    /**
     * Adiciona atributos ao elemento
     * @param string $keyElement - 'btn_add', 'btn_remove', 'select1' ou 'select2'
     * @param string $attribute
     * @param string $value 
     */
    public function addAttribute($keyElement, $attribute, $value) {
        if (array_key_exists($keyElement, $this->element)) {
            $method = $this->parseAttributeToSetMethod($attribute);
            $this->executeMethod($this->element[$keyElement], $method, $value);
        } else {
            throw $e = new Exception("O elemento informado não existe no array de elementos do MultipleSelectBox");
            $e->getTraceAsString();
        }
    }

    private function javaScript() {
        $js = "<script type='text/javascript'>";
        $js .= "function addOption() {";
        $js .= "    var select1 = document.getElementById('" . $this->element['select1']->getId() . "');";
        $js .= "    var arrOptSelected = new Array();";
        $js .= "    for (var i=0; i<select1.options.length; i++) {";
        $js .= "        if (select1.options[i].selected) {";
        $js .= "            arrOptSelected.push(select1.options[ i ]);"; // inserindo no array o elemento option        
        $js .= "        }";
        $js .= "    }";
        $js .= "    var multiple = document.getElementById('multiple[]');";
        $js .= "    for(var i = 0; i < arrOptSelected.length; i++) {";
        $js .= "        multiple.add(arrOptSelected[i]);";
        $js .= "    }";
        $js .= "}";

        $js .= "function removeOption() {";
        $js .= "    var multiple = document.getElementById('multiple[]');";
        $js .= "    var arrOptSelected = new Array();";
        $js .= "    for (var i=0; i<multiple.options.length; i++) {";
        $js .= "        if (multiple.options[i].selected) {";
        $js .= "            arrOptSelected.push(multiple.options[ i ]);"; // inserindo no array o elemento option        
        $js .= "        }";
        $js .= "    }";
        $js .= "    var select1 = document.getElementById('" . $this->element['select1']->getId() . "');";
        $js .= "    for(var i = 0; i < arrOptSelected.length; i++) {";
        $js .= "        select1.add(arrOptSelected[i]);";
        $js .= "    }";
        $js .= "}";
        $js .= "</script>";

        return $js;
    }

    private function mountElement() {
        $element = '';

        $element .= $this->javaScript();

        $element .= "<table border='0' class='multipleSelectBox'>";

        $element .= "<tr>";
        $element .= "<td align='center'>";
        $element .= $this->element['select1']->returnAsString();
        $element .= "</td>";
        $element .= "<td align='center'>";
        $element .= $this->element['btn_add']->returnAsString();
        $element .= "<br/>";
        $element .= $this->element['btn_remove']->returnAsString();
        $element .= "</td>";
        $element .= "<td align='center'>";
        $element .= $this->element['select2']->returnAsString();
        $element .= "</td>";
        $element .= "</tr>";

        $element .= "</table>";

        return $element;
    }

    public function returnAsString() {
        return $this->mountElement();
    }

    public function show() {
        echo $this->mountElement();
    }

}