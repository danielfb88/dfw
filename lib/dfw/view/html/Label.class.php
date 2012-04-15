<?php
require_once 'Element.class.php';
/**
 * ****************************************************************
 * Classe Label                                                    *
 *----------------------------------------------------------------*
 * Elemento Label XHTML
 * 
 * Data de Criação: 15 de Abril de 2012                           *
 *                                                                *
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>             *
 * @version     1.0                                               *
 *                                                                *
 * ****************************************************************
 */
final class Label extends Element { 
    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @var string 
     */
    protected $accesskey;
    /**
     * Associa o rótulo ao controle indicado (usando seu parâmetro id)
     * @var string
     */
    protected $for;
    /**
     * Mensagem que será exibida no Label
     * @var string 
     */
    protected $message;
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
    
    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
        return $this;
    }

    public function setFor($for) {
        $this->for = $for;
        return $this;
    }
    
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    public function show() {
        $element = '<label ';
        
        if(!empty($this->accesskey))
            $element .= 'accesskey=\''.$this->accesskey.'\' ';
        
        if(!empty($this->for))
            $element .= 'for=\''.$this->for.'\' ';
        
        $element .= parent::show();
        
        $element .= '>';
        $element .= $this->message;
        $element .= '</label>';
                
        echo $element;
        
        // Limpando as configurações para uma nova chamada.
        $this->clear();
    }
    
    /**
     * Limpa os valores dos atributos. 
     */
    protected function clear() {
        $this->accesskey = null;
        $this->for = null;
        $this->message = null;
        parent::clear();
    }

}
?>
