<?php
/**
 * DFW Framework PHP - Classe Form
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

class Form extends Element {
    private static $accept;
    private static $accept_charset;
    private static $action;
    private static $method;
    private static $enctype;
    private static $content;
    
    private static $field;
    
    # Eventos Intrínsecos
    private static $onreset;
    private static $onsubmit;
        
    /**
     * Tipos de conteúdo (MIME) que o servidor deve aceitar
     * @param type $accept
     */
    public static function setAccept($accept) {
        self::$accept = $accept;
    }

    /**
     * Codificação de caracteres que será enviada e que o servidor deve suportar
     * @param type $accept_charset
     */
    public static function setAccept_charset($accept_charset) {
        self::$accept_charset = $accept_charset;
    }

    /**
     * Endereço da aplicação para onde o formulário e seus dados serão enviados
     * @param type $action
     */
    public static function setAction($action) {
        self::$action = $action;
    }

    /**
     * Método utilizado para envio do formulário
     * @param type $method
     */
    public static function setMethod($method = "post") {
        switch($method) {
            case "post":
            case "get":
                self::$method = $method;
                break;
            
            default:
                throw $e = new Exception("O atributo method='".$method."' não existe");
        }        
    }

    /**
     * Tipo de codificação dos dados do formulário
     * @param type $enctype
     */
    public static function setEnctype($enctype) {
        self::$enctype = $enctype;
    }
    
    /**
     * Ocorre quando um form é reiniciado
     * @param type $onreset
     */
    public static function setOnreset($onreset) {
        self::$onreset = $onreset;
    }

    /**
     * Ocorre quando um form é enviado
     * @param type $onsubmit
     */
    public static function setOnsubmit($onsubmit) {
        self::$onsubmit = $onsubmit;
    }
        
    public static function addField(array $field) {
        self::$field[] = $field;
    }
    
    // o form vai gerar uma tabela e organizar os fields pela ordem que estao definidos
    // cada field é um array: ex: $field[0] = array($field);
    // que pode ser $field[0] = array($label, $field);
    public static function addFields(array $fields) {
        self::$field = $fields;
    }
    
    /**
     * Monta o elemento
     * @param $tableParams Parâmetros da Tabela que comporta-rá os fields
     * @return string 
     */
    private static function mountElement(array $tableParams) {
        // Abrindo a Tag
        $element = '<form ';
        
        // Atributos
        if(!empty(self::$accept))
            $element .= 'accept=\''.self::$accept.'\' ';        
        if(!empty(self::$accept_charset))
            $element .= 'accept_charset=\''.self::$accept_charset.'\' ';        
        if(!empty(self::$action))
            $element .= 'action=\''.self::$action.'\' ';        
        if(!empty(self::$enctype))
            $element .= 'enctype=\''.self::$enctype.'\' ';        
        if(!empty(self::$method))
            $element .= 'method=\''.self::$method.'\' ';
                
        // Atributo dos pais
        $element .= parent::returnAttributesAsString();
        
        // Eventos Intrínsecos
        if(!empty(self::$onreset))
            $element .= 'onreset=\''.self::$onreset.'\' ';        
        if(!empty(self::$onsubmit))
            $element .= 'onsubmit=\''.self::$onsubmit.'\' ';
        
        // Fechando a Tag de atributos
        $element .= '>';
        
        // configurar a tabela $tableParams
        // TODO: colocar todos os fields dentro da tabela
        // Conteúdo do Form
        $element .= self::$content;
        
        // Fechando a Tag
        $element .= '</form>';
        
        return $element;
    }

    /**
     * Exibe o elemento html na tela.
     * As variáveis do Singleton são sempre limpas ao final deste método. 
     */
    public static function show() {
        $element = self::mountElement();                
        // Limpando as configurações para uma nova chamada.
        self::clear();        
        // exibindo o resultado
        echo $element;        
    }
    
    /**
     * Retorna o elemento html como uma string
     * @return string 
     */
    public static function returnAsString() {
        $element = self::mountElement(); 
        // Limpando as configurações para uma nova chamada.
        self::clear();        
        // retornando o resultado
        return $element;
    }
    
    protected static function clear() {
        self::$accept = null;
        self::$accept_charset = null;
        self::$action = null;
        self::$enctype = null;
        self::$method = null;
        self::$field = null;   
        self::$onreset = null;
        self::$onsubmit = null;
        parent::clear();
    }

}
// TODO: Não feche a tag php