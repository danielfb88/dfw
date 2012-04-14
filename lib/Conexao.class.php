<?php
require PATH."config_db.php";

/**
 * Classe de Conexao com o Banco de Dados utilizando PDO
 * 
 * Data de Criação: 31 de Março de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmai.com>
 * @version     1.0
 */

// TODO: COnfigurar a segurança no banco de dados para nao permitir que o usuário tenha direitos a comandos DDL
// http://www.ibm.com/developerworks/br/opensource/library/os-postgresecurity/
class Conexao {    
    private $driver = Config_DB::DRIVER;
    private $host = Config_DB::HOST;
    private $port = Config_DB::PORT;
    private $dbname = Config_DB::DBNAME;
    private $user = Config_DB::USER;
    private $password = Config_DB::PASSWORD;
    /**
     * Instância da classe PDO.
     * @var PDO 
     */
    private $db = null;
    private $connected = false;    
    private $dns = '';
    
    public function __construct() { }
        
    public function connect() {
        try {
            $this->dns = "$this->driver:host=$this->host;port=$this->port;dbname=$this->dbname";
            $this->db = new PDO($this->dns, $this->user, $this->password);
            //$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connected = true;

       } catch ( PDOException $e ) {
            echo 'Conexão falhou. Erro: ' . $e->getMessage();
            echo '<br/>';
            echo $e->getTraceAsString();
       }
    }
    
    public function disconnect() {
        unset($this->db);
        $this->connected = false;
    }
      
    
    public function is_connected() {
        return $this->connected;
    }
    
    /**
     * Prepara a sql
     * @param type $sql
     * @return PDO 
     */
    public function getPreparedStatment($sql) {
        return $this->db->prepare($sql);
        
    }
    

    /**
     * Vincula o valor ao seu alias para aumentar a segurança contra sql injection
     * @param PDOStatement $preparedStatment
     * @param array $filterValues
     * @param string $type "like" ou "=". 
     * Se for "like", ele circunda o valor com %. 
     * Se for "=" ele bind o valor normalmente.
     */
    public function bindValue(PDOStatement &$preparedStatment, array &$filterValues, $whereType) {
        if($whereType != "=" && $whereType != "like") {
            throw $e = new Exception("Parâmetro whereType inválido. Use '=' ou 'like'");
            $e->getTraceAsString();
        }    
        
        // vinculando valor ao seu alias para preparação
        foreach($filterValues as $key => $value) {  
            
            switch ($whereType) {
                case "=":

                    // Prefira bindValue a bindParam
                    if (is_int($value))
                        $param = PDO::PARAM_INT;                
                    else if(is_bool($value))
                        $param = PDO::PARAM_BOOL;                
                    else if(is_null($value))
                        $param = PDO::PARAM_NULL;                
                    else if(is_string($value))
                        $param = PDO::PARAM_STR;                
                    else 
                        $param = false;

                    if($param) {                        
                        $preparedStatment->bindValue($key, $value, $param);
                    }
                     
                    break;                     

                case "like":

                    $value = "%".$value."%";                
                    $preparedStatment->bindValue($key, $value, PDO::PARAM_STR);

                    break;      
                default:
                    throw $e = new Exception("Parâmetro whereType inválido. Use '=' ou 'like'");
                    $e->getTraceAsString();
            }
        }
    }
    
    
    
    
    
    
}

?>