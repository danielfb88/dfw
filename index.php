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
require_once 'lib/dfw/view/html/Label.class.php';

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
            
            Label::getInstance()->setFor('radio1')->setMessage('TESTEEE LABEL')->setOnclick('alert("voce clicou no label")')->show();
            Input::getInstance()->setType('radio')->setName('grupo1')->setChecked(true)->setId('radio1')->setOnclick('alert("radio1")')->show();
            Label::getInstance()->setFor('radio2')->setMessage('TESTEEE LABEL 2222')->setOnclick('alert("voce clicou no label 222")')->show();
            Input::getInstance()->setType('radio')->setName('grupo1')->setChecked(true)->setId('radio2')->setOnclick('alert("radio2")')->show();
            
            /*
            $input = new Input();
            $input->id = 'input_id';
            $input->name = 'input_id';
            $input->maxlength = '12';
            $input->size = 30;
            $input->onclick = 'alert("teste")';
            $input->onmousemove = 'alert("moveu-se")';
            $input->show();
             * 
             */
            ?>
        </fieldset>
    </body>
</html>
