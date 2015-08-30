<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Model {
    private static $instance;
    
    public function __construct() {
        
    }
    
    public static function get_instance() {
        if (!is_object(self::$instance)) {
            self::$instance = new Model();
        }
        return self::$instance;
    }
    
    public function main_model() {
        echo "main model<br>";
    }

}
