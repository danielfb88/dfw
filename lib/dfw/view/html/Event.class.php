<?php
/**
 * ****************************************************************
 * Classe Event                                                 *
 *----------------------------------------------------------------*
 * Eventos
 * 
 * Data de Criação: 14 de Abril de 2012                           *
 *                                                                *
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>             *
 * @version     1.0                                               *
 * @abstract                                                      *
 *                                                                *
 * ****************************************************************
 */

abstract class Event {
    /**
     * Ocorre quando se clica com o botão do mouse sobre o elemento
     * @var string 
     */
    protected $onclick;
    /**
     * Ocorre quando se faz duplo clique com o botão do mouse sobre o elemento
     * @var string 
     */ 
    protected $ondblclick;
    /**
     * Ocorre quando se pressiona com o botão do mouse sobre um elemento
     * @var string 
     */
    protected $onmousedown;
    /**
     * Ocorre quando se solta o botão do mouse que foi pressionado anteriormente
     * @var string 
     */ 
    protected $onmouseup;
    /**
     * Ocorre quando o ponteiro do mouse estiver parado sobre o elemento
     * @var string
     */
    protected $onmouseover;
    /**
     * Ocorre quando o ponteiro do mouse estiver em movimento sobre um elemento
     * @var string
     */
    protected $onmousemove;
    /**
     * Ocorre quando o ponteiro do mouse é movido para fora do elemento
     * @var string
     */
    protected $onmouseout;
    /**
     * Ocorre quando se pressiona e solta uma tecla sobre um elemento
     * @var string
     */
    protected $onkeypress;
    /**
     * Ocorre quando se pressiona uma tecla sobre um elemento
     * @var string
     */
    protected $onkeydown;
    /**
     * Ocorre quando se solta uma tecla sobre um elemento
     * @var string
     */
    protected $onkeyup;
    
    public function setOnclick($onclick) {
        $this->onclick = $onclick;
        return $this;
    }

    public function setOndblclick($ondblclick) {
        $this->ondblclick = $ondblclick;
        return $this;
    }

    public function setOnmousedown($onmousedown) {
        $this->onmousedown = $onmousedown;
        return $this;
    }

    public function setOnmouseup($onmouseup) {
        $this->onmouseup = $onmouseup;
        return $this;
    }

    public function setOnmouseover($onmouseover) {
        $this->onmouseover = $onmouseover;
        return $this;
    }

    public function setOnmousemove($onmousemove) {
        $this->onmousemove = $onmousemove;
        return $this;
    }

    public function setOnmouseout($onmouseout) {
        $this->onmouseout = $onmouseout;
        return $this;
    }

    public function setOnkeypress($onkeypress) {
        $this->onkeypress = $onkeypress;
        return $this;
    }

    public function setOnkeydown($onkeydown) {
        $this->onkeydown = $onkeydown;
        return $this;
    }

    public function setOnkeyup($onkeyup) {
        $this->onkeyup = $onkeyup;
        return $this;
    }
    
    /**
     * Exibe o elemento criado
     * @return string 
     */
    public function show() {
        
        $event = '';
        if(!empty($this->onclick))
            $event .= ' onclick=\''.$this->onclick.'\' ';
        
        if(!empty($this->ondblclick))
            $event .= ' ondblclick=\''.$this->ondblclick.'\' ';
        
        if(!empty($this->onmousedown))
            $event .= ' onmousedown=\''.$this->onmousedown.'\' ';
        
        if(!empty($this->onmouseup))
            $event .= ' onmouseup=\''.$this->onmouseup.'\' ';
        
        if(!empty($this->onmouseover))
            $event .= ' onmouseover=\''.$this->onmouseover.'\' ';
        
        if(!empty($this->onmousemove))
            $event .= ' onmousemove=\''.$this->onmousemove.'\' ';
        
        if(!empty($this->onmouseout))
            $event .= ' onmouseout=\''.$this->onmouseout.'\' ';
        
        if(!empty($this->onkeypress))
            $event .= ' onkeypress=\''.$this->onkeypress.'\' ';
        
        if(!empty($this->onkeydown))
            $event .= ' onkeydown=\''.$this->onkeydown.'\' ';
        
        if(!empty($this->onkeyup))
            $event .= ' onkeyup=\''.$this->onkeyup.'\' ';
        
        return $event;
    }
    
    /**
     * Limpa os valores dos atributos. 
     */
    protected function clear() {
        $this->onclick = null;
        $this->ondblclick = null;
        $this->onkeydown = null;
        $this->onkeypress = null;
        $this->onkeyup = null;
        $this->onmousedown = null;
        $this->onmousemove = null;
        $this->onmouseout = null;
        $this->onmouseover = null;
        $this->onmouseup = null;
    }
}
?>
