<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

//Rotas padrão
$route['_default_'] = 'index/index/index';
$route['404'] = 'index/404';

//Sistema de usuários
$route['singup'] = 'user/singup/index';
$route['login'] = 'user/login/index';
$route['logout'] = 'user/login/logout';
$route['recovery'] = 'user/recovery/index';
$route['recovery/code/:all'] = 'user/recovery/code/$1';

$route['test/:alpha/asd'] = 'user/recovery/test/$1';
$route['test'] = 'user/recovery/test';

