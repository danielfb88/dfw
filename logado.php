<?php
session_start();

// Código que deve ser inserido em todas as páginas para verificar se o usuario está logado
require_once dirname(__FILE__).'/lib/dfw/security_functions.php';
loggedUser();

echo '<br/>
    logado!<br/><br/>';


// TODO: Estude melhor o artigo sobre segurança e em breve, acridito que já poderemos começar a desenvolver o .ekos
?>

<a href="lib/dfw/auth.php?a=logout">logout</a>


