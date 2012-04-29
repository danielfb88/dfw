<?php

/**
 * Elemento TextField
 * Data de Criação: 28 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'CompositeElement.class.php';
require_once 'Label.class.php';
require_once 'Input.class.php';

class TextField extends CompositeElement {

    private $label;
    private $input;
    private $element = array();

    /**
     *
     * @param string $nameId
     * @param string $text
     * @param string $value
     * @param int $maxlength 
     */
    public function __construct($nameId, $text = null, $value = null, $maxlength = null) {
        if (!empty($text)) {
            $this->label = new Label("lb_" . $nameId, $text, $nameId);
            $this->element[] = $this->label;
        }

        $this->input = new Input($nameId, $value, 'text', $maxlength);
        $this->element[] = $this->input;
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
        $attribute[0] = strtoupper($attribute[0]); // transformando a primeira letra em maiúscula
        $method = "set" . $attribute;

        $this->executeMethod($this->input, $method, $value);
    }

    private function mountElement() {
        $element = '';
        if ($this->label != null)
            $element .= $this->label->returnAsString();

        $element .= $this->input->returnAsString();

        return $element;
    }

    public function returnAsString() {
        return $this->mountElement();
    }

    public function show() {
        echo $this->mountElement();
    }

}