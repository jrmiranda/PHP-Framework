<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Input {
    private $post = array();
    private $get = array();
    private $cookie = array();
    
    public function __construct() {
        $this->security = load('Security');
        
        if (isset($_POST)) {
            foreach ($_POST as $name => $value) {
                $post[$name] = $this->security->input($value);
            }
        }
        
        if (isset($_GET)) {
            foreach ($_GET as $name => $value) {
                $get[$name] = $this->security->input($value);
            }
        }
    }
    
    public function post($index = NULL) {
        if ($index == NULL) {
            return $post;
        } else {
            if (isset($post[$index])) {
                return $post[$index];
            }
        }
        return false;
    }
    
    public function get($index = NULL) {
        if ($index == NULL) {
            return $get;
        } else {
            if (isset($get[$index])) {
                return $get[$index];
            }
        }
        return false;
    }

}
