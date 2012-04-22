<?php
/**
 * DFW Framework PHP - Classe DAO
 * 
 * Classe que abstrai as operaçoes mais básicas entre a aplicação e o banco de dados.
 * Data de Criação: 31 de Março de 2012
 * 
 * 18 de Abril de 2012
 *      - Adicionado parâmetro orderBy ao método getAll
 * 20 de Abril de 2012
 *      - Excluído o método 'save' e adicionado os métodos 'insert' e 'update'
 *      - Adicionado a propriedade ao array $confgProps 'is_autoIncrement'
 *      - Adicionado os métodos: getMaxCount() e getNextId()
 * 21 de Abril de 2012
 *      - Adicionado o método getNextAutoIncrementId()
 *      - Modificado verificação de tabela inexistente para o construtor
 *      - Deletado o metodo privado checkFieldPrimaryKey e adicionado verificação da existência da 
 *          primary key no construtor
 *      - Criado método abstrato config() para ser sobrescrito pela subclasse
 *      - Modificado os métodos connect() e disconnect() para usar a instância de Conexão criada no construtor
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * @abstract
 * 
 */

require_once 'Conexao.class.php';

abstract class DAO { 
    /**
     * Nome da subclasse.
     * @var string 
     */
    private $className;
    /**
     * Nome da classe do DTO que será usada para guardar os dados. 
     * A subclasse deverá configurar esta propriedade.
     * @var type 
     */
    protected $dtoClassName;
    /**
     * Nome da tabela. 
     * A subclasse deverá configurar esta propriedade.
     * @var string 
     */
    protected $tableName;
    /**
     * Configurações das propriedades
     * @var array 
     */
    protected $configProps = array(
        /**
         * Configurações da PrimaryKey 
         */
        'primaryKey' => array(
            /**
            * Chave Primária da Tabela.
            * Se existir apenas 1 chave primária, esta chave deve ser auto-increment. 
            * @example $this->configProps['primaryKey'] = array('id1', 'id2');
            */
            'field' => array(),
            /**
            * Especifica se a primaryKey é auto-increment.
            * @var boolean
            * @since 20-04-2012 
            */
            'is_autoIncrement' => false
            ),
        
        /**
         * Campos que são notNull. 
         * Essa validação será feita antes de enviar a requisição para o Banco de Dados. 
         * @example $this->configProps['notNull'] = array('numero', 'campo4');
         */
        'notNull'   => array()
    );
    /**
     * Classe Conexão que abstrai o relacionamento com um objeto PDO
     * @var Conexao 
     */
    private $con = null;
    /**
     * Informa se o registro foi encontrado no banco de dados
     * @var boolean 
     */
    protected $found = false;
    /**
     * Atributos da da subClasse com os valores inseridos pelo usuário.
     * Será usado para efetuar para os métodos de busca e/ou persistencia.
     * @var array 
     */
    private $properties;
    /**
     * Ultima query executada.
     * @var string 
     */
    private $lastQuery = null;
        
    protected function __construct() {
        $reflect = new ReflectionClass($this);        
        $this->className = $reflect->getName();
        
        // Recebendo as configuraçõe da subclasse
        $this->config();
        
        ## Excessão para TABELA INEXISTENTE ##
        if(empty($this->tableName)) {
            throw $e = new Exception('Não há uma tabela definida na subclasse '.$this->className);
            $e->getTraceAsString();
        }
        
        ## Excessão para CAMPO DA PRIMARY KEY INEXISTENTE ##
        if(!$this->configProps['primaryKey']['field']) {
            throw $e = new Exception('Não há primary key definida na subclasse '.$this->className);
            $e->getTraceAsString();
        }
        
        // Inserindo as propriedades da subclasse em um array (pegando apenas atributos publicos)
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        
        $this->properties = array();
        foreach ($properties as $prop) {
            if($prop->class != 'DAO') {     // pegando apenas propriedades da subclasse
                $property = $prop->name;
                $this->properties[$property] = null;
            }
        }
        
        ## Excessão para PROPRIEDADES INEXISTENTE ##
        if(!$this->properties) {
            throw $e = new Exception('Os campos da tabela não foram definidos na subclasse.');
            $e->getTraceAsString();
        } 
        
        // Criando objeto para a Conexão
        $this->con = new Conexao();
    }
    
    /**
     * A subclasse deve sobrecarregar este método para setar as suas configurações
     */
    abstract protected function config();
    
    /**
     * Conecta ao DB
     */
    protected function connect() {
        $this->con->connect();
    }
    
    /**
     * Desconecta do DB
     */
    protected function disconnect() {
        $this->con->disconnect();
    }
         
    /**
     * Atualiza a variável $this->properties com os valores que o usuario inserir
     * 
     * @return array 
     */
    private function refreshPropertiesValues() {
        foreach ($this->properties as $key => $value) {
            $this->properties[$key] = $this->$key;
        }
    }
    
    /**
     * Retorna array com as propriedades e os valores inseridos pelo usuário para efetuar a filtragem.
     * 
     * @return array - Valores para serem usados na filtragem
     */
    private function getFilterValues() {
        // atualiza os valores
        $this->refreshPropertiesValues();
        
        $filterValues = array();    // valores inseridos na subclasse
        foreach($this->properties as $key => $value) {
            // criando um array apenas com os dados que tiverem valor
            if($value !== null && $value !== '') $filterValues[$key] = $value;            
        }
        return $filterValues;
    }
        
    /**
     * Gera sql de Select From Where
     * 
     * @param array $filterValues - Valores a serem usados para filtragem
     * @param char $whereType - Tipo de pesquisa where. ex: $whereType = "="; ou $whereType = "like";
     * @param string $orderBy - Campo da ordenação
     * @param boolean $useBindValue - true para usar bindValue nos filtros
     * @return string SQL montada.
     * @throws Exception 
     */
    private function select(array $filterValues, $whereType, $orderBy = null, $useBindValue = false) {
        if($whereType != '=' && $whereType != 'like') {
            throw $e = new Exception('Parâmetro whereType inválido. Use \'=\' ou \'like\'');
            $e->getTraceAsString();
        }
        
        // Verifica se o orderBy informado existe
        if($orderBy && is_string($orderBy)) {
            $orderByFound = false;
            foreach($this->properties as $key => $value) {
                if($key == $orderBy) {
                    $orderByFound = true;
                    break;
                }            
            }
            if(!$orderByFound) {
                throw $e = new Exception("O parâmetro orderBy informado não existe");
                $e->getTraceAsString();
            }
        }
        
        
        $i = 0;
        $sql = 'SELECT ';   
        foreach($this->properties as $key => $value) {
            if($i++ == count($this->properties)-1) {
                $sql .= $key.' ';  // ultimo campo nao deve ter virgula
            } else {
                $sql .= $key.', ';
            }
        }
                
        $sql .= ' FROM ';
        $sql .= $this->tableName.' ';
        
        if($filterValues && is_array($filterValues)) {
            $i = 0;
            $sql .= ' WHERE ';        
            foreach($filterValues as $key => $value) {
                
                if($i++ == count($filterValues)-1) {
                    
                    switch ($whereType) {
                        case '=':
                            
                            if($useBindValue)
                                $sql .= ' '.$key.' = :'.$key.' ';
                            else
                                $sql .= ' '.$key.' = \''.$value.'\' ';
                            
                            break;
                        case 'like':
                            
                            if($useBindValue)
                                $sql .= 'upper(cast('.$key.' as varchar)) like upper(cast(:'.$key.' as varchar)) ';
                            else
                                $sql .= 'upper(cast('.$key.' as varchar)) like upper(cast(\'%'.$value.'%\' as varchar)) ';
                            
                            break;
                    }
                        
                } else {  
                    switch ($whereType) {
                        case '=':
                            
                            if($useBindValue)
                                $sql .= ' '.$key.' = :'.$key.' AND ';
                            else
                                $sql .= ' '.$key.' = \''.$value.'\' AND ';
                            
                            break;
                        case 'like':
                            
                            if($useBindValue)
                                $sql .= 'upper(cast('.$key.' as varchar)) like upper(cast(:'.$key.' as varchar)) AND ';
                            else
                                $sql .= 'upper(cast('.$key.' as varchar)) like upper(cast(\'%'.$value.'%\' as varchar)) AND ';
                            
                            break;
                    }
                }
            }
        }
        
        if($orderBy && is_string($orderBy))
            $sql .= ' ORDER BY '.$orderBy.' ';
        
        $this->lastQuery = $sql;
        
        return $sql;
    }
    
    /**
     * Gera sql de INSERT
     * 
     * @param array $insertValues Valores inseridos nas propriedades
     * @param type $useBindValue true para usar bindValue nos filtros
     * @return string
     * @throws type 
     */
    private function insertSQL(array $insertValues, $useBindValue = false) {
        // insert values inválido
        if(!$insertValues && !is_array($insertValues)) {
            throw $e = new Exception('Parâmetro passado para insert inválido.');
            $e->getTraceAsString();
        }
        
        $i = 0;
        $sql = 'INSERT INTO '.$this->tableName.' (';   
        foreach($insertValues as $key => $value) {
            if($i++ == count($insertValues)-1) {
                $sql .= $key.' ';  // ultimo campo nao deve ter virgula
            } else {
                $sql .= $key.', ';
            }
        }
                
        $sql .= ' ) VALUES ( ';
        
        $i = 0;
        foreach($insertValues as $key => $value) {
            if($i++ == count($insertValues)-1) {
                if($useBindValue)
                    $sql .= ':'.$key.' ';  // ultimo campo nao deve ter virgula
                else
                    $sql .= '\''.$value.'\' ';
                
            } else {
                if($useBindValue)
                    $sql .= ':'.$key.', ';
                else
                    $sql .= '\''.$value.'\', ';
            }
        }
        
        $sql .= ')';
        
        return $sql;
    }
    
    /**
     * Gerar sql de UPDATE
     * 
     * @param array $updateValues
     * @param boolean $useBindValue
     * @return string $sql SQL Gerada.
     * @throws type 
     */
    private function updateSQL(array $updateValues, $useBindValue = false) {
        // update values inválido
        if(!$updateValues && !is_array($updateValues)) {
            throw $e = new Exception('Parâmetro passado para update inválido.');
            $e->getTraceAsString();
        } 
                
        // o valor da primaryKey nao foi informado
        if(!$this->checkValuePrimaryKeyExists())
            throw $e = new Exception('O valor da primarykey não foi informado');
                
        // colocando null nos campos que nao chegarem com um valor definido
        foreach($updateValues as $key => &$value) {            
            if($value === null || $value === '') $value = 'null';
        }
                
        $i = 0;
        $sql = 'UPDATE '.$this->tableName.' SET ';   
        foreach($updateValues as $key => &$value) {          
            if($i++ == count($updateValues)-1) {
                // tirando as aspas de value para nao inserir 'null' na tabela
                if($value === 'null') {
                    $sql .= $key.' = '.$value.' '; 
                }                    
                elseif($useBindValue)
                    $sql .= $key.' = :'.$key.' ';
                else
                    $sql .= $key.' = \''.$value.'\' ';  // ultimo campo nao deve ter virgula

            } else {
                // tirando as aspas de value para nao inserir 'null' na tabela
                if($value === 'null') {
                    $sql .= $key.' = '.$value.', ';
                } 
                elseif($useBindValue)
                    $sql .= $key.' = :'.$key.', ';
                else
                    $sql .= $key.' = \''.$value.'\', ';
            }            
        }
                
        $sql .= ' WHERE '; 
        
        // contando a(s) primary key(s)
        $i = 0;
        foreach($this->configProps['primaryKey']['field'] as $primaryKey) {
            if($i++ == count($this->configProps['primaryKey']['field'])-1) {
                // ultima posição sem virgula
                if($useBindValue)
                    $sql .= $primaryKey.' = :'.$primaryKey.' ';
                else
                    // pega o valor real do campo
                    $sql .= $primaryKey.' = \''.$updateValues[$primaryKey].'\' ';
                
            } else {
                // com virgula
                if($useBindValue)
                    $sql .= $primaryKey.' = :'.$primaryKey.' AND ';
                else
                    // pega o valor real do campo                 
                    $sql .= $primaryKey.' = \''.$updateValues[$primaryKey].'\' AND ';                    
                
            }
        }
        
        return $sql;
    }
       
    /**
     * Verifica se as primarykeys definidas na subclasse possuem valor preenchido.
     * 
     * @param array $properties
     * @return boolean 
     */
    private function checkValuePrimaryKeyExists() {
        $this->refreshPropertiesValues();
        
        foreach($this->configProps['primaryKey']['field'] as $primaryKey) {
            /*
            * Retorna false se houver primary key sem valor
            */
            if($this->properties[$primaryKey] === null || $this->properties[$primaryKey] === '') {
                return false;
            }
        }
            
        return true;
        
    }
        
    /**
     * Retorna os dados no próprio objeto DAO pelos valores informados pelo usuário.
     * Este método retorna apenas um registro.
     * O método read() usa o tipo de pesquisa where "=".
     * 
     * @param boolean $useBindValue - true para usar bindValue nos filtros
     * @return boolean - Se a ação foi efetuada com sucesso
     * @throws type 
     */
    public function read($useBindValue = true) {
        $filterValues = $this->getFilterValues();
        
        // os valores para filtragem nao foram informados
        if(!$filterValues) {              
            throw $e = new Exception('Nenhum filtro foi especificado para o read()');
            $e->getTraceAsString();                        
        }
        
        $sql = $this->select($filterValues, '=', null, $useBindValue);            
        $sql .= ' LIMIT 1;';

        try {
            
            $this->connect();   
            $preparedStatment = $this->con->getPreparedStatment($sql);
            
            if($useBindValue)
                $this->con->bindValue($preparedStatment, $filterValues, '='); 
            
            if(!$retornoOk = $preparedStatment->execute()) {
                $this->informaErro($preparedStatment->errorInfo());
                
            } else {
                $registro = $preparedStatment->fetch(PDO::FETCH_ASSOC);
            
                if($registro) {                    
                    // alimentando o objeto com os seus valores
                    foreach($registro as $key => $value) {
                        $this->$key = $value;
                    }                    
                    $this->found = true;
                    
                } else {
                    $this->found = false;
                }
            }
                        
            $this->disconnect();
                    
        } catch (PDOException $e1) {
            $e1->getMessage();
            $e1->getTraceAsString();
            
        } catch (Exception $e2) {
            $e2->getMessage();
            $e2->getTraceAsString();
        }
        
        unset($preparedStatment);
        unset($registro);
        return $retornoOk;
    }
    
    /**
     * Retorna todos os registros que atendam aos filtros definidos pelo usuário em um objeto DTO.
     * Caso o objeto DTO não tenha sido definido na subclasse, retorna um array associativo.
     * Este método utiliza o tipo de pesquisa where "like"
     * 
     * @param string $orderBy - Campo da ordenação
     * @param type $useBindValue
     * @return DTO|array
     * @throws type 
     */
    public function getAll($orderBy = null, $useBindValue = true) {
        $filterValues = $this->getFilterValues();

        $sql = $this->select($filterValues, 'like', $orderBy, $useBindValue);

        try {
            
            $this->connect();   
            $preparedStatment = $this->con->getPreparedStatment($sql);
            
            if($useBindValue)
                $this->con->bindValue($preparedStatment, $filterValues, 'like'); 
            
            if(!$retornoOk = $preparedStatment->execute()) {
                $this->informaErro($preparedStatment->errorInfo());
                
            } else {

                // se foi definido um DTO na subclasse, preencha-o com os registros
                if($this->dtoClassName) {
                    // recupera os registros e insere cada um no dto especificado na sub-classe retornando um array desses objetos
                    $arr = $preparedStatment->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->dtoClassName);
                } else {    
                    // apenas retorne o array associativo
                    $arr = $preparedStatment->fetchAll(PDO::FETCH_ASSOC);
                }

                if($arr) {                                
                    $this->found = true;
                    
                } else {
                    $this->found = false;
                }
            }
                        
            $this->disconnect();
                    
        } catch (PDOException $e1) {
            $e1->getMessage();
            $e1->getTraceAsString();
            
        } catch (Exception $e2) {
            $e2->getMessage();
            $e2->getTraceAsString();
        }
        
        unset($preparedStatment);
        return $arr;
    }
    
    /**
     * Seta as propriedades da subClasse como null para prepara-la para uma nova consulta
     */
    public function reset() {
        foreach($this->properties as $key => $value) {
            $this->$key = null;
            $this->properties[$key] = null;
        }
        $this->found = false;
    }
    
    /**
     * Sugere um valor para Id usando o total de registros + 1
     * Este método deve ser usando quando existir apenas 1 campo numérico para a primary key.
     *      1 - É recomendado usar este método quando 'is_autoIncrement' for FALSE.
     * @since 20-04-2012
     * @return int 
     */
    public function getNextId() {
        return $this->getMaxCount()+1;
    }
    
    /**
     * ## APENAS PARA POSTGRES ##
     * Antecipa qual valor será usado pela sequência para compor a primary key.
     *      1 - Este método deve ser usado quando existir apenas 1 campo numérico para a primary key.
     *      2 - Este método deve ser usado quando quando 'is_autoIncrement' for TRUE
     * @since 21-04-2012
     * @return int
     */
    public function getNextAutoIncrementId() {
        $sql = 'SELECT nextval(\''.$this->tableName.'_'.$this->configProps['primaryKey']['field'][0].'_seq\');';
        
        try {
            
            $this->connect();   
            $preparedStatment = $this->con->getPreparedStatment($sql);
            
            if(!$retornoOk = $preparedStatment->execute()) {
                $this->informaErro($preparedStatment->errorInfo());
                
            } else {
                $nextVal = $preparedStatment->fetch(PDO::FETCH_ASSOC);
                $nextVal = $nextVal['nextval'];
            }
                     
            $this->disconnect();
                    
        } catch (PDOException $e1) {
            $e1->getMessage();
            $e1->getTraceAsString();
            
        } catch (Exception $e2) {
            $e2->getMessage();
            $e2->getTraceAsString();
        }
        
        unset($preparedStatment);
        return $nextVal;
        
    }
    
    /**
     * Recupera a quantidade total de registros existentes na tabela
     * @since 20-04-2012
     * @return int 
     */
    protected function getMaxCount() {
        $sql = 'SELECT count(*) as total_registros FROM '.$this->tableName;
        
        try {
            
            $this->connect();   
            $preparedStatment = $this->con->getPreparedStatment($sql);
            
            if(!$retornoOk = $preparedStatment->execute()) {
                $this->informaErro($preparedStatment->errorInfo());
                
            } else {
                $total_registros = $preparedStatment->fetch(PDO::FETCH_ASSOC);
                $total_registros = $total_registros['total_registros'];
            }
                     
            $this->disconnect();
                    
        } catch (PDOException $e1) {
            $e1->getMessage();
            $e1->getTraceAsString();
            
        } catch (Exception $e2) {
            $e2->getMessage();
            $e2->getTraceAsString();
        }
        
        unset($preparedStatment);
        return $total_registros;
    }
    
    /**
     * Salva os dados que foram inseridos nas variaveis da subClasse ($this->properties).
     * @since 19-04-2012
     * @param boolean $useBindValue Vinculação das variáveis de filtragem
     * @return boolean
     * @throws type 
     */
    public function insert($useBindValue = true) {        
          ## Excessão de NotNull ##
         // Verifica se os valores definidos como notNull foram preenchidos         
        if(!$this->checkValuesNotNullFieldsExists()) {
            $fields = '';
            foreach($this->configProps['notNull'] as $notNullField) {
                $fields .= ' \''.$notNullField.'\' ';
            }
            throw $e = new Exception('Alguns dos campos '.$fields.' definidos como NotNull estão vazios.');
            $e->getTraceAsString();
        }
        
        // se não for auto incremento
        if(!$this->configProps['primaryKey']['is_autoIncrement']) {
            // Se o valor da PrimaryKey nao tiver sido definido
            if(!$this->checkValuePrimaryKeyExists()) {
                ## Excessão de Primary Key sem valor ##
                throw $e = new Exception('O valor da primarykey não foi informado');
                $e->getTraceAsString();
            }
        }
        
        $filterValues = $this->getFilterValues();
        $sql = $this->insertSQL($filterValues, $useBindValue);
                
        try {
            
            $this->connect();
            $preparedStatment = $this->con->getPreparedStatment($sql);
            
            if($useBindValue)
                $this->con->bindValue($preparedStatment, $filterValues, '='); 
            
            // guardando a query
            $this->lastQuery = $sql;
            
            if(!$retornoOk = $preparedStatment->execute()) {
                $this->informaErro($preparedStatment->errorInfo());                
            }
                        
            $this->disconnect();
                    
        } catch (PDOException $e1) {
            $e1->getMessage();
            $e1->getTraceAsString();
            
        } catch (Exception $e2) {
            $e2->getMessage();
            $e2->getTraceAsString();
        }
        
        unset($preparedStatment);
        return $retornoOk;
    }
    
    /**
     * Atualiza os dados que foram inseridos nas variaveis da subClasse ($this->properties).
     * @since 19-04-2012
     * @param boolean $useBindValue Vinculação das variáveis de filtragem
     * @return string
     * @throws type 
     */
    public function update($useBindValue = true) {
        ## Excessão de NotNull ##
        // Verifica se os valores definidos como notNull foram preenchidos        
        if(!$this->checkValuesNotNullFieldsExists()) {
            $fields = '';
            foreach($this->configProps['notNull'] as $notNullField) {
                $fields .= ' \''.$notNullField.'\' ';
            }
            throw $e = new Exception('Alguns dos campos '.$fields.' definidos como NotNull estão vazios.');
            $e->getTraceAsString();
        }
        
        // Se o valor da PrimaryKey tiver sido definido
        if($this->checkValuePrimaryKeyExists()) {
            $filterValues = $this->getFilterValues();
            $sql = $this->updateSQL($filterValues, $useBindValue);
            
        } else {
            ## Excessão de Primary Key sem valor ##
            throw $e = new Exception('O valor da primarykey não foi informado');
            $e->getTraceAsString();
        }
        
        try {
            
            $this->connect();
            $preparedStatment = $this->con->getPreparedStatment($sql);
            
            if($useBindValue)
                $this->con->bindValue($preparedStatment, $filterValues, '='); 
            
            // guardando a query
            $this->lastQuery = $sql;
            
            if(!$retornoOk = $preparedStatment->execute()) {
                $this->informaErro($preparedStatment->errorInfo());                
            }
                        
            $this->disconnect();
                    
        } catch (PDOException $e1) {
            $e1->getMessage();
            $e1->getTraceAsString();
            
        } catch (Exception $e2) {
            $e2->getMessage();
            $e2->getTraceAsString();
        }
        
        unset($preparedStatment);
        return $retornoOk;
    }
    
    /**
     * Deleta o registro. É obrigatório que o valor da primary key tenha sido inserido.
     * @param type $useBindValue
     * @return type
     * @throws type 
     */
    public function delete($useBindValue = true) {        
        // Tem que ter o valor da primaryKey para poder excluir.
        if(!$this->checkValuePrimaryKeyExists()) {
            throw $e = new Exception('O valor da primarykey não foi informado');
            $e->getTraceAsString();
        }
                
        $sql = 'DELETE FROM '.$this->tableName.' ';
        $sql .= ' WHERE ';
        
        $i = 0;
        $arrPk = array();
        foreach($this->configProps['primaryKey']['field'] as $primaryKey) {
            if($i++ == count($this->configProps['primaryKey']['field'])-1) { // sem virgula
                if($useBindValue)
                    $sql .= $primaryKey.' = :'.$primaryKey.' ';
                else
                    $sql .= $primaryKey.' = '.$this->$primaryKey.' ';
                
            } else {        // com virgula
                if($useBindValue)
                    $sql .= $primaryKey.' = :'.$primaryKey.', ';
                else
                    $sql .= $primaryKey.' = '.$this->$primaryKey.', ';
            }
            /*
             * Array com as primarykey e seus valores
             */
            $arrPk[$primaryKey] = $this->$primaryKey;
        }
                
        try {
            
            $this->connect();
            $preparedStatment = $this->con->getPreparedStatment($sql);
            
            if($useBindValue)
                $this->con->bindValue($preparedStatment, $arrPk, '='); 
            
            // guardando a query
            $this->lastQuery = $sql;
            if(!$retornoOk = $preparedStatment->execute()) {
                $this->informaErro($preparedStatment->errorInfo());                
            }
                        
            $this->disconnect();
                    
        } catch (PDOException $e1) {
            $e1->getMessage();
            $e1->getTraceAsString();
            
        } catch (Exception $e2) {
            $e2->getMessage();
            $e2->getTraceAsString();
        }
        
        unset($preparedStatment);
        return $retornoOk;        
    }

    /**
     * Verifica se os campos definidos como notNull na subclasse possuem valores.
     */
    private function checkValuesNotNullFieldsExists() {
        $this->refreshPropertiesValues();
        
        if($this->configProps['notNull']) {
            foreach($this->configProps['notNull'] as $notNullField) {
                if($this->properties[$notNullField] === null)
                    return false;
            }
        }
        
        return true;        
    }
    
    /**
     * Executa uma query livre
     * @param string $sql
     * @param boolean $returnValues true se for um select, false para insert update delete
     * @return boolean|array retorna um boolean caso $returnValues seja false. Retorna um array caso seja true 
     */
    public function executeQuery($sql, $returnValues = false) {
        try {            
            $this->connect();   
            $preparedStatment = $this->con->getPreparedStatment($sql);

            // guardando a query
            $this->lastQuery = $sql;
            if(!$retornoOk = $preparedStatment->execute()) {
                $this->informaErro($preparedStatment->errorInfo());
                
            } else {
                if($returnValues)
                    $arr = $preparedStatment->fetchAll(PDO::FETCH_ASSOC);

            }
                        
            $this->disconnect();
                    
        } catch (PDOException $e1) {
            $e1->getMessage();
            $e1->getTraceAsString();
            
        } catch (Exception $e2) {
            $e2->getMessage();
            $e2->getTraceAsString();
        }
        
        unset($preparedStatment);
        
        if($returnValues)
            return $arr;
        else
            return $retornoOk;
    }
    
    /**
     * Recebe array com os valores e os insere no objeto DAO.
     * @param array $data 
     */
    public function setData(array $data) {        
        if($data && is_array($data)) {
            $this->refreshPropertiesValues();
            
            foreach($data as $key => $value) {
                if(array_key_exists($key, $this->properties))
                    $this->$key = $value;
            }
        }
    }
    
    /**
     * Personaliza a mensagem de erro para debug
     * 
     * @param string|array $err 
     */
    private function informaErro($err) {
        echo '<br/><br/><b>SQL ERROR:</b><br/>';
        
        if(is_array($err))
            print_r($err);
        else
            echo $err;
        
        echo '<br/><br/>';
    }
    
    /**
     * Retorna a ultima query
     * @return string 
     */
    public function getLastQueryAsString() {
        return $this->lastQuery;
    }
    
}