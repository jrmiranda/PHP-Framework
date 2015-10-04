<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class lol_controller extends main_controller {

    public function index_action() {
        //echo "ok";
    }
    
    public function testando() {
        echo $this->router->request();
    }
    
}
