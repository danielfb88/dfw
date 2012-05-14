<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php

require_once dirname(__FILE__) . '/lib/dfw/view/classes/Select.class.php';
require_once dirname(__FILE__) . '/lib/dfw/view/classes/Input.class.php';
require_once dirname(__FILE__) . '/lib/dfw/view/classes/Label.class.php';
require_once dirname(__FILE__) . '/lib/dfw/view/classes/Button.class.php';
require_once dirname(__FILE__) . '/lib/dfw/view/classes/HiperLink.class.php';
//require_once dirname(__FILE__) . '/lib/dfw/view/classes/FieldSet.class.php';
//require_once dirname(__FILE__) . '/lib/dfw/view/classes/Form.class.php';
require_once dirname(__FILE__) . '/lib/dfw/view/classes/Img.class.php';
require_once dirname(__FILE__) . '/lib/dfw/view/classes/TextArea.class.php';
require_once dirname(__FILE__) . '/lib/dfw/view/classes/TextField.class.php';
require_once dirname(__FILE__) . '/lib/dfw/view/classes/ComboBox.class.php';
require_once dirname(__FILE__) . '/lib/dfw/view/classes/MultipleSelectBox.class.php';

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
/*
echo '<br/><br/>';
$fieldSet = new FieldSet('fieldset1', "Teste Field Set");
$fieldSet->setStyle("width: 223px; height: 162px");
$fieldSet->setFields($fieldsInput);
$fieldSet->addField($button);
$fieldSet->show();


$form = new Form('frm1', array($fieldSet), 'http://www.google.com', 'get', 'left', true, 'Enviar', true, true);
$form->show();
 * 
 */

$img = new Img('img1', 'http://www.w3schools.com/tags/smiley.gif', 'Gif externo');
$img->show();

$textArea = new TextArea('txarea1', "Carolina lalalla, lalalallal lalalalalla lalaaaaaa", false);
$textArea->setCols(50);
$textArea->setRows(3);
$textArea->show();

echo "<br/>";
$palavra = "daniel";
echo $palavra;
echo "<br/>";
$palavra[0] = strtoupper($palavra[0]);
echo $palavra;

echo "<br/><br/>";

$textField1 = new TextField('textField1', "Text Field 1: ", "Daniel", 20);
$textField1->addAttribute('onclick', "alert('teste')");
$textField1->addAttribute('maxlength', 4);
$textField1->show();
echo '<br/>';
    
    $arrValues = array(
            "0" => "Opção 0",
            "1" => "Opção 1",
            "2" => "Opção 2",
            "3" => "Opção 3"
            );
        $comboBox = new ComboBox('combo1', $arrValues, "2", '-- Selecione --', "Combo Box Fofo: ");

        $comboBox->addAttribute("onchange", 'alert("teste")');
        $comboBox->show();
        
    /*
$formkkk = new Form('formTeste', $fields, 'http://www.google.com.br', 'get');
        $formkkk->show();
        
        //print_r($textField1->getElements());
     * 
     */
        
        $tarea = new TextArea('tarea', '', false);
        $tarea->setRows(7);
        $tarea->show();
        echo '<br/><br/>';
        
        $arrValues = array('option1', 'option2', 'option3', 'option4');
        $msb = new MultipleSelectBox('multiple', $arrValues);
        //$msb->addAttribute('select1', 'size', '20');
        $msb->show();
        
        echo '<br/><br/>';
        
        print_r($_GET);
        
        
?>