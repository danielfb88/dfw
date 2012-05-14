<?php
/**
 * Paths do Framework
 */

$model_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'model';
$controller_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'controller';

set_include_path(get_include_path() . 
        PATH_SEPARATOR . $model_path . 
        PATH_SEPARATOR . $controller_path
        );

// Alternativa ao ../..
// dirname(dirname(__FILE__))