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

    /**
     * Posiçoes do array element criadas no construtor:
     *      'label' => Label
     *      'input' => Input
     * @var array 
     */
    private $element = array();

    /**
     *
     * @param string $nameId - O nome do elemento principal. Caso haja um label, o seu nome será: lb_$nameId
     * @param string $text
     * @param string $value
     * @param int $maxlength 
     */
    public function __construct($nameId, $text = null, $value = null, $maxlength = null) {
        if (!empty($text)) {
            $this->element['label'] = new Label("lb_" . $nameId, $text, $nameId);
        }

        $this->element['input'] = new Input($nameId, $value, 'text', $maxlength);
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
        $this->executeMethod($this->element['input'], $method, $value);
    }

    private function mountElement() {
        $element = '';
        if ($this->element['label'] != null)
            $element .= $this->element['label']->returnAsString();

        $element .= $this->element['input']->returnAsString();

        return $element;
    }

    public function returnAsString() {
        return $this->mountElement();
    }

    public function show() {
        echo $this->mountElement();
    }

}