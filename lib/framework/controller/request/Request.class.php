<?php

/**
 * Objeto REQUEST.
 * A cada nova requisição, uma nova instância deste objeto é gerada. 
 * 
 * @author Daniel Bonfim
 * @since 14 de Maio de 2012
 * @version 1.0
 */
class Request {

    /**
     * Propriedades $_REQUEST
     * @var array
     */
    private $properties;

    /**
     * Mensagens que pode ser passada para outras camadas.
     * @var array
     */
    private $feedback = array();

    /**
     *
     * @param boolean $useRegistry - Possibilidade de usar um objeto Registry para armazenar o Request
     */
    public function __construct($useRegistry = false) {
        $this->init();
        if ($useRegistry) {
            require_once 'controller/registry/RequestRegistry.class.php';
            RequestRegistry::setRequest($this);
        }
    }

    /**
     * Inicializa a variável properties com os dados do $_REQUEST 
     */
    public function init() {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->properties = $_REQUEST;
        }
    }

    /**
     * Retorna a propriedade informada
     * @param type $key
     * @return mixed
     */
    public function getProperty($key) {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        } else {
            return null;
        }
    }

    /**
     * Seta uma propriedade
     * @param string $key
     * @param mixed $value 
     */
    public function setProperty($key, $value) {
        $this->properties[$key] = $value;
    }

    /**
     * Retorna o Command (cmd) definido
     * @return string
     */
    public function getCommandName() {
        if (isset($this->properties['cmd'])) {
            return $this->properties['cmd'];
        }
        return null;
    }

    /**
     * Apenas objetos command terão permissão para escrever feedbacks para a view
     * @param string $msg 
     */
    public function addFeedback($msg) {
        array_push($this->feedback, $msg);
    }

    /**
     * Recupenrando array de feedback
     * @return array
     */
    public function getFeedback() {
        return $this->feedback;
    }

    /**
     * Retorna o array de feedback como uma string
     * @param char $separator
     * @return string 
     */
    public function getFeedbackAsString($separator = "\n") {
        return implode($separator, $this->feedback);
    }

}