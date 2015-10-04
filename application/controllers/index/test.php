<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class test_controller extends Controller {

    public function index_action() {
        $this->model->main_model();
        $this->load->module('test/lol');
    }
    
}
