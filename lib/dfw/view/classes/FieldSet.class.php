<?php

/**
 * Elemento FieldSet XHTML
 * Data de Criação: 16 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'Container.class.php';

class FieldSet extends Container {

    protected $dir;
    protected $lang;
    protected $legend;

    public function __construct($id, $legend = null) {
        $this->id = $id;
        $this->legend = $legend;
    }

    /**
     * Direção de leitura do texto, sendo "ltr": esquerda para a direita; e "rtl": direita para esquerda 
     * (utilizado no Módulo Texto Bidirecional)
     * @param string $dir
     */
    public function setDir($dir) {
        switch ($dir) {
            case "ltr":
            case "rtl":
                $this->dir = $dir;
                return $this;
                break;
            default:
                throw $e = new Exception("Atributo inválido para o parâmetro html dir='" . $dir . "'");
                $e->getTraceAsString();
        }
    }

    /**
     * Idioma utilizado no conteúdo do elemento
     * @param type $lang
     */
    public function setLang($lang) {
        $this->lang = $lang;
    }

    public function setLegend($legend) {
        $this->legend = $legend;
    }

    /**
     * Insere fields ao FieldSet
     * @param array $fields
     */
    public function setFields(array $fields) {
        $this->fields = $fields;
    }

    /**
     * Adiciona field ao FieldSet
     * @param array|object $field 
     */
    public function addField($field) {
        $this->fields[] = $field;
    }

    /**
     * Monta o elemento
     * @return string
     */
    private function mountElement() {
        $element = '<fieldset ';

        if (!empty($this->dir))
            $element .= 'dir=\'' . $this->dir . '\' ';

        if (!empty($this->lang))
            $element .= 'lang=\'' . $this->lang . '\' ';

        $element .= $this->returnAttributesAsString();

        $element .= '>';
        if (!empty($this->legend))
            $element .= '<legend>' . $this->legend . '</legend>';

        $element .= $this->mountTable($this->fields, "table_fieldset");

        $element .= '</fieldset>';

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