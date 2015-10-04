<?php
/*
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

/*
 * Configurações Básicas
 */
define('TITLE', 'JuicePHP');
define('URL', 'http://localhost/lab');
define('CHARSET', 'UTF-8');
define('DEFAULT_LANG', 'pt-BR'); //'auto' para selecionar a linguagem do browser.

/*
 * Configurações de Inicialização
 */
define('USE_HOOKS', 0);
define('USE_LANG', 1);
define('USE_AUTOLOAD', 1);
define('AUTOLOAD_MODEL', 1);

/*
 * Configurações de Segurança
 */
define('ENCRYPT_KEY', '12345');

/*
 * Database
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_USER', 'root');
define('DB_PASS', 'admin');

/*
 * Preferências
 */
define('CONTROLLER_SUFIX', '_controller');
define('MODEL_SUFIX', '_model');
define('VIEW_SUFIX', '_view');
define('ACTION_SUFIX', '_action');
