<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Input {
    private $post = array();
    private $get = array();
    private $cookie = array();
    private $files = array();
    
    public function __construct() {
        $this->security = load('Security');
        
        if (isset($_POST)) {
            foreach ($_POST as $name => $value) {
                $this->post[$name] = $this->security->input($value);
            }
        }
        
        if (isset($_GET)) {
            foreach ($_GET as $name => $value) {
                $this->get[$name] = $this->security->input($value);
            }
        }
        
        if (isset($_FILES)) {
            foreach ($_FILES as $name => $value) {
                $this->files[$name] = $value;
            }
        }
    }
    
    public function post($index = NULL) {
        if ($index == NULL) {
            return $this->post;
        } else {
            if (isset($this->post[$index])) {
                return $this->post[$index];
            }
        }
        return false;
    }
    
    public function get($index = NULL) {
        if ($index == NULL) {
            return $this->get;
        } else {
            if (isset($this->get[$index])) {
                return $this->get[$index];
            }
        }
        return false;
    }
    
    public function files($index = NULL) {
        if ($index == NULL) {
            return $this->files;
        } else {
            if (isset($this->files[$index])) {
                return $this->files[$index];
            }
        }
        return false;
    }

}
