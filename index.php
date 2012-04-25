<?php
/**
 * config.php sempre deve ser requerido nos arquivos que usam require ou include. Pq todos eles usarão a constante PATH. 
 */
//require_once 'config.php';
require_once dirname(__FILE__).'/lib/dfw/model/Usuario.class.php';
require_once dirname(__FILE__).'/lib/dfw/log.php';

echo dirname(__FILE__);
echo '<br/><br/>';
print_r($_SERVER);

// log
registraLog(7, "HH'); INSERT INTO userlog (id_usuario, ip, mensagem, sql, data_hora) VALUES ('7','127.0.0.1','injection', '08-02-1988' ); --", "teste");

die;
$usr = new Usuario();
//$usr->id_usuario = $usr->getNextId();
$usr->id_usuario = 32;
$usr->status = 1;
$usr->nome = "Novo Mário Bros";
$usr->password = "000";
$usr->email = "mario@bros.com";


$usr->read();
die;
//
//
//$usr->data_criacao = date("d-m-Y");
// o read usa o '='
//$arrDTOUsuarios = $usr->getAll(false);
//$arrDTOUsuarios = $usr->read();
// getAll usa o 'like'
$usr->delete();
echo '<br/><br/><br/>';
$usr->getAll();
//$usr->insert();
echo 'sucesso!';

//var_dump($usr);die;

$arr = $usr->getAll('nome');
var_dump($arr);

die;


echo '<br/><br/>';

require_once 'lib/dfw/view/classes/Input.class.php';
require_once 'lib/dfw/view/classes/Label.class.php';
require_once 'lib/dfw/view/classes/Select.class.php';
require_once 'lib/dfw/view/classes/Option.class.php';
require_once 'lib/dfw/view/classes/Button.class.php';
require_once 'lib/dfw/view/classes/HiperLink.class.php';
require_once 'lib/dfw/view/classes/FieldSet.class.php';
require_once 'lib/dfw/view/classes/Form.class.php';

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
            
            Label::getInstance()->setFor('radio1')->setText('TESTEEE LABEL')->setOnclick("alert('voce clicou no label')")->show();
            Input::getInstance()->setType('radio')->setName('grupo1')->setChecked(true)->setId('radio1')->setOnclick('alert("radio1")')->show();
            Label::getInstance()->setFor('radio2')->setText('TESTEEE LABEL 2222')->setOnclick('alert("voce clicou no label 222")')->show();
            Input::getInstance()->setType('radio')->setName('grupo1')->setChecked(true)->setId('radio2')->setOnclick('alert("radio2")')->show();
            echo '<br/><br/>';
            
            $opcoes[] = Option::getInstance()->setLabel('opcao1')->setClass("clss1")->setText("Mensagem 1")->returnAsString();
            $opcoes[] = Option::getInstance()->setLabel('opcao2')->setSelected(true)->setText("Mensagem 2")->returnAsString();
            $opcoes[] = Option::getInstance()->setLabel('opcao3')->setText("Mensagem 3")->returnAsString();
            Select::getInstance()->setName('selectTest')->setOnchange('alert("mudou de opcao")');
            Select::getInstance()->insertOptions($opcoes)->show();
            
            echo '<br/><br/>';
            Button::getInstance()->setValue(12)->setText("Botão")->setOnclick('alert("clicou no botao")')->setOnmousemove('alert("onmousemove button")')->show();
            
            echo '<br/><br/>';
            HiperLink::getInstance()->setHref("http://www.google.com")->setTarget("_blank")->
                    setText('Google')->setOnclick("alert('Voce vai para o google')")->show();
            
            
            ?>
        </fieldset>
        
        <?php
        
        if(!empty($_REQUEST['input1'])) {
            echo '<br/><br/>';
            echo 'REQUEST: '.$_REQUEST['input1'];
            echo '<br/><br/>';
        }
        
        echo '<br/><br/>';
        $label1 = Label::getInstance()->setFor("input1")->setText("Testeeee huhu")->returnAsString();
        $input1 = Input::getInstance()->setValue("123")->setName('input1')->setId('input1')->returnAsString();
        $submit = Input::getInstance()->setType("submit")->setValue("submit")->setTitle("Enviar")->returnAsString();
        
        $fieldSet = FieldSet::getInstance()->
                setLegend("Teste de FieldSet")->
                appendContent($label1)->
                appendContent($input1)->
                appendContent($submit)->
                setStyle("width: 223px; height: 162px")->
                setOndblclick("alert('voce clicou 2 vezes')")->
                returnAsString();
        
        Form::getInstance()->setAction("index.php")->setMethod('post')->setContent($fieldSet)->show();
        
        
        ?>
        
        
    </body>
</html>
