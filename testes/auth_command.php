<?php
require_once '../Controller/Controller.class.php';

// Interface necessária para o usuário
$controller = new Controller();
$context = $controller->getContext();
$context->addParam('action', 'login');
$controller->process();
?>
