<?php
/**
 * DFW Framework PHP - Classe Label
 * 
 * Elemento Label XHTML
 * Data de Criação: 15 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */

require_once 'Element.class.php';

class Label extends Element {
    protected $accesskey;
    protected $for;
    protected $text;
    # Eventos Intrínsecos
    protected $onblur;
    protected $onfocus;
    
    /**
     *
     * @param string $text
     * @param string $for 
     */
    public function __construct($id, $text, $for = null) {
        $this->id = $id;
        $this->text = $text;
        $this->for = $for;
   }
    
    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @param type $accesskey
     */
    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
    }

    /**
     * Associa o rótulo ao controle indicado (usando seu parâmetro id)
     * @param type $for
     */
    public function setFor($for) {
        $this->for = $for;
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
     */
    private function mountElement() {
        $element = '<label ';
        
        if(!empty($this->accesskey))
            $element .= 'accesskey=\''.$this->accesskey.'\' ';
        
        if(!empty($this->for))
            $element .= 'for=\''.$this->for.'\' ';        
        
        $element .= $this->returnAttributesAsString();
        
        # Eventos Intrínsecos
        if(!empty($this->onblur))
            $element .= 'onblur=\''.$this->onblur.'\' ';
        
        if(!empty($this->onfocus))
            $element .= 'onfocus=\''.$this->onfocus.'\' ';
        
        $element .= '>';
        $element .= $this->text;
        $element .= '</label>';
        
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