<?php

/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class upload {

    private $error_count;
    private $error_messages = array();
    private $message = array();
    private $files = array();
    private $sent = 0;
    private $config = array(
        'path' => '',
        'types' => 'jpg,jpeg',
        'max_size' => 500000
    );

    public function __construct($config = NULL) {
        if (is_array($config)) {
            $this->config = $config + $this->config;
        }

        $this->files = get_instance()->input->files();

        if ($this->files) {
            $this->sent = 1;
            $this->file = end($this->files);
        }
    }

    public function validate($config = NULL) {
        if (is_array($config)) {
            $this->config = $config + $this->config;
        }

        $name = explode('.', $this->file['name']);
        $this->file['ext'] = strtolower(end($name));
        $allowed_types = explode(',', $this->config['types']);

        if (!in_array($this->file['ext'], $allowed_types)) {
            $this->error_count++;
            $this->message['type'] = isset($this->error_messages['type']) ?
                    $this->error_messages['type'] :
                    'Este tipo de arquivo não é válido.';
        }

        if ($this->file['size'] > $this->config['max_size']) {
            $this->error_count++;
            $this->message['size'] = isset($this->error_messages['size']) ?
                    $this->error_messages['size'] :
                    'Este tipo de arquivo é muito grande.';
        }

        if ($this->error_count) {
            return false;
        }
        return true;
    }

    public function run() {
        $this->config['path'] = $this->config['path'] == '' ? '' : DS . $this->config['path'];
        $path = RES_PATH . 'upload' . str_replace('/', DS, $this->config['path']) . DS;
        $name = gen_hash() . '.' . $this->file['ext'];

        if (move_uploaded_file($this->file['tmp_name'], $path . $name)) {
            return $name;
        }
        return false;
    }

    public function sent() {
        return $this->sent;
    }

    public function messages() {
        return $this->message;
    }

}
