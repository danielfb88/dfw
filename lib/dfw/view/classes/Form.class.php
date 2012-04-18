<?php
/**
 * DFW Framework PHP - Classe Singleton Form
 * 
 * Elemento Form XHTML
 * Data de Criação: 16 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @final
 * 
 */

require_once 'Element.class.php';

final class Form extends Element {
    protected $accept;
    protected $accept_charset;
    protected $action;
    protected $method;
    protected $enctype;
    protected $content;
    # Eventos Intrínsecos
    protected $onreset;
    protected $onsubmit;
    
    /**
     * Instância do Singleton
     * @var Form
     */
    private static $instance;
    
    private function __construct() { }
    
    /**
     * Retorna instância única do singleton
     * @return Form
     */
    public static function getInstance() {
        if(empty(self::$instance))
            self::$instance = new Form();
        
        return self::$instance;
    }
    
    /**
     * Tipos de conteúdo (MIME) que o servidor deve aceitar
     * @param type $accept
     * @return \Form 
     */
    public function setAccept($accept) {
        $this->accept = $accept;
        return $this;
    }

    /**
     * Codificação de caracteres que será enviada e que o servidor deve suportar
     * @param type $accept_charset
     * @return \Form 
     */
    public function setAccept_charset($accept_charset) {
        $this->accept_charset = $accept_charset;
        return $this;
    }

    /**
     * Endereço da aplicação para onde o formulário e seus dados serão enviados
     * @param type $action
     * @return \Form 
     */
    public function setAction($action) {
        $this->action = $action;
        return $this;
    }

    /**
     * Método utilizado para envio do formulário
     * @param type $method
     * @return \Form 
     */
    public function setMethod($method = "post") {
        switch($method) {
            case "post":
            case "get":
                $this->method = $method;
                return $this;
                break;
            
            default:
                throw $e = new Exception("O atributo method='".$method."' não existe");
        }
    
        
    }

    /**
     * Tipo de codificação dos dados do formulário
     * @param type $enctype
     * @return \Form 
     */
    public function setEnctype($enctype) {
        $this->enctype = $enctype;
        return $this;
    }
    
    /**
     * Ocorre quando um form é reiniciado
     * @param type $onreset
     * @return \Form 
     */
    public function setOnreset($onreset) {
        $this->onreset = $onreset;
        return $this;
    }

    /**
     * Ocorre quando um form é enviado
     * @param type $onsubmit
     * @return \Form 
     */
    public function setOnsubmit($onsubmit) {
        $this->onsubmit = $onsubmit;
        return $this;
    }
    
    /**
     * TODO: Deleter
     * Insere Conteúdo ao FieldSet
     * @param string $text
     * @return \Form 
     */
    public function setContent($content) {
        $this->content = $content;
        return $this;
    }
    
    /**
     * TODO: Deletar
     * Adiciona Conteúdo ao FieldSet
     * @param type $content
     * @return \Form 
     */
    public function appendContent($content) {
        $this->content .= $content;
        return $this;
    }
    
    public function addField($field) {
        
    }
    
    public function addFields(array $fields) {
        // o form vai gerar uma tabela e organizar os fields pela ordem que estao definidos
    }
    
    /**
     * Monta o elemento
     * @return string 
     */
    private function mountElement() {
        $element = '<form ';
        
        if(!empty($this->accept))
            $element .= 'accept=\''.$this->accept.'\' ';
        
        if(!empty($this->accept_charset))
            $element .= 'accept_charset=\''.$this->accept_charset.'\' ';
        
        if(!empty($this->action))
            $element .= 'action=\''.$this->action.'\' ';
        
        if(!empty($this->enctype))
            $element .= 'enctype=\''.$this->enctype.'\' ';
        
        if(!empty($this->method))
            $element .= 'method=\''.$this->method.'\' ';
                
        $element .= parent::show();
        $element .= '>';      
        
        # Eventos Intrínsecos
        if(!empty($this->onreset))
            $element .= 'onreset=\''.$this->onreset.'\' ';
        
        if(!empty($this->onsubmit))
            $element .= 'onsubmit=\''.$this->onsubmit.'\' ';
        
        $element .= $this->content;
        $element .= '</form>';
        
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
        $this->accept = null;
        $this->accept_charset = null;
        $this->action = null;
        $this->enctype = null;
        $this->method = null;
        $this->content = null;   
        $this->onreset = null;
        $this->onsubmit = null;
        parent::clear();
    }

}
?>