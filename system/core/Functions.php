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

if (!function_exists('array2string')) {

    function array2string($array, $sep = ',', $assoc = '=', $key_quotes = '', $value_quotes = '') {
        $result = '';

        foreach ($array as $key => $value) {
            $result .= $key_quotes . $key . $key_quotes
                    . $assoc
                    . $value_quotes . $value . $value_quotes
                    . $sep;
        }

        $result = substr($result, 0, -strlen($sep));

        return $result;
    }

}

if (!function_exists('error')) {

    function error($type, $data, $where = 'System') {
        $_errors = array(
            'no_file' => 'Arquivo inexistente',
            'no_class' => 'Classe inexistente',
            'no_method' => 'Método inexistente',
            'lib_required' => 'Biblioteca necessária não carregada'
        );

        if (DEV_MODE) {
            echo $where . '->' . $_errors[$type] . ': <b>' . $data . '</b><br>';
        } else {
            exit('Um erro ocorreu');
        }
    }

}

if (!function_exists('basic_regex')) {

    function basic_regex($key) {
        static $patterns = array(
            ':alpha' => '[a-zA-Z]',
            ':num' => '[0-9]',
            ':alphanum' => '[a-zA-Z0-9]',
            ':all' => '[a-zA-Z0-9\.\_\-]',
            ':email' => '[a-z0-9\.\_\-]+@[a-z0-9]+.[a-z\.]+',
            ':cpf' => '[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}',
            
        );

        $before = '';
        $after = '';

        if (!strpos($key, '{')) {
            $after = '+';
        }
        
        if (!strpos($key, '(')) {
            $before = '(';
            $after .= ')';
        }

        foreach ($patterns as $index => $pattern) {
            $key = str_replace($index, $before . $pattern . $after, $key);
        }

        $key = '#^' . $key . '$#';

        return $key;
    }

}

if (!function_exists('token')) {

    function token($name = 'token') {
        $token = md5(ENCRYPT_KEY . uniqid(rand(), true));
        get_instance()->session->set($name, $token);

        return $token;
    }

}

if (!function_exists('go')) {

    function go($url = '') {
        header('Location: ' . URL . '/' . $url);
    }

}

if (!function_exists('gen_hash')) {

    function gen_hash($length = 32) {
        return substr(md5(ENCRYPT_KEY . uniqid(rand(), true)), 0, $length);
    }

}
