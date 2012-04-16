<?php
/**
 * DFW Framework PHP - Classe abstrata Event
 * 
 * Possui eventos comum para todos os elementos.
 * Data de Criação: 14 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @abstract
 * 
 */

abstract class Event {
    protected $onclick;
    protected $ondblclick;
    protected $onmousedown;
    protected $onmouseup;
    protected $onmouseover;
    protected $onmousemove;
    protected $onmouseout;
    protected $onkeypress;
    protected $onkeydown;
    protected $onkeyup;
    
    /**
     * Ocorre quando se clica com o botão do mouse sobre o elemento
     * @param type $onclick
     * @return \Event 
     */
    public function setOnclick($onclick) {
        $this->onclick = $onclick;
        return $this;
    }

    /**
     * Ocorre quando se faz duplo clique com o botão do mouse sobre o elemento
     * @param type $ondblclick
     * @return \Event 
     */
    public function setOndblclick($ondblclick) {
        $this->ondblclick = $ondblclick;
        return $this;
    }

    /**
     * Ocorre quando se pressiona com o botão do mouse sobre um elemento
     * @param type $onmousedown
     * @return \Event 
     */
    public function setOnmousedown($onmousedown) {
        $this->onmousedown = $onmousedown;
        return $this;
    }

    /**
     * Ocorre quando se solta o botão do mouse que foi pressionado anteriormente
     * @param type $onmouseup
     * @return \Event 
     */
    public function setOnmouseup($onmouseup) {
        $this->onmouseup = $onmouseup;
        return $this;
    }

    /**
     * Ocorre quando o ponteiro do mouse estiver parado sobre um elemento
     * @param type $onmouseover
     * @return \Event 
     */
    public function setOnmouseover($onmouseover) {
        $this->onmouseover = $onmouseover;
        return $this;
    }

    /**
     * Ocorre enquanto o ponteiro do mouse estiver em movimento sobre um elemento
     * @param type $onmousemove
     * @return \Event 
     */
    public function setOnmousemove($onmousemove) {
        $this->onmousemove = $onmousemove;
        return $this;
    }

    /**
     * Ocorre quando o ponteiro do mouse é movido para fora do elemento
     * @param type $onmouseout
     * @return \Event 
     */
    public function setOnmouseout($onmouseout) {
        $this->onmouseout = $onmouseout;
        return $this;
    }

    /**
     * Ocorre quando se pressiona e solta uma tecla sobre um elemento
     * @param type $onkeypress
     * @return \Event 
     */
    public function setOnkeypress($onkeypress) {
        $this->onkeypress = $onkeypress;
        return $this;
    }

    /**
     * Ocorre quando se pressiona uma tecla sobre um elemento
     * @param type $onkeydown
     * @return \Event 
     */
    public function setOnkeydown($onkeydown) {
        $this->onkeydown = $onkeydown;
        return $this;
    }

    /**
     * Ocorre quando se solta uma tecla sobre um elemento
     * @param type $onkeyup
     * @return \Event 
     */
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
