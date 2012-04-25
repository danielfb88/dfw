<?php
session_start();

// Código que deve ser inserido em todas as páginas para verificar se o usuario está logado
// TODO: Continuar desenvolvimento de controlador de acesso. Depois objetos para o formulário.
require_once dirname(__FILE__).'/lib/dfw/security_functions.php';
loggedUser();


echo '<br/>';
die("logado!");

?>
