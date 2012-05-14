<?php

/**
 * Incluindo os paths dos diretorios usados na aplicação 
 */
$model_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Model';
$controller_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Controller';
$view_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'View';
$lib_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib';

set_include_path(get_include_path() .
        PATH_SEPARATOR . $model_path .
        PATH_SEPARATOR . $controller_path .
        PATH_SEPARATOR . $view_path .
        PATH_SEPARATOR . $lib_path
);

// Alternativa ao ../..
// dirname(dirname(__FILE__))