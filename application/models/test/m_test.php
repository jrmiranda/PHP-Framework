<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class m_test_model extends Model {

    function __construct() {
        
    }
    
    public function teste() {
        echo "<b>model teste ok</b><br>";
    }

}
