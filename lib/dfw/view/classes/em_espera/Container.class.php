<?php

/**
 * SuperClasse para elementos conteiner do tipo Form e FieldSet
 * Data de Criação: 27 de Abril de 2012
 * 
 * @author      Daniel Bonfim <daniel.fb88@gmail.com>
 * @version     1.0
 * 
 */
require_once 'CompositeElement_Interface.php';

abstract class Container extends Element {

    protected $fields;
    protected $align;

    /**
     * Monta tabela com quelquer coisa que seja inserida dentro dele
     * @param string $class - Classe do elemento html
     * @return string 
     */
    protected function mountFieldTable() {
        $qtdMaximaCols = 1; // Quantidade máxima de colunas
        //$table = "<table class='" . $this->id."_".$class . "'>";
        $table = "<table class='" . $this->id . "_table_fields'";
        if (!empty($this->align)) 
            $table .= " align='" . $this->align . "' ";
        
        $table .= ">";

        for ($i = 0; $i < count($this->fields); $i++) {
            $table .= "<tr>";

            if (is_array($this->fields[$i])) {
                // comparando a quantidade máxima de colunas para inserir no colspan das linhas que 
                // só possuírem uma coluna
                if (count($this->fields[$i]) > $qtdMaximaCols)
                    $qtdMaximaCols = count($this->fields[$i]);

                for ($j = 0; $j < count($this->fields[$i]); $j++) {
                    $table .= "<td>";
                    if ($this->fields[$i][$j] instanceof HtmlElement_Interface) {
                        $obj = $this->fields[$i][$j];
                        $table .= $obj->returnAsString();
                    } else {
                        throw $e = new Exception("Objeto inválido");
                        $e->getTraceAsString();
                    }
                    $table .= "</td>";
                }
            } else {
                ## Elementos Compostos ##
                if ($this->fields[$i] instanceof CompositeElement_Interface) {
                    // é um Componente Composto, portanto DENTRO DELE pode possuir mais de 1 elemento encapsulado
                    $obj = $this->fields[$i];
                    $arrObjInside = $obj->getElements();

                    // colocando cada elemento dentro de uma coluna na tabela
                    foreach ($arrObjInside as $objInside) {
                        if ($objInside instanceof Label) {
                            $table .= "<td align='right'>";
                            $table .= $objInside->returnAsString();
                            $table .= "</td>";
                        } else {
                            $table .= "<td align='left'>";
                            $table .= $objInside->returnAsString();
                            $table .= "</td>";
                        }
                    }
                    ## Elementos Comuns ##
                } elseif ($this->fields[$i] instanceof HtmlElement_Interface) {
                    // não é um array, portanto tem apenas 1 coluna
                    $table .= "<td colspan='" . $qtdMaximaCols . "'>";
                    $obj = $this->fields[$i];
                    $table .= $obj->returnAsString();
                    $table .= "</td>";
                } else {
                    throw $e = new Exception("Objeto não identificado");
                    $e->getTraceAsString();
                }
            }
            $table .= "</tr>";
        }
        $table .= "</table>";

        return $table;
    }

}