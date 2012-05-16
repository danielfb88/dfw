<?php

/**
 * Path do Framework
 */
$framework_path = dirname(__FILE__);

set_include_path(get_include_path() .
        PATH_SEPARATOR . $framework_path
);

// Alternativa ao ../..
// dirname(dirname(__FILE__))