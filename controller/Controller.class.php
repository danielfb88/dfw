<?php
// TODO: Todas as classes controllers herdarão desta e os metodos de autenticaçao ficarao aqui.
// TODO: CRIAR AUTENTICAÇÃO.
// TODO: CONTINUAR DESENOLVIMENTO DE COMPONENTES VIEW PARA OS OUTROS ELEMENTOS XHTML

// modificar
// TODO: Analizar este metodo para sessao
// Função que gera um token, atribui-o à sessão e retorna-o
	function gerarToken() {
 
		// 1º Gera um número aleatório
		// 2º Gera um ID único, cujo prefixo é o número gerado aleatoriamente
		// 3º Calcula um hash MD5 do ID único gerado anteriormente
		$token = md5( uniqid( rand() ) );
 
		// Atribui o token à sessão
		$_SESSION[SESS_TOKEN] = $token;
 
		// Retorna o token
		return $token;
 
	}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
