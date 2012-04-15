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
    public $onclick;
    /**
     * Ocorre quando se faz duplo clique com o botão do mouse sobre o elemento
     * @var string 
     */ 
    public $ondblclick;
    /**
     * Ocorre quando se pressiona com o botão do mouse sobre um elemento
     * @var string 
     */
    public $onmousedown;
    /**
     * Ocorre quando se solta o botão do mouse que foi pressionado anteriormente
     * @var string 
     */ 
    public $onmouseup;
    /**
     * Ocorre quando o ponteiro do mouse estiver parado sobre o elemento
     * @var string
     */
    public $onmouseover;
    /**
     * Ocorre quando o ponteiro do mouse estiver em movimento sobre um elemento
     * @var string
     */
    public $onmousemove;
    /**
     * Ocorre quando o ponteiro do mouse é movido para fora do elemento
     * @var string
     */
    public $onmouseout;
    /**
     * Ocorre quando se pressiona e solta uma tecla sobre um elemento
     * @var string
     */
    public $onkeypress;
    /**
     * Ocorre quando se pressiona uma tecla sobre um elemento
     * @var string
     */
    public $onkeydown;
    /**
     * Ocorre quando se solta uma tecla sobre um elemento
     * @var string
     */
    public $onkeyup;
    
    public function show() {
        
        if(!empty($this->onclick))
            $event = ' onclick=\''.$this->onclick.'\' ';
        
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
}
?>
