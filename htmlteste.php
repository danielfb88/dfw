<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    
    <body>
        <br/><div><img src='http://www.w3schools.com/tags/smiley.gif' alt='Gif externo'  id='img1' /></div><br/>
        <form id='formIndex' name='formIndex' action='../../controller/alteracao/alterar1.php' method='post' onsubmit="return validar_frmIndex();" >
            <table class='formTeste_table_fields' align='left' ><tr><td align='right'><label for='textField1'  id='lb_textField1' >Text Field 1: </label></td><td align='left'><input type='text' maxlength='4' name='textField1' value='Daniel'  id='textField1'  onclick='alert("teste")' /></td></tr><tr><td align='right'><label for='textField2'  id='lb_textField2' >Text: </label></td><td align='left'><input type='text' maxlength='20' name='textField2' value='Marilza'  id='textField2' /></td></tr><tr><td align='right'><label for='textField3'  id='lb_textField3' >Text Field 3: </label></td><td align='left'><input type='text' maxlength='20' name='textField3' value='Daniel'  id='textField3' /></td></tr><tr><td align='right'><label for='combo1'  id='lb_combo1' >Combo Box Fofo: </label></td><td align='left'><select name='combo1'  id='combo1' onchange='alert("teste")' ><option >-- Selecione --</option><option >Opção 0</option><option value='1' >Opção 1</option><option selected='selected' value='2' >Opção 2</option><option value='3' >Opção 3</option></select></td></tr></table><table class='formTeste_table_buttons' align='right' ><tr><td><button type='submit' id='formTeste_btnSubmit' value='1'> Ok </button></td><td><button type='reset'> Resetar </button></td><td><button type='button' onclick='history.go(-1);'> Voltar </button></td></tr></table></form>        
    </body>
</html>