<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class URI {

    public $request;
    public $segments = array();

    public function __construct() {
        $this->security = load('Security');
        
        $this->request = isset($_GET['uri']) ?
                $this->security->uri(rtrim($_GET['uri'], '/'))
                : NULL;
        
        $this->segments = explode('/', $this->request);
    }
    
    public function request() {
        return $this->request;
    }
    
    public function segments() {
        return $this->segments;
    }
    
    public function segment($n, $default = false) {
        $segment = isset($this->segments[$n]) ? $this->segments[$n] : $default;
        return $segment;
    }

}
