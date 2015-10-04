<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class login_controller extends Controller {

    public function before() {
        echo '<style>html, body{ background-color: #222; color: #eee; font-family: arial; font-size: 13px; }</style>';
    }
    
    public function index_action() {
        if ($this->user->logged()) {
            go();
        }
        
        $this->load->library('form');
        
        $this->form->rule('user', ':all{4,}');
        $this->form->rule('pass', '.{6,}', 'md5');
        
        if ($this->form->sent()) {
            if ($this->form->validate()) {
                $user['username'] = $this->form->inputs()['user'];
                $user['password'] = $this->form->inputs()['pass'];
                
                if ($this->user->check($user)) {
                    $keep = 0;
                    if ($this->input->post('keep')) {
                        $keep = 1;
                    }
                    
                    $this->user->auth();
                    go();
                } else {
                    $this->view->messages['general'] = 'Usuário não encontrado.';
                }
            } else {
                $this->view->messages = $this->form->messages();
            }
        }
        
        $this->view->load('user/login');
    }
    
    public function logout_action() {
        $this->user->logout();
        go('login');
    }
    
    public function test_action() {
        if ($this->user->logged()) {
            pre($this->user->data());
        }
        
        if ($this->user->request_recovery($this->uri->segment(3))) {
            echo $this->uri->segment(3);
        }
    }
    
    public function recovery_action() {
        $hash = $this->uri->segment(3);
        
        if ($hash == '') {
            $this->user->request_recovery();
        }
        
        if ($this->user->check_recovery($hash)) {
            
        }
    }
    
}
