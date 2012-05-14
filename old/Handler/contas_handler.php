<?php
$action = $_GET['action'];
$id = (!empty($_GET['id'])) ? $_GET['id'] : '';
$data = $_POST;

switch ($action) {
    case 'add':
        // executa operaçoes do controller e chama a view
        require_once realpath(dirname(__FILE__)."/../View/contas/vwAdicionarConta.php");

        break;
    case 'edit':
        // executa operaçoes do controller e chama a view
        //echo realpath(dirname(__FILE__)."/../View/contas/vwEditarConta.php?id=".$id);
        require_once realpath(dirname(__FILE__)."/../View/contas/vwEditarConta.php");
        
        break;
    case 'search':
        // executa operaçoes do controller e chama a view
        require_once realpath(dirname(__FILE__)."/../View/contas/vwPesquisarConta.php");
        
        break;
    case 'view':
        // executa operaçoes do controller e chama a view
        require_once realpath(dirname(__FILE__)."/../View/contas/vwConta.php?value=".$id);
        
        break;
    case 'delete':
        
        break;
    default:
        break;
}