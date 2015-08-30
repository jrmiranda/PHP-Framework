<?php
/*
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

/*
 * Configurações Básicas
 */
define('TITLE', 'PHP Framework');
define('URL', 'http://localhost/lab');
define('CHARSET', 'UTF-8');
define('DEFAULT_LANG', 'pt-BR'); //'auto' para selecionar a linguagem do browser.

/*
 * Configurações de Inicialização
 */
define('USE_HOOKS', 0);
define('USE_LANG', 1);
define('USE_AUTOLOAD', 1);
define('USE_APP_CORE', 1); //Permite o uso de classes globais em application/core.
define('AUTOLOAD_MODEL', 1);

/*
 * Configurações de Segurança
 */
define('ENCRYPT_KEY', '12345');

/*
 * Preferências
 */
define('CONTROLLER_SUFIX', '_controller');
define('MODEL_SUFIX', '_model');
define('VIEW_SUFIX', '_view');
define('ACTION_SUFIX', '_action');
