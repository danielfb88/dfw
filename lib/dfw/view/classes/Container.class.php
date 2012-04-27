<?php

/**
 * DFW Framework PHP - Classe Container
 * 
 * SuperClasse para elementos conteiner do tipo Form e FieldSet
 * Data de Criação: 27 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
abstract class Container extends Element {

    protected $fields;

    /**
     * Monta tabela com os fields
     * @param string $class - Classe do elemento html
     * @return string 
     */
    protected function mountTable($class) {
        $qtdMaximaCols = 1; // Quantidade máxima de colunas

        $table = "<table class='" . $class . "'>";

        for ($i = 0; $i < count($this->fields); $i++) {
            $table .= "<tr>";

            if (is_array($this->fields[$i])) {

                // pegando a quantidade máxima de colunas
                if (count($this->fields[$i]) > $qtdMaximaCols)
                    $qtdMaximaCols = count($this->fields[$i]);

                for ($j = 0; $j < count($this->fields[$i]); $j++) {
                    $table .= "<td>";
                    $obj = $this->fields[$i][$j];
                    $table .= $obj->returnAsString();
                    $table .= "</td>";
                }
            } else {
                // não é um array, portanto tem apenas 1 coluna
                $table .= "<td colspan='" . $qtdMaximaCols . "'>";
                $obj = $this->fields[$i];
                $table .= $obj->returnAsString();
                $table .= "</td>";
            }

            $table .= "</tr>";
        }

        $table .= "</table>";

        return $table;
    }

}