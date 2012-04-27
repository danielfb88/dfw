<?php
require_once dirname(__FILE__).'/lib/dfw/view/classes/Select.class.php';
require_once dirname(__FILE__).'/lib/dfw/view/classes/Input.class.php';
require_once dirname(__FILE__).'/lib/dfw/view/classes/Label.class.php';
require_once dirname(__FILE__).'/lib/dfw/view/classes/Button.class.php';
require_once dirname(__FILE__).'/lib/dfw/view/classes/HiperLink.class.php';
require_once dirname(__FILE__).'/lib/dfw/view/classes/FieldSet.class.php';

$arrOptions = array(
    new Option("1", "um"), 
    new Option("2", "dois", true), 
    new Option("3", "tres")
    );

$select = new Select('tsel', $arrOptions);
$select->show();

echo '<br/><br/>';


$label1 = new Label("Label 1", "ipt1");
$input1 = new Input('ipt1', 'teste1', 'text', 15);
$input2 = new Input('ipt2', 'teste2', 'text', 25);

$fieldsInput = array(
    array($label1, $label1, $input1), 
    $input2);
    //array($label1, $input2));

$label1->show();
$input1->show();
echo '<br/>';
$input2->show();

echo '<br/><br/>';

$button = new Button('btn1', "Botão 1", 'button', 1);
$button->show();

echo '<br/><br/>';

$link = new HiperLink('hp1', "Teste Hiper link", "http://www.google.com.br");
$link->show();

echo '<br/><br/>';
$fieldSet = new FieldSet('fieldset1', "Teste Field Set");
$fieldSet->setStyle("width: 223px; height: 162px");
$fieldSet->setFields($fieldsInput);
$fieldSet->addField($button);
$fieldSet->show();


?>