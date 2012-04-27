<?php
/**
 * DFW Framework PHP - Classe HiperLink
 * 
 * Elemento HiperLink XHTML
 * Data de Criação: 16 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */

require_once 'Element.class.php';

class HiperLink extends Element {
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
     *
     * @param string $id
     * @param string $text
     * @param string $href 
     */
    public function __construct($id, $text, $href) {
        $this->id = $id;
        $this->text = $text;
        $this->href = $href;
    }
    
    /**
     * Caractere correspondente à tecla de atalho para acesso ao elemento
     * @param type $accesskey
     */
    public function setAccesskey($accesskey) {
        $this->accesskey = $accesskey;
    }
    
    /**
     * Codificação de caracteres utilizada no documento hiperlinkado
     * @param type $charset
     */
    public function setCharset($charset) {
        $this->charset = $charset;
    }

    /**
     * Localização de destino do hiperlink
     * @param type $href
     */
    public function setHref($href) {
        $this->href = $href;
    }

    /**
     * Idioma do documento hiperlinkado
     * @param type $hreflang
     */
    public function setHreflang($hreflang) {
        $this->hreflang = $hreflang;
    }

    /**
     * Tipos de relacionamento entre o documento corrente e o documento hiperlinkado
     * @param type $rel
     */
    public function setRel($rel) {
        $this->rel = $rel;
    }

    /**
     * Tipos de relacionamento entre o documento hiperlinkado e o documento corrente (link reverso)
     * @param type $rev
     */
    public function setRev($rev) {
        $this->rev = $rev;
    }

    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @param type $tabindex
     */
    public function setTabindex($tabindex) {
        $this->tabindex = $tabindex;
    }
    
    /**
     * Tipo do conteúdo que será acessado no documento hiperlinkado
     * @param type $type
     */
    public function setType($type) {
        $this->type = $type;
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
     */
    public function setTarget($target) {
        $this->target = $target;
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
        
        $element .= $this->returnAttributesAsString();
        
        # Eventos Intrínsecos
        if(!empty($this->onblur))
            $element .= 'onblur=\''.$this->onblur.'\' ';
        
        if(!empty($this->onfocus))
            $element .= 'onfocus=\''.$this->onfocus.'\' ';
                
        $element .= '>';
        $element .= $this->text;
        $element .= '</a>';
        
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