<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Hooks {

    public function __construct() {
        $hook = NULL;

        if (file_exists(CONFIG_PATH . 'hooks.php')) {
            require(CONFIG_PATH . 'hooks.php');
        }

        $this->hooks = $hook;
    }

    public function call($hook_name) {
        if (!USE_HOOKS) {
            return false;
        }

        if (!isset($this->hooks[$hook_name])) {
            return false;
        }

        if (isset($this->hooks[$hook_name][0])) {
            foreach ($this->hooks[$hook_name] as $hook) {
                $this->execute($hook);
            }
        } else {
            $this->execute($this->hooks[$hook_name]);
        }
    }

    public function execute($hook) {
        if (!isset($hook['file'])) {
            return false;
        }

        $file = APP_PATH . 'hooks' . DS . $hook['file'] . '.php';

        if (!file_exists($file)) {
            return false;
        }

        $class = NULL;
        $method = NULL;
        $function = NULL;
        $params = NULL;

        if (isset($hook['class'])) {
            $class = $hook['class'];
        }

        if (isset($hook['method'])) {
            $method = $hook['method'];
        }

        if (isset($hook['function'])) {
            $function = $hook['function'];
        }

        if (isset($hook['params'])) {
            $params = $hook['params'];
        }

        if ($class != NULL) {
            require_once($file);
            if (class_exists($class)) {
                $hookObj = new $class;

                if (method_exists($hookObj, $method)) {
                    $hookObj->$method($params);
                }
            }
        }

        if ($function != NULL) {
            require_once($file);

            if (function_exists($function)) {
                $function($params);
            }
        }
    }

}
