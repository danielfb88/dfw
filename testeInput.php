<?php
require_once dirname(__FILE__).'/lib/dfw/view/classes/Select.class.php';
require_once dirname(__FILE__).'/lib/dfw/view/classes/Input.class.php';

$arrOptions = array(
    new Option("1", "um"), 
    new Option("2", "dois", true), 
    new Option("3", "tres")
    );

$select = new Select('tsel', $arrOptions);
$select->show();

echo '<br/><br/>';

$input1 = new Input('ipt1', 'teste1', 'text', 15);
$input2 = new Input('ipt2', 'teste2', 'text', 25);

$input1->show();
echo '<br/>';
$input2->show();


?>