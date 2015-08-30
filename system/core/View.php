<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class View {
        
    public function load($view, $inc = 1) {
        if (is_array($view)) {
            foreach ($view as $single) {
                $this->load_view($single, $inc);
            }
        } else {
            $this->load_view($view, $inc);
        }
    }
    
    public function load_view($view, $inc) {
        $file = VIEWS_PATH . str_replace('/', DS, $view) . '.php';
        
        if ($inc && file_exists(VIEWS_PATH . 'header.php')) {
            require_once VIEWS_PATH . 'header.php';
        }
        
        if (file_exists($file)) {
            require_once $file;
        }
        
        if ($inc && file_exists(VIEWS_PATH . 'footer.php')) {
            require_once VIEWS_PATH . 'footer.php';
        }
    }

}
