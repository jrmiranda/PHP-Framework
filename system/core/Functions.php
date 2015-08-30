<?php

/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

if (!function_exists('add_file')) {

    function add_file($file, $path = 'system/core') {
        $path = BASE_PATH . str_replace('/', DS, $path);
        $file = $path . DS . $file . '.php';

        if (file_exists($file)) {
            require_once($file);
        } else {
            error('no_file', $file);
        }
    }

}

/**
 * Carrega classe e retorna a instância da mesma.
 */
if (!function_exists('load')) {

    function load($name, $path = 'system/core', $param = NULL, $reload = 0) {
        static $_classes = array();

        if (isset($_classes[$name]) && !$reload) {
            return $_classes[$name];
        }

        $file = BASE_PATH . str_replace('/', DS, $path) . DS . $name . '.php';

        if (file_exists($file)) {
            require_once($file);

            if (class_exists($name)) {
                if ($reload) {
                    return isset($param) ? new $name($param) : new $name();
                }
                
                $_classes[$name] = isset($param) ? new $name($param) : new $name();

                loaded($name, $reload);
                return $_classes[$name];
            }
        }
        return false;
    }

}

if (!function_exists('loaded')) {

    function loaded($name = '', $reload = 0) {
        if ($reload) {
            return false;
        }
        
        static $_loaded = array();

        if ($name !== '') {
            $_loaded[strtolower($name)] = $name;
        }

        return $_loaded;
    }

}

if (!function_exists('get_instance')) {

    function get_instance($class = 'Controller') {
        $instance = $class::get_instance();
        return $instance;
    }

}

if (!function_exists('pre')) {

    function pre($array) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

}

if (!function_exists('separate')) {

    function separate($path, $fill = array(NULL)) {
        return explode('/', rtrim($path)) + $fill;
    }

}

if (!function_exists('error')) {

    function error($type, $data, $where = 'System') {
        $_errors = array(
            'no_file' => 'Arquivo inexistente',
            'no_class' => 'Classe inexistente',
            'no_method' => 'Método inexistente'
        );

        if (DEV_MODE) {
            echo $where . '->' . $_errors[$type] . ': <b>' . $data . '</b><br>';
        }
    }

}
