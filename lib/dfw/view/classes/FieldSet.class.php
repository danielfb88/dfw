<?php
/**
 * DFW Framework PHP - Classe Singleton FieldSet
 * 
 * Elemento FieldSet XHTML
 * Data de Criação: 16 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @final
 * 
 */

require_once 'Element.class.php';

final class FieldSet extends Element {
    protected $dir;
    protected $lang;
    protected $legend;
    protected $content;
    /**
     * Instância do Singleton
     * @var FieldSet
     */
    private static $instance;
    
    private function __construct() { }
    
    /**
     * Retorna instância única do singleton
     * @return FieldSet
     */
    public static function getInstance() {
        if(empty(self::$instance))
            self::$instance = new FieldSet();
        
        return self::$instance;
    }
    
    /**
     * Direção de leitura do texto, sendo "ltr": esquerda para a direita; e "rtl": direita para esquerda 
     * (utilizado no Módulo Texto Bidirecional)
     * @param string $dir
     * @return \FieldSet 
     */
    public function setDir($dir) {
        switch($dir) {
            case "ltr":
            case "rtl":
                $this->dir = $dir;
                return $this;
                break;
            default:
                throw $e = new Exception("Atributo inválido para o parâmetro html dir='".$dir."'");
                $e->getTraceAsString();
        }
    }

    /**
     * Idioma utilizado no conteúdo do elemento
     * @param type $lang
     * @return \FieldSet 
     */
    public function setLang($lang) {
        $this->lang = $lang;
        return $this;
    }
    
    public function setLegend($legend) {
        $this->legend = $legend;
        return $this;
    }
    
    /**
     * Insere Conteúdo ao FieldSet
     * @param string $text
     * @return \FieldSet 
     */
    public function setContent($content) {
        $this->content = $content;
        return $this;
    }
    
    /**
     * Adiciona Conteúdo ao FieldSet
     * @param type $content
     * @return \FieldSet 
     */
    public function appendContent($content) {
        $this->content .= $content;
        return $this;
    }
    
    /**
     * Monta o elemento
     * @return string 
     */
    private function mountElement() {
        $element = '<fieldset ';
        
        if(!empty($this->dir))
            $element .= 'dir=\''.$this->dir.'\' ';
        
        if(!empty($this->lang))
            $element .= 'lang=\''.$this->lang.'\' ';
        
        $element .= parent::show();
        
        $element .= '>';        
        if(!empty($this->legend))
            $element .= '<legend>'.$this->legend.'</legend>';
        
        $element .= $this->content;
        $element .= '</fieldset>';
        
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
        $this->dir = null;
        $this->lang = null;
        $this->legend = null;
        $this->content = null;        
        parent::clear();
    }

}
?>