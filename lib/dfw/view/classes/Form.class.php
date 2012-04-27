<?php

/**
 * DFW Framework PHP - Classe Form
 * 
 * Elemento Form XHTML
 * Data de Criação: 16 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'Container.class.php';
require_once 'Button.class.php';

class Form extends Container {

    protected $accept;
    protected $accept_charset;
    protected $action;
    protected $method;
    protected $enctype;
    protected $strDefaultSubmitButton;
    protected $submitButton;
    protected $useResetButton;
    protected $useBackButton;

    # Eventos Intrínsecos
    protected $onreset;
    protected $onsubmit;

    /**
     *
     * @param string $id
     * @param array $fields
     * @param string $action
     * @param string $method
     * @param boolean $useDefaultSubmitButton
     * @param string $textDefaultSubmitButton
     * @param boolean $useResetButton
     * @param boolean $useBackButton 
     */
    public function __construct($id, $fields, $action, $method = 'post', $useDefaultSubmitButton = true, $textDefaultSubmitButton = 'Ok', $useResetButton = true, $useBackButton = true) {
        $this->id = $id;
        $this->fields = $fields;
        $this->action = $action;
        $this->method = $method;

        $this->useResetButton = $useResetButton;
        $this->useBackButton = $useBackButton;
        if ($useDefaultSubmitButton) {
            $this->strDefaultSubmitButton = "<button type='submit' id='" . $this->id . '_btnSubmit' . "' value='1'> $textDefaultSubmitButton </button>";
        }
    }

    /**
     * Insere o botão de submit
     * @param type $btnSubmit 
     */
    public function setBtnSubmit($btnSubmit) {
        if (is_object($btnSubmit)) {
            $this->submitButton = $btnSubmit;
        }
    }

    /**
     * Insere fields
     * @param array $fields
     */
    public function setFields(array $fields) {
        if (!empty($fields)) {
            $this->fields = $fields;
        }
    }

    /**
     * Adiciona field
     * @param array|object $field 
     */
    public function addField($field) {
        if (is_object($field)) {
            $this->fields[] = $field;
        }
    }

    /**
     * Tipos de conteúdo (MIME) que o servidor deve aceitar
     * @param type $accept
     */
    public function setAccept($accept) {
        $this->accept = $accept;
    }

    /**
     * Codificação de caracteres que será enviada e que o servidor deve suportar
     * @param type $accept_charset
     */
    public function setAccept_charset($accept_charset) {
        $this->accept_charset = $accept_charset;
    }

    /**
     * Endereço da aplicação para onde o formulário e seus dados serão enviados
     * @param type $action
     */
    public function setAction($action) {
        $this->action = $action;
    }

    /**
     * Método utilizado para envio do formulário
     * @param type $method
     */
    public function setMethod($method = "post") {
        switch ($method) {
            case "post":
            case "get":
                self::$method = $method;
                break;

            default:
                throw $e = new Exception("O atributo method='" . $method . "' não existe");
        }
    }

    /**
     * Tipo de codificação dos dados do formulário
     * @param type $enctype
     */
    public function setEnctype($enctype) {
        $this->enctype = $enctype;
    }

    /**
     * Ocorre quando um form é reiniciado
     * @param type $onreset
     */
    public function setOnreset($onreset) {
        $this->onreset = $onreset;
    }

    /**
     * Ocorre quando um form é enviado
     * @param type $onsubmit
     */
    public function setOnsubmit($onsubmit) {
        $this->onsubmit = $onsubmit;
    }

    /**
     * Monta o elemento
     * @return string 
     */
    private function mountElement() {
        $element = '<form ';

        // Atributos
        if (!empty($this->accept))
            $element .= 'accept=\'' . $this->accept . '\' ';

        if (!empty($this->accept_charset))
            $element .= 'accept_charset=\'' . $this->accept_charset . '\' ';

        if (!empty($this->action))
            $element .= 'action=\'' . $this->action . '\' ';

        if (!empty($this->enctype))
            $element .= 'enctype=\'' . $this->enctype . '\' ';

        if (!empty($this->method))
            $element .= 'method=\'' . $this->method . '\' ';

        $element .= $this->returnAttributesAsString();

        // Eventos Intrínsecos
        if (!empty($this->onreset))
            $element .= 'onreset=\'' . $this->onreset . '\' ';

        if (!empty($this->onsubmit))
            $element .= 'onsubmit=\'' . $this->onsubmit . '\' ';

        $element .= '>';

        $element .= $this->mountTable("table_form");

        // botão de submit
        $element .= "<br/>";

        $element .= "<table class='" . $this->id . "_table_btnSubmit'>";
        $element .= "<tr>";

        // submit_button
        $element .= "<td>";
        if (!empty($this->strDefaultSubmitButton)) {
            $element .= $this->strDefaultSubmitButton;
        } elseif ($this->submitButton != null) {
            $element .= $this->submitButton->returnAsString();
        } else {
            throw $e = new Exception("Botão de submit não definido para o formulário.");
            $e->getTraceAsString();
        }
        $element .= "</td>";

        // reset_button                
        if ($this->useResetButton) {
            $element .= "<td>";
            $element .= "<button type='reset'> Resetar </button>";
            $element .= "</td>";
        }

        // back_button
        if ($this->useBackButton) {
            $element .= "<td>";
            $element .= "<button type='button' onclick='history.go(-1);'> Voltar </button>";
            $element .= "</td>";
        }

        $element .= "</tr>";
        $element .= '</table>';

        $element .= '</form>';

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