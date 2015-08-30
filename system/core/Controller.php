<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Controller {

    private static $instance;
    public $model;
    public $view;
    public $module = NULL;
    
    public function __construct() {
        self::$instance = $this;
        
        foreach (loaded() as $name => $class) {
            $this->$name = load($class);
        }
        $this->view = load('View');
        
        $this->load = load('Loader', 'system/core', NULL, 1);
        $this->view->load = $this->load;
        
        if (USE_AUTOLOAD) {
            $this->autoload = load('Autoload', 'system/core', NULL, 0);
        }
        
        if (USE_LANG) {
            $this->lang = load('Language');
            $this->view->lang = $this->lang;
        }
    }
    
    public static function get_instance() {
        return self::$instance;
    }

}
