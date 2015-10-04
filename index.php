<?php
/**
 * MODO DESENVOLVEDOR
 * 
 * Habilita mensagens de erro e bentchmark.
 */
define('DEV_MODE', 1);

/**
 * MENSAGENS DE ERRO
 * 
 * Mostra mensagens de erro se o
 * modo desenvolvedor estiver ativo.
 */
if (DEV_MODE) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

/**
 * DIRETÓRIOS
 * 
 * Define constantes com os caminhos
 * de cada diretório.
 */
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(realpath(__FILE__)) . DS);

define('SYSTEM_PATH', BASE_PATH . 'system' . DS);
define('CORE_PATH', SYSTEM_PATH . 'core' . DS);
define('APP_PATH', BASE_PATH . 'application' . DS);
define('CONFIG_PATH', APP_PATH . 'config' . DS);
define('RES_PATH', BASE_PATH . 'resources' . DS);

define('MODULES_PATH', APP_PATH . 'modules' . DS);
define('CONTROLLERS_PATH', APP_PATH . 'controllers' . DS);
define('MODELS_PATH', APP_PATH . 'models' . DS);
define('VIEWS_PATH', APP_PATH . 'views' . DS);

/**
 * Inicia aplicação
 */
require_once CORE_PATH . 'App.php';
