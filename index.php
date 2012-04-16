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

require_once 'lib/dfw/view/classes/Input.class.php';
require_once 'lib/dfw/view/classes/Label.class.php';
require_once 'lib/dfw/view/classes/Select.class.php';
require_once 'lib/dfw/view/classes/Option.class.php';

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
            
        // PRIORIDADE: SEMPRE VERIFICAR ENVENTOS INTRINSECOS
            
            Label::getInstance()->setFor('radio1')->setText('TESTEEE LABEL')->setOnclick("alert('voce clicou no label')")->show();
            Input::getInstance()->setType('radio')->setName('grupo1')->setChecked(true)->setId('radio1')->setOnclick('alert("radio1")')->show();
            Label::getInstance()->setFor('radio2')->setText('TESTEEE LABEL 2222')->setOnclick('alert("voce clicou no label 222")')->show();
            Input::getInstance()->setType('radio')->setName('grupo1')->setChecked(true)->setId('radio2')->setOnclick('alert("radio2")')->show();
            echo '<br/><br/>';
            
            $opcoes[] = Option::getInstance()->setLabel('opcao1')->setClass("clss1")->setText("Mensagem 1")->returnAsString();
            $opcoes[] = Option::getInstance()->setLabel('opcao2')->setSelected(true)->setText("Mensagem 2")->returnAsString();
            $opcoes[] = Option::getInstance()->setLabel('opcao3')->setText("Mensagem 3")->returnAsString();
            Select::getInstance()->setName('selectTest')->setOnchange('alert("mudou de opcao")');
            Select::getInstance()->insertOptions($opcoes);
            Select::getInstance()->show();
            
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
