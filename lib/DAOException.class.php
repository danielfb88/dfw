<?php

class DAOException extends Exception {
    public function __construct($message) {
        $message = "<br/><b>$message</b><br/>";        
        parent::__construct($message);
        $this->getTraceAsString();
    }
    
    public function __toString() {
        parent::__toString();
    }
}
?>
