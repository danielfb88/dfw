<?php
require_once 'lib/framework/controller/request/Request.class.php';

// Verificando mensagens deixadas pelo command
$feedback = $request->getFeedback();
for ($i = 0; $i < count($feedback); $i++) {
    echo $feedback[$i];
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form id="frmLogin" name="frmLogin" action="index.php?cmd=auth" method="post">
            Login <input name="tx_user" maxlength="15"/>
            Senha <input name="tx_password" maxlength="15"/>
            <input type="submit" name="btn_submit" value="Ok"/>
        </form>
    </body>
</html>