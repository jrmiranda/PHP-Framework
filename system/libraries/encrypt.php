<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class encrypt {

    private $key = ENCRYPT_KEY;

    public function encode($string) {
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->key), $string, MCRYPT_MODE_CBC, md5(md5($this->key))));
    }

    public function decode($string) {
        return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($this->key)));
    }

    public function hash($length = 32) {
        return substr(md5(uniqid(rand(), true)), 0, $length);
    }

}
