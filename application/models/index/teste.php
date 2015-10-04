<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class teste_model extends Model {

    public function __construct() {
        echo '<h2>test model loaded</h2>';
    }
    
    public function teste() {
        echo '<h2>teste teste</h2>';
    }

}
