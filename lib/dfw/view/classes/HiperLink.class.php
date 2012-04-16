<?php
/**
 * DFW Framework PHP - Classe Singleton HiperText
 * 
 * Elemento HiperText XHTML
 * Data de Criação: 16 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @final
 * 
 */

require_once 'Element.class.php';

final class HiperLink extends Element {
    protected $accesskey;
    protected $charset;
    protected $href;
    protected $hreflang;
    protected $rel;
    protected $rev;
    protected $tabindex;
    protected $type;
    protected $target;
    protected $text;
    # Eventos Intrínsecos
    protected $onblur;
    protected $onfocus;
    /**
     * Instância do Singleton
     * @var HiperLink
     */
    private static $instance;
    
    private function __construct() { }
    
    /**
     * Retorna instância única do singleton
     * @return HiperLink
     */
    public static function getInstance() {
        if(empty(self::$instance))
            self::$instance = new HiperLink();
        
        return self::$instance;
    }
    
    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @param type $accesskey
     * @return \HHiperLink
     */
    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
        return $this;
    }
    
    /**
     * Codificação de caracteres utilizada no documento hiperlinkado
     * @param type $charset
     * @return \HHiperLink
     */
    public function setCharset($charset) {
        $this->charset = $charset;
        return $this;
    }

    /**
     * Localização de destino do hiperlink
     * @param type $href
     * @return \HHiperLink
     */
    public function setHref($href) {
        $this->href = $href;
        return $this;
    }

    /**
     * Idioma do documento hiperlinkado
     * @param type $hreflang
     * @return \HHiperLink
     */
    public function setHreflang($hreflang) {
        $this->hreflang = $hreflang;
        return $this;
    }

    /**
     * Tipos de relacionamento entre o documento corrente e o documento hiperlinkado
     * @param type $rel
     * @return \HHiperLink
     */
    public function setRel($rel) {
        $this->rel = $rel;
        return $this;
    }

    /**
     * Tipos de relacionamento entre o documento hiperlinkado e o documento corrente (link reverso)
     * @param type $rev
     * @return \HHiperLink
     */
    public function setRev($rev) {
        $this->rev = $rev;
        return $this;
    }

    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @param type $tabindex
     * @return \HHiperLink
     */
    public function setTabindex($tabindex) {
        $this->tabindex = $tabindex;
        return $this;
    }
    
    /**
     * Tipo do conteúdo que será acessado no documento hiperlinkado
     * @param type $type
     * @return \HHiperLink
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }
    
    /**
     * Alvo no qual o documento será aberto
     * Tipos: \n
     *      _blank: Opens the linked document in a new window or tab.
     *      _self: Opens the linked document in the same frame as it was clicked (this is default).
     *      _parent: Opens the linked document in the parent frame.
     *      _top: Opens the linked document in the full body of the window.
     *      framename: Opens the linked document in a named frame.
     * 
     * @param type $target
     * @return \HiperLink 
     */
    public function setTarget($target) {
        $this->target = $target;
        return $this;
    }
    
    /**
     * Texto do Option
     * @param type $text
     * @return \HHiperLink
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    /**
     * Ocorre quando o elemento perde o foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onblur
     * @return \HHiperLink
     */
    public function setOnblur($onblur) {
        $this->onblur = $onblur;
        return $this;
    }

    /**
     * Ocorre quando o elemento entra em foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onfocus
     * @return \HHiperLink
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
        $element = '<a ';
        
        if(!empty($this->accesskey))
            $element .= 'accesskey=\''.$this->accesskey.'\' ';
        
        if(!empty($this->charset))
            $element .= 'charset=\''.$this->charset.'\' ';
        
        if(!empty($this->href))
            $element .= 'href=\''.$this->href.'\' ';
        
        if(!empty($this->hreflang))
            $element .= 'hreflang=\''.$this->hreflang.'\' ';
        
        if(!empty($this->rel))
            $element .= 'rel=\''.$this->rel.'\' ';
        
        if(!empty($this->rev))
            $element .= 'rev=\''.$this->rev.'\' ';
        
        if(!empty($this->tabindex))
            $element .= 'tabindex=\''.$this->tabindex.'\' ';
                
        if(!empty($this->type))
            $element .= 'type=\''.$this->type.'\' ';
        
        if(!empty($this->target)) {
            $element .= 'target=\''.$this->target.'\' ';
        }
                
        # Eventos Intrínsecos
        if(!empty($this->onblur))
            $element .= 'onblur=\''.$this->onblur.'\' ';
        
        if(!empty($this->onfocus))
            $element .= 'onfocus=\''.$this->onfocus.'\' ';
        
        $element .= parent::show();
        
        $element .= '>';
        $element .= $this->text;
        $element .= '</a>';
        
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
        $this->charset = null;
        $this->href = null;
        $this->hreflang = null;        
        $this->rel = null;
        $this->rev = null;
        $this->tabindex = null;
        $this->target = null;
        $this->text = null;
        $this->type = null;
        $this->onblur = null;
        $this->onfocus = null;
        parent::clear();
    }

}
?>