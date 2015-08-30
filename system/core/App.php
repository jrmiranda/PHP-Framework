<?php

/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

require_once CONFIG_PATH . 'defaults.php';
require_once CORE_PATH . 'Functions.php';

$Benchmark = load('Benchmark');
$Benchmark->tic('system');

$Security = load('Security');
$URI = load('URI');
$Hooks = load('Hooks');
$Router = load('Router');
$Input = load('Input');

date_default_timezone_set("America/Sao_Paulo");

function __autoload($class) {
    if (preg_match('#' . CONTROLLER_SUFIX . '#', $class)) {
        $file = substr($class, 0, -strlen(CONTROLLER_SUFIX));
        $file = CONTROLLERS_PATH . $file . '.php';
    } else if (preg_match('#' . MODEL_SUFIX . '#', $class)) {
        $file = substr($class, 0, -strlen(MODEL_SUFIX));
        $file = MODELS_PATH . $file . '.php';
    }

    if (file_exists($file)) {
        require_once $file;
    }
}

require_once CORE_PATH . 'Controller.php';
require_once CORE_PATH . 'Model.php';

class Root {

    private static $instance;

    public function __construct() {
        self::$instance = $this;
    }
    
    public static function get_instance() {
        return self::$instance;
    }

}

$Loader = load('Loader', 'system/core', 1, 1);
$Loader->module($URI->request(), 1);

$Benchmark->tock('system');

if (DEV_MODE) {
    $Benchmark->show();
}


