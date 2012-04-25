<?php

Class Helper {
    
    public static function converteDateTimeParaTexto($dateTime) {
        $dt = explode(" ", $dateTime);
        $date = $dt[0];
        $time = $dt[1];
        
        list($ano, $mes, $dia) = explode("-", $date);
        return "$dia/$mes/$ano às $time";
    }
    
    /**
     * Exibe uma mensagem e redireciona.
     * @param string $caminho Caminho para chegar at� o arquivo
     * @param string $msg Mensagem alert a ser exibida antes do redirecionamento
     */
    public static function redirect($caminho, $msg = null) {
          
        if($msg) {
            echo "
                <script>
                    alert('$msg');  
                    location.href = '$caminho';
                </script>
            ";
        } else {
            echo "
                <script>
                    location.href = '$caminho';
                </script>
            ";
        }
    }
    
    public static function alert($msg) {
        echo "
            <script>
                alert('$msg');
            </script>
        ";
    }
    
    public static function voltar() {
        echo "
            <script>
                history.go(-1);
            </script>
        ";
    }
    
    public static function close() {
        echo "
            <script>
                window.close();
            </script>
        ";
    }
}