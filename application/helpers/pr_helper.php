<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('pr')) {
	 
    function pr($var = "", $label = "Teste Array - Objeto") {
        ?>
        <div>
            <?php
            $label = utf8_encode($label);
            echo "{$label}";
            if (!empty($var)) {
                echo ": <pre>";
                print_r($var);
                echo "</pre><br/>";
            }
            ?>
        </div>
        <?php
    }
}

if (!function_exists('pexit')) {

    function pexit($var, $label = "Teste Array - Objeto", $local = '') {
        $label = utf8_decode($label);
        $local = utf8_decode($local);

        pr($label, $var);
        echo '<hr />';
        exit($local);
    }
}

if (!function_exists('mask')) {

    function mask($val, $mask){
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){
            if($mask[$i] == '#'){
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }else{
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        
        return $maskared;
    }

}