<?php
/**
 * config.php sempre deve ser requerido nos arquivos que usam require ou include. Pq todos eles usarão a constante PATH. 
 */
require_once 'config.php';
require_once PATH . 'model/DAO/DAOUsuario.class.php';

$usr = new DAOUsuario();
$usr->id_usuario = 12;
//$usr->status = 1;
//$usr->nome = "Daniel Ferreira Bonfim";
//$usr->password = "000";
//$usr->email = "marilza@marilza.com";
//$usr->data_criacao = date("d-m-Y");
// o read usa o '='
//$arrDTOUsuarios = $usr->getAll(false);
//$arrDTOUsuarios = $usr->read();
// getAll usa o 'like'
//$usr->getAll();
//$usr->delete();
//$usr->save();
$usr->getAll();
var_dump($usr->getLastQueryAsString());
echo '<br/><br/>';

require_once 'lib/dfw/view/html/Input.class.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <fieldset>
        <legend>Minha legenda</legend>
            <?php 
            $input = new Input();
            $input->id = 'input_id';
            $input->name = 'input_id';
            $input->maxlength = '12';
            $input->size = 30;
            $input->onclick = 'alert("teste")';
            $input->onmousemove = 'alert("moveu-se")';
            $input->show();
            ?>
        </fieldset>
    </body>
</html>
