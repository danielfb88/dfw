<?php

/**
 * Elemento Img XHTML
 * Data de Criação: 14 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'Element.class.php';

class Img extends Element {

    protected $alt;
    protected $height;
    protected $src;
    protected $width;

    /**
     *
     * @param string $src
     * @param string $alt
     * @param string $height
     * @param string $width 
     */
    function __construct($id, $src, $alt = null, $height = null, $width = null) {
        $this->id = $id;
        $this->alt = $alt;
        $this->height = $height;
        $this->src = $src;
        $this->width = $width;
    }

    /**
     * Altura de exibição da imagem. 
     * Utilizar px|%. 
     * Ex: 100px | 100%
     * @param string $height 
     */
    public function setHeight($height) {
        $this->height = $height;
    }

    /**
     * Localização da imagem
     * @param type $src 
     */
    public function setSrc($src) {
        $this->src = $src;
    }

    /**
     * Largura de exibição da imagem
     * Utilizar px|%. 
     * Ex: 100px | 100%
     * @param type $width 
     */
    public function setWidth($width) {
        $this->width = $width;
    }

    /**
     * Texto alternativo
     * @param type $alt
     */
    public function setAlt($alt) {
        $this->alt = $alt;
    }

    /**
     * Monta o elemento
     * @return string 
     */
    private function mountElement() {
        $element = '<img ';

        if (!empty($this->src))
            $element .= 'src=\'' . $this->src . '\' ';
        
        if (!empty($this->height))
            $element .= 'height=\'' . $this->height . '\' ';
        
        if (!empty($this->width))
            $element .= 'width=\'' . $this->width . '\' ';
        
        if (!empty($this->alt))
            $element .= 'alt=\'' . $this->alt . '\' ';

        $element .= $this->returnAttributesAsString();

        $element .= '/>';

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
