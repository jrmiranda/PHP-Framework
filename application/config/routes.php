<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

$route['_default_'] = 'index/index/index';

$route['teste/teste'] = 'teste/example/index';
$route['test/([a-z]{1,3})/(num)'] = 'lol/$1/$2';
