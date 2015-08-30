<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Autoload {

    public $helpers;
    public $libraries;
    public $models;
    
    public function __construct() {
        $this->load = get_instance()->load;
        $autoload = NULL;
        $file = CONFIG_PATH . 'autoload.php';
        
        if (file_exists($file)) {
            require_once $file;
        }
        
        if (isset($autoload['helpers'])) {
            $this->helpers = $autoload['helpers'];
        }
        
        if (isset($autoload['libraries'])) {
            $this->libraries = $autoload['libraries'];
        }
        
        if (isset($autoload['models'])) {
            $this->models = $autoload['models'];
        }
        
        $this->load->helper($this->helpers);
        $this->load->library($this->libraries);
        $this->load->model($this->models);
    }

}
