<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Language {
    
    public $lang;
    public $text = array();
    
    public function __construct() {
        $this->c = get_instance();
        
        if (DEFAULT_LANG == 'auto') {
            $this->load(DEFAULT_LANG);
        }
         
    }
    
    public function load($lang) {
        $file = APP_PATH . 'language' . DS . $lang . '.php';
        $text = array();
        
        if (file_exists($file)) {
            require_once $file;
        } else {
            error('no_file', $lang . '.php', 'Lang');
            return false;
        }
        
        $this->text = $text;
        $this->c->text = $this->text;
        $this->c->view->text = $this->text;
    }
    
    public function browser() {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        
        echo strtolower($lang);
    }

}
