<?php

/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class form {

    private $inputs = array();
    private $error_count = 0;
    private $valid = 1;
    private $sent = 0;
    private $error_messages = array();
    private $message = array();
    private $config = array(
        'use_token' => 1,
        'token_name' => 'token'
    );

    public function __construct($config = NULL) {
        $this->model = get_instance('Model');
        $this->post = get_instance()->input->post();
        
        if (is_array($config)) {
            $this->config = $config + $this->config;
        }
    }

    public function rule($name, $match, $rules = NULL) {
        if (isset($this->post[$name])) {
            $this->inputs[$name] = $this->post[$name];
            $this->sent = 1;
        } else {
            $this->valid = 0;
        }

        $match = basic_regex($match);

        $this->rules[$name]['match'] = $match;
        $this->rules[$name]['unique'] = 0;
        $this->rules[$name]['md5'] = 0;

        if ($rules) {
            $_rules = explode(',', $rules);

            foreach ($_rules as $rule) {
                if (preg_match('/unique/', $rule)) {
                    $array = array('', '');
                    $unique_data = explode('.', substr($rule, 7, -1)) + $array;

                    $this->rules[$name]['unique'] = array(
                        'table' => $unique_data[0],
                        'field' => $unique_data[1]
                    );
                } else {
                    $this->rules[$name][$rule] = 1;
                }
            }
        }
    }

    public function validate_token() {
        if (isset($_SESSION[$this->config['token_name']]) && $this->post[$this->config['token_name']]) {
            if ($_SESSION[$this->config['token_name']] == $this->post[$this->config['token_name']]) {
                return true;
            }
        }
        return false;
    }

    public function validate() {
        if (!$this->valid) {
            $this->error_count++;
            $this->message['general'] = isset($this->error_messages['general']) ?
                    $this->error_messages['general'] :
                    'Ocorreu um erro. Tente novamente mais tarde.';
            return false;
        }

        if ($this->config['use_token']) {
            if (!$this->validate_token()) {
                $this->error_count++;
                $this->message['general'] = isset($this->error_messages['token']) ?
                        $this->error_messages['token'] :
                        'Ocorreu um erro. Tente novamente mais tarde.';
            }
        }

        foreach ($this->rules as $name => $rule) {
            if ($rule['match']) {
                if (!preg_match($rule['match'], $this->inputs[$name])) {
                    $this->error_count++;
                    $this->message[$name]['not_match'] = isset($this->error_messages[$name]['not_match']) ?
                            $this->error_messages[$name]['not_match'] :
                            'Este campo não foi preenchido corretamente.';
                }
            }

            if ($rule['unique']) {
                $select = $this->model->select(
                        $rule['unique']['table'], $rule['unique']['field'], array($rule['unique']['field'] => $this->inputs[$name]));

                if ($select) {
                    $this->error_count++;
                    $this->message[$name]['not_unique'] = isset($this->error_messages[$name]['not_unique']) ?
                            $this->error_messages[$name]['not_unique'] :
                            'Em uso.';
                }
            }
            
            if ($rule['md5']) {
                $this->inputs[$name] = md5(ENCRYPT_KEY . $this->inputs[$name]);
            }
        }
        
        if ($this->error_count == 0) {
            return true;
        }
        
        return false;
    }

    public function set_message($name, $type = NULL, $msg = NULL) {
        if (is_array($name)) {
            $this->error_messages = $name;
        } else {
            if (is_array($type)) {
                $this->error_messages[$name] = $type;
            } else {
                $this->error_messages[$name][$type] = $msg;
            }
        }
    }

    public function messages() {
        return $this->message;
    }
    
    public function sent() {
        return $this->sent;
    }
    
    public function inputs() {
        return $this->inputs;
    }

}
