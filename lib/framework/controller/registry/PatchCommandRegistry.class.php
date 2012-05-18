<?php
// TODO: Talvez essa classe deva ter outro nome. Estou implementando métodos que estou deixando-os vazios
// só para fazer parte da herança. Acho que ela tem que ser outra coisa. Não um Registry.

/**
 * Registry de Patchs Command.
 * Data de criação: 17 de Maio de 2012
 * 
 * @author Daniel Bonfim
 * @version 1.0 
 */
class PatchCommandRegistry extends Registry {

    /**
     * Commands
     * @var array 
     */
    private $commands = array();

    /**
     * Instância PatchCommandRegistry
     * @var PatchCommandRegistry 
     */
    private static $instance;

    private function __construct() {
        
    }

    /**
     * Singleton PatchCommandRegistry
     * @return PatchCommandRegistry
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get($commandName) {
        
    }

    protected function set($key, $value) {
        
    }

    /**
     * Retorna string do patch
     * @param string $key
     * @return mixed
     */
    public function getPatch($commandName) {
        if (isset($this->commands[$commandName])) {
            return $this->commands[$commandName];
        }
        return null;
    }

    /**
     * Insere array de Patchs
     * @param array Patchs
     */
    public function setPatchs(array $patchs) {
        $this->commands = $patchs;
    }

    /**
     * Verifica se os commands foram inicializados
     * @return type 
     */
    public function is_initialized() {
        return isset($this->commands);
    }

}