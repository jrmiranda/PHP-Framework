<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class recovery_controller extends Controller {

    public function index_action() {
        if ($this->user->logged()) {
            go();
        }
        
        $this->load->library('form');
        
        $this->form->rule('email', ':all');
        
        if ($this->form->sent()) {
            $this->view->success = false;
            
            if ($this->form->validate()) {
                if ($this->user->request_recovery($this->form->inputs()['email'])) {
                    $this->view->success = true;
                } else {
                    $this->view->messages['general'] = 'O e-mail informado não está cadastrado.';
                }
            } else {
                $this->view->messages = $this->form->messages();
            }
        }
        
        $this->view->load('user/recovery');
    }
    
    public function code_action() {
        $code = $this->uri->segment(2);
        $user = $this->user->check_recovery($code);
        
        if ($user) {
            pre($user);
        } else {
            echo "asd";
        }
    }
    
    public function test_action() {
        if ($this->user->level(0)) {
            echo "ok";
        }
    }

}
