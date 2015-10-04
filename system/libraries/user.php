<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class user {

    private $logged = 0;
    private $user = array();
    private $settings = array(
        'sql_table' => 'users'
    );

    public function __construct() {
        $this->model = get_instance('Model');
        $this->session = get_instance()->session;

        if ($this->logged()) {
            $this->user = $this->get(array('id' => $_SESSION['user']['id']));
            $this->ban_expiration();
            $this->reset_recovery(array('id' => $this->user['id']));
        }
    }

    /*
     * Retorna os dados do usuário
     */
    public function get($_user) {
        $data = $this->model->get($this->settings['sql_table'], '*', $_user);

        if ($data) {
            return $data;
        }

        return false;
    }
    
    /*
     * Prepara os dados encontrados do usuário
     */
    public function check($_user) {
        $data = $this->model->get($this->settings['sql_table'], '*', $_user);

        if ($data) {
            $this->user = $data;
            return $data;
        }

        return false;
    }

    /*
     * Retorna alguma informação específica
     * do usuário
     */
    public function data($data = '') {
        if ($data == '') {
            return $this->user;
        } else {
            return $this->user[$data];
        }
    }

    /*
     * Verifica se o usuário está logado
     */
    public function logged() {
        if (isset($_SESSION['logged']) && isset($_SESSION['user']) && $_SESSION['logged'] == 1) {
            return true;
        }
        return false;
    }

    /*
     * Autentica o usuário
     */
    public function auth() {
        $this->session->set('logged', 1);
        $this->session->set('user', $this->user);
        $this->logged = 1;
    }

    /*
     * Faz logout do usuário
     */
    public function logout() {
        $this->logged = 0;
        $this->session->destroy();
    }

    /*
     * Retorna true se o nível de poder
     * do usuário for maior do que o mínimo
     */
    public function level($min) {
        if (!$this->logged()) {
            return false;
        }

        if (!isset($this->user['level'])) {
            return false;
        }

        return $this->user['level'] >= $min;
    }

    /*
     * Atualiza informações do usuário
     */
    public function update($update) {
        return $this->model->update($this->settings['sql_table'], $update, array('id' => $this->user['id']));
    }

    /*
     * Bane o usuário
     */
    public function ban($_user, $time) {
        if (!is_array($_user)) {
            $_user = array('id' => $_user);
        }

        $time = '+' . $time . ' days';
        $time = date('Y-m-d H:i:s', strtotime($time));

        return $this->model->update($this->settings['sql_table'], array('banned' => 1, 'ban_time' => $time), $_user);
    }

    /*
     * Retorna true se o usuário estiver
     * banido
     */
    public function banned() {
        if (!isset($this->user['banned'])) {
            return false;
        }

        return $this->user['banned'];
    }

    /*
     * Acaba com o ban do usuário
     */
    public function unban($_user) {
        if (!is_array($_user)) {
            $_user = array('id' => $_user);
        }

        return $this->model->update($this->settings['sql_table'], array(
                    'banned' => 0,
                    'ban_time' => '0000-00-00 00:00:00'
                        ), $_user);
    }

    /*
     * Verifica se o tempo do ban acabou
     */
    public function ban_expiration() {
        if (!isset($this->user['banned']) || !isset($this->user['ban_time'])) {
            return false;
        }

        if ($this->user['banned'] != 0) {
            $left = strtotime($this->user['ban_time']) - time();

            if ($left <= 0) {
                $this->unban($this->user['id']);
            }
        }
    }

    /*
     * Solicita um código de recuperação de senha
     */
    public function request_recovery($email) {
        $where = array('email' => $email);
        $time = '+ 1 days';
        $time = date('Y-m-d H:i:s', strtotime($time));
        $update = array(
            'recovery_code' => gen_hash(),
            'recovery_time' => $time
        );

        if (!$this->model->get($this->settings['sql_table'], 'id', $where)) {
            return false;
        }

        return $this->model->update($this->settings['sql_table'], $update, $where);
    }

    /*
     * Reseta o código de recuperação de senha
     */
    public function reset_recovery($where) {
        $update = array(
            'recovery_code' => NULL,
            'recovery_time' => '0000-00-00 00:00:00'
        );

        return $this->model->update($this->settings['sql_table'], $update, $where);
    }

    /*
     * Verifica se existe algum usuário com
     * o código informado e se o tempo de expiração
     * ainda é válido
     */
    public function check_recovery($code) {
        $_user = array('recovery_code' => $code);
        $user = $this->get($_user);

        if (isset($user['recovery_code']) && $user['recovery_code'] != NULL && isset($user['recovery_time'])) {
            $left = strtotime($user['recovery_time']) - time();
            
            if ($left <= 0) {
                $this->reset_recovery(array('recovery_code' => $code));
            }
        }

        return $user;
    }

}
