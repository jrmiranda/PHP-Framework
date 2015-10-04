<?php

/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class index_controller extends Controller {

    public function index_action() {
        $this->view->links = $this->model->select('links');
        $this->view->load('links/page');
    }
    
    public function get_action() {
        $this->load->library('form');
        $this->form->rule('link', ':all');
        
        if ($this->form->sent()) {
            header('Content-Type: application/json');
            
            echo json_encode($this->get($this->input->post('link')));
        }
    }
    
    public function test_action() {
        $url = 'http://www.naointendo.com.br/';
        pre($this->get($url));
    }
    
    public function post_action() {
        $this->load->library('form');
        
        $this->form->rule('url', '.+');
        $this->form->rule('title', '.+');
        $this->form->rule('img', '.+');
        $this->form->rule('description', '.+');
        
        if ($this->form->sent()) {
            if ($this->form->validate()) {
                if ($this->model->insert('links', $this->form->inputs())) {
                    go();
                }
            } else {
                pre($this->form->messages());
            }
        }
    }
    
    public function get($url) {
        /*$curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;*/
        
        $page_headers = @get_headers($url);
        if ($page_headers[0] == 'HTTP/1.1 404 Not Found') {
            return array('success' => false);
        }
        
        $page = file_get_contents($url);

        $dom = new DOMDocument;
        @$dom->loadHTML($page);

        $metas = $dom->getElementsByTagName('meta');

        $data = array(
            'title' => '',
            'description' => '',
            'image' => '',
            'success' => true
        );

        foreach ($metas as $meta) {
            if ($meta->getAttribute('property') == 'title' || $meta->getAttribute('property') == 'og:title' || $meta->getAttribute('name') == 'twitter:title') {
                $data['title'] = $meta->getAttribute('content');
            }

            if ($meta->getAttribute('property') == 'description' || $meta->getAttribute('property') == 'og:description' || $meta->getAttribute('name') == 'twitter:description') {
                $data['description'] = $meta->getAttribute('content');
            }

            if ($meta->getAttribute('property') == 'og:image' || $meta->getAttribute('name') == 'twitter:image:src') {
                $data['image'] = $meta->getAttribute('content');
            }
        }
        
        if ($data['title'] == '' && $data['description'] == '' && $data['image'] == '') {
            return array('success' => false);
        }
        
        return $data;
    }

}
