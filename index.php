<?php
error_reporting(E_ALL);

require_once 'init.php';
require_once 'lib/framework/controller/FrontController.class.php';

FrontController::run(true);