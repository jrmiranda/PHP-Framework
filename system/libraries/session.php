<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class session {

    public function __construct() {
        if (session_id() === '') {
            session_name(md5(ENCRYPT_KEY . 'session'));
            if (session_start()) {
                return $this->refresh();
            }
        }
        $this->refresh();
    }

    public function set($data, $value=NULL) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $_SESSION[$key] = $value;
            }
        } else {
            $_SESSION[$data] = $value;
        }
    }
    
    public function refresh() {
        return session_regenerate_id(true);
    }
    
    public function destroy() {
        if (session_id() === '') {
            return false;
        }
        
        session_unset();
        
        return session_destroy();
    }

}
