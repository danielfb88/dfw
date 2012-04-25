<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <head>
        
    </head>
    <body>
        <form id="frmLogin" name="frmLogin" action="lib/dfw/auth.php?action=login" method='post' onsubmit="">
            <div style="text-align: center;">

            </div>
            <table class="titulo-tabela" align="center" border="0" width="460">				
                  <tbody>
                        <tr>                                
                              <td style="text-align: center;">
                              <label><b>Insira seu usuário e senha para entrar</b></label>
                        </td>
                        </tr>
                  </tbody>
            </table>

            <table class="conteudo-tabela" align="center" border="0" width="460">

                  <tbody>
                        <tr>
                              <td align="right" height="27" width="150">
                                    <label>Usuário:</label>
                              </td>
                              <td colspan="2">
                                    <input name="usuario" id="usuario" size="25" maxlength="20" alt="Usuário" type="text">
                              </td>
                        </tr> 

                        <tr>
                              <td align="right" height="27" width="150">
                                    <label>Senha:</label>
                              </td>
                              <td colspan="2">
                                    <input name="senha" id="senha" size="25" maxlength="8" alt="Senha" type="password">
                              </td>
                        </tr> 

                  </tbody>
            </table>   

            <table class="conteudo-tabela" align="center" border="0" width="460">
                  <tbody>
                        <tr>
                              <td align="center" width="90%">
                                    <input name="btn_ok" id="btn_ok" value="Ok" type="submit">
                              </td>
                        </tr>
                  </tbody>
            </table>   

      </form>
    </body>
</html>