<?php
/**
 * config.php sempre deve ser requerido nos arquivos que usam require ou include. Pq todos eles usarão a constante PATH. 
 */
require_once 'config.php';
require_once PATH . 'model/DAO/DAOUsuario.class.php';
require_once PATH . 'model/DAO/DAOTeste.php';

/*
$teste = new DAOTeste();
$teste->id1 = 8;
/*
$teste->id2 = null;
$teste->campo1 = "lala";
$teste->campo2 = "llele";
$teste->campo3 = "lili";
$teste->campo4 = "lolo";
$teste->numero = 112;
 
$teste->read();

/*
$data = array(
    'id1' => "setData",
    'id2' => "setData",
    'campo1' => "setData",
    'campo2' => "setData",
    'campo3' => "setData",
    'campo4' => "setData",
    'numero' => "setData"
);
 

//$teste->setData($data);
var_dump($teste);die;

var_dump($teste->executeQuery("INSERT INTO teste (campo1, campo2) VALUES ('aaaa', 'bbbb')"));die;


var_dump($teste->save(false));
die;
 * 
 */

$usr = new DAOUsuario();
//$usr->id_usuario = 12;
//$usr->status = 1;
//$usr->nome = "Marilza";
//$usr->password = "111";
//$usr->email = "marilza@marilza.com";
//$usr->data_criacao = date("d-m-Y");
// o read usa o '='
//$arrDTOUsuarios = $usr->getAll(false);
//$arrDTOUsuarios = $usr->read();
// getAll usa o 'like'
//$usr->getAll();
//$usr->delete();
//$usr->save(false);
$arr = $usr->getAll();
var_dump($arr);
die;

var_dump($usr);
echo '<br/><br/>';


?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
