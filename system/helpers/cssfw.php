<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

function alert($title, $msg, $color = 'green') {
    echo '<div class="alert alert-' . $color . '">';
    echo '<strong>' . $title . '</strong>';
    echo '<small>' . $msg . '</small>';
    echo '</div>';
}
