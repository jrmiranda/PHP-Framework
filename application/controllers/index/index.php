<?php

/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class index_controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index_action() {
        if ($this->user->logged()) {
            pre($this->user->data());
        }
        $this->view->load('index');
    }

    public function test_action() {
        $this->load->library('form');
        $this->load->library('upload');

        $this->form->rule('teste', '(all){4,8}');
        $this->form->rule('teste2', '(*)', 'unique[users.username]');

        $this->form->set_message('teste', array(
            'not_match' => 'Preencha corretamente'
        ));
        $this->form->set_message('teste2', array(
            'not_match' => 'ooops!',
            'not_unique' => 'nooot unique'
        ));

        $config = array(
            'path' => 'resources/uploads/images',
            'types' => 'jpg,gif',
            'max_size' => 1000,
            'max_width' => 1024,
            'max_height' => 768
        );
        /* if ($this->upload->run($config)) {

          } */

        $this->view->success = 0;

        if ($this->form->sent()) {
            if ($this->form->validate()) {
                $this->view->success = 1;
            } else {
                $this->view->messages = $this->form->messages();
            }
        }

        $this->view->load('index');
    }

    public function upload_action() {
        $this->load->library('upload');

        if ($this->upload->sent()) {
            if ($this->upload->validate()) {
                $name = $this->upload->run();
                
                if ($name) {
                    echo $name;
                }
                $this->view->success = 1;
            } else {
                $this->view->messages = $this->upload->messages();
                pre($this->view->messages);
            }
        }
        
        $this->view->load('index');
    }
    
    public function image_action() {
        $this->load->library('image');
        
        if ($this->image->sent()) {
            if ($this->image->validate($config)) {
                $this->image->upload();
            }
        }
    }

}
