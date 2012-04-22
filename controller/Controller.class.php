<?php
// TODO: Todas as classes controllers herdarão desta e os metodos de autenticaçao ficarao aqui.
// TODO: CRIAR AUTENTICAÇÃO.


abstract class Controller {
    
    static function autenticar($usuario, $senha) {
        
    }
    
    abstract static function adicionar(array $data);
    abstract static function editar(array $data);
    abstract static function deletar(array $params);
    abstract static function get(array $params);
    abstract static function getAll(array $params);

    
    
    
    
    /*
     // TODO: Analizar este metodo para sessao
    // Função que gera um token, atribui-o à sessão e retorna-o
    function gerarToken() { 
            // Analizar Isto:
            // http://php.net/manual/pt_BR/function.uniqid.php
		// 1º Gera um número aleatório
		// 2º Gera um ID único, cujo prefixo é o número gerado aleatoriamente
		// 3º Calcula um hash MD5 do ID único gerado anteriormente
		$token = md5( uniqid( rand() ) );
		// Atribui o token à sessão
		$_SESSION[SESS_TOKEN] = $token;
		// Retorna o token
		return $token;
	}
     * 
     */
}
?>
