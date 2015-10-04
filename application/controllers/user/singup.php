<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class singup_controller extends Controller {

    public function index_action() {
        $this->load->library('form');
        $this->view->success = 0;
        
        $this->form->rule('user', '(all){4,}', 'unique[users.username]');
        $this->form->rule('email', '(all){4,}', 'unique[users.email]');
        $this->form->rule('pass', '(*){6,}', 'md5');
        $this->form->rule('pass2', '(*){6,}');
        
        if ($this->form->sent()) {
            if ($this->form->validate()) {
                $inputs = $this->form->inputs();
                $user = array(
                    'username' => $inputs['user'],
                    'email' => $inputs['email'],
                    'password' => $inputs['pass'],
                    'level' => 0,
                    'banned' => 0
                );
                
                if ($this->model->insert('users', $user, 0)) {
                    $this->view->success = 1;
                } else {
                    $this->view->messages['general'] = 'Ocorreu um erro.';
                }
            } else {
                pre($this->form->messages());
                $this->view->messages = $this->form->messages();
            }
        }
        
        $this->view->load('user/singup');
    }

}
