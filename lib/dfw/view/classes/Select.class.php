<?php
/**
 * DFW Framework PHP - Classe Singleton Select
 * 
 * Elemento Select XHTML
 * Data de Criação: 15 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @final
 * 
 */

require_once 'Element.class.php';

final class Select extends Element {
    protected $disabled;
    protected $multiple;
    protected $name;
    protected $size;
    protected $tabindex;
    protected $arrOptions = array();
    # Eventos Intrínsecos
    protected $onblur;
    protected $onchange;
    protected $onfocus;
    
    /**
     * Instância do Singleton
     * @var Select
     */
    private static $instance;
    
    private function __construct() { }
    
    /**
     * Retorna instância única do singleton
     * @return Select
     */
    public static function getInstance() {
        if(empty(self::$instance)) 
            self::$instance = new Select();
        
        return self::$instance;
    }
    /**
     * Adiciona string com a option montada
     * @param string $strOption 
     */
    public function addOption($strOption) {
        if(!empty($strOption) && is_string($strOption))
            $this->arrOptions[] = $strOption;
    }
    
    /**
     * Insere array de Options
     * @param array $arrOptions 
     */
    public function insertOptions(array $arrOptions) {
        if(!empty($arrOptions) && is_array($arrOptions))
            $this->arrOptions = $arrOptions;
    }
    
    /**
     * Desabilita o controle de modo que o usuário não poderá interagir com ele
     * @param type $disabled
     * @return \Select 
     */
    public function setDisabled($disabled) {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * Habilita a seleção com múltiplas opções
     * @param type $multiple
     * @return \Select 
     */
    public function setMultiple($multiple) {
        $this->multiple = $multiple;
        return $this;
    }

    /**
     * Nome do controle que o identifica ao enviar o formulário
     * @param type $name
     * @return \Select 
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Número de linhas em que as opções serão visíveis no controle
     * @param type $size
     * @return \Select 
     */
    public function setSize($size) {
        $this->size = $size;
        return $this;
    }

    /**
     * Ordem de navegação na página quando se utiliza a tecla TAB
     * @param type $tabindex
     * @return \Select 
     */
    public function setTabindex($tabindex) {
        $this->tabindex = $tabindex;
        return $this;
    }
    
    /**
     * Ocorre quando o elemento perde o foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onblur
     * @return \Select 
     */
    public function setOnblur($onblur) {
        $this->onblur = $onblur;
        return $this;
    }

    /**
     * Ocorre quando o conteúdo do controle é alterado
     * @param type $onchange
     * @return \Select 
     */
    public function setOnchange($onchange) {
        $this->onchange = $onchange;
        return $this;
    }

    /**
     * Ocorre quando o elemento entra em foco por um clique do mouse ou mediante navegação por tabulação
     * @param type $onfocus
     * @return \Select 
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
        $element = '<select ';
        
        if($this->disabled)
            $element .= 'disabled=\'disabled\' ';
        
        if($this->multiple)
            $element .= 'multiple=\'multiple\' ';
        
        if(!empty($this->name))
            $element .= 'name=\''.$this->name.'\' ';
        
        if(!empty($this->size))
            $element .= 'size=\''.$this->size.'\' ';
        
        if(!empty($this->tabindex))
            $element .= 'tabindex=\''.$this->tabindex.'\' ';
        
        # Eventos Intrínsecos
        if(!empty($this->onblur))
            $element .= 'onblur=\''.$this->onblur.'\' ';
        
        if(!empty($this->onchange))
            $element .= 'onchange=\''.$this->onchange.'\' ';
        
        if(!empty($this->onfocus))
            $element .= 'onfocus=\''.$this->onfocus.'\' ';
        
        $element .= parent::show();        
        $element .= '>';
        
        // Inserindo options
        for($i=0; $i<count($this->arrOptions); $i++) {
            $element .= $this->arrOptions[$i];
        }
        
        $element .= '</select>';
                
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
        $this->disabled = null;
        $this->multiple = null;
        $this->name = null;
        $this->size = null;
        $this->tabindex = null;
        $this->arrOptions = array();
        $this->onblur = null;
        $this->onchange = null;
        $this->onfocus = null;
        parent::clear();
    }

}
?>
