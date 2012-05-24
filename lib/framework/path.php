<?php

/**
 * Path do Framework
 */
$framework_path = dirname(__FILE__) . DIRECTORY_SEPARATOR;

set_include_path(get_include_path() .
        PATH_SEPARATOR . $framework_path
);