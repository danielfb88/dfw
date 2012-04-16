<?php
/**
 * DFW Framework PHP - Classe Singleton Button
 * 
 * Elemento Button XHTML
 * Data de Criação: 16 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @final
 * 
 */

require_once 'Element.class.php';

final class Button extends Element {
    protected $accesskey;
    protected $disabled;
    protected $name;
    protected $tabindex;
    protected $type;
    protected $value;
    protected $text;
    # Eventos Intrínsecos
    protected $onblur;
    protected $onfocus;
    /**
     * Instância do Singleton
     * @var Button
     */
    private static $instance;
    
    private function __construct() { }
    
    /**
     * Retorna instância única do singleton
     * @return Button
     */
    public static function getInstance() {
        if(empty(self::$instance))
            self::$instance = new Button();
        
        return self::$instance;
    }
    
    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @param type $accesskey
     * @return \Button 
     */
    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
        return $this;
    }

    /**
     * Desabilita o controle de modo que o usuário não poderá interagir com ele
     * @param type $disabled
     * @return \Button 
     */
    public function setDisabled($disabled) {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * Nome do controle que o identifica ao enviar o formulário
     * @param type $name
     * @return \Button 
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @param type $tabindex
     * @return \Button 
     */
    public function setTabindex($tabindex) {
        $this->tabindex = $tabindex;
        return $this;
    }

    /**
     * Tipo do botão 
     * (button:genérico; submit: para envio do formulário, submetendo os dados; ou reset: para restaurar o conteúdo original do formulário)
     * @param type $type
     * @return \Button 
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }
    
    /**
     * Valor previamente definido
     * @param type $type
     * @return \Button 
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }
    
    /**
     * Texto do Elemento
     * @param type $text
     * @return \Button 
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    /**
     * Ocorre quando o elemento perde o foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onblur
     * @return \Button 
     */
    public function setOnblur($onblur) {
        $this->onblur = $onblur;
        return $this;
    }

    /**
     * Ocorre quando o elemento entra em foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onfocus
     * @return \Button 
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
        $element = '<button ';
        
        if(!empty($this->accesskey))
            $element .= 'accesskey=\''.$this->accesskey.'\' ';
        
        if(!empty($this->disabled))
            $element .= 'disabled=\''.$this->disabled.'\' ';
        
        if(!empty($this->name))
            $element .= 'name=\''.$this->name.'\' ';
        
        if(!empty($this->tabindex))
            $element .= 'tabindex=\''.$this->tabindex.'\' ';
        
        if(!empty($this->type))
            $element .= 'type=\''.$this->type.'\' ';
        
        if(!empty($this->value))
            $element .= 'value=\''.$this->value.'\' ';
        
        # Eventos Intrínsecos
        if(!empty($this->onblur))
            $element .= 'onblur=\''.$this->onblur.'\' ';
        
        if(!empty($this->onfocus))
            $element .= 'onfocus=\''.$this->onfocus.'\' ';
        
        $element .= parent::show();
        
        $element .= '>';
        $element .= $this->text;
        $element .= '</button>';
        
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
        $this->disabled = null;
        $this->name = null;        
        $this->tabindex = null;
        $this->type = null;
        $this->value = null;
        $this->text = null;
        $this->onblur = null;
        $this->onfocus = null;
        parent::clear();
    }

}
?>