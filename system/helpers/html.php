<?php

/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

function br($n = 1) {
    for ($i = 0; $i < $n; $i++) {
        echo '<br>';
    }
}

function meta($array) {
    foreach ($array as $key => $value) {
        echo '<meta name="' . $key . '" content="' . $value . '">';
    }
}
