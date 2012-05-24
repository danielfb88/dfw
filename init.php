<?php

/**
 * Incluindo o path root da aplicação no include_path
 */
$root_path = dirname(__FILE__) . DIRECTORY_SEPARATOR;

set_include_path(get_include_path() .
        PATH_SEPARATOR . $root_path
);