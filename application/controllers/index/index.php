<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class index_controller extends main_controller {

    public function index_action() {
        $this->view->load('index');
    }

}
