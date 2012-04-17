<?php
/**
 * DFW Framework PHP - Classe Singleton Label
 * 
 * Elemento Label XHTML
 * Data de Criação: 15 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @final
 * 
 */

require_once 'Element.class.php';

final class Label extends Element {
    protected $accesskey;
    protected $for;
    protected $text;
    # Eventos Intrínsecos
    protected $onblur;
    protected $onfocus;
    /**
     * Instância do Singleton
     * @var Label
     */
    private static $instance;
    
    private function __construct() { }
    
    /**
     * Retorna instância única do singleton
     * @return Label
     */
    public static function getInstance() {
        if(empty(self::$instance))
            self::$instance = new Label();
        
        return self::$instance;
    }
    
    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @param type $accesskey
     * @return \Label 
     */
    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
        return $this;
    }

    /**
     * Associa o rótulo ao controle indicado (usando seu parâmetro id)
     * @param type $for
     * @return \Label 
     */
    public function setFor($for) {
        $this->for = $for;
        return $this;
    }
    
    /**
     * Texto do Elemento
     * @param type $text
     * @return \Label 
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }
    
    /**
     * Ocorre quando o elemento perde o foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onblur
     * @return \Label 
     */
    public function setOnblur($onblur) {
        $this->onblur = $onblur;
        return $this;
    }
    
    /**
     * Ocorre quando o elemento entra em foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onfocus
     * @return \Label 
     */
    public function setOnfocus($onfocus) {
        $this->onfocus = $onfocus;
        return $this;
    }
    
    /**
     * Monta o elemento
     * @return string 
     */
    private function mountElement() {
        $element = '<label ';
        
        if(!empty($this->accesskey))
            $element .= 'accesskey=\''.$this->accesskey.'\' ';
        
        if(!empty($this->for))
            $element .= 'for=\''.$this->for.'\' ';        
        
        $element .= parent::show();
        
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
     * As variáveis do Singleton são sempre limpas ao final deste método. 
     */
    public function show() {
        $element = $this->mountElement();        
        // Limpando as configurações para uma nova chamada.
        $this->clear();        
        // exibindo o resultado
        echo $element;        
    }
    
    /**
     * Retorna o elemento html como uma string
     * @return string 
     */
    public function returnAsString() {
        $element = $this->mountElement(); 
        // Limpando as configurações para uma nova chamada.
        $this->clear();        
        // retornando o resultado
        return $element;
    }
    
    protected function clear() {
        $this->accesskey = null;
        $this->for = null;
        $this->text = null;
        $this->onblur = null;
        $this->onfocus = null;
        parent::clear();
    }

}
?>