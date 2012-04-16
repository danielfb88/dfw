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
    protected $message;
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
     * Mensagem do Label
     * @param type $message
     * @return \Label 
     */
    public function setMessage($message) {
        $this->message = $message;
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

    public function show() {
        $element = '<label ';
        
        if(!empty($this->accesskey))
            $element .= 'accesskey=\''.$this->accesskey.'\' ';
        
        if(!empty($this->for))
            $element .= 'for=\''.$this->for.'\' ';
        
        # Eventos Intrínsecos
        if(!empty($this->onblur))
            $element .= 'onblur=\''.$this->onblur.'\' ';
        
        if(!empty($this->onfocus))
            $element .= 'onfocus=\''.$this->onfocus.'\' ';
        
        $element .= parent::show();
        
        $element .= '>';
        $element .= $this->message;
        $element .= '</label>';
                
        echo $element;
        
        // Limpando as configurações para uma nova chamada.
        $this->clear();
    }
    
    protected function clear() {
        $this->accesskey = null;
        $this->for = null;
        $this->message = null;
        $this->onblur = null;
        $this->onfocus = null;
        parent::clear();
    }

}
?>
