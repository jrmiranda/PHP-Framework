<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Security {

    public $not_allowed_uri = array(
        ''
    );
    public $not_allowed_input = array(
        ''
    );

    public function uri($uri) {
        //echo filter_var($uri, FILTER_SANITIZE_URL);
        return $uri;
    }

    public function input($input) {
        return htmlspecialchars($input, ENT_QUOTES, 'utf-8');
    }

}
