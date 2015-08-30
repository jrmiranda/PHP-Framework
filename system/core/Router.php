<?php

/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Router {

    private $request;
    private $segments = array();
    private $param = array();
    private $routes = array();
    public $output = array();
    private $default_request = array('index', 'index', 'index');

    public function __construct() {
        $app_routes = CONFIG_PATH . 'routes.php';
        $route = NULL;

        if (file_exists($app_routes)) {
            require($app_routes);
        }

        $this->routes = $route;
    }

    public function route() {
        foreach ($this->routes as $key => $value) {
            $key = str_replace('alpha', '[a-zA-Z]+', $key);
            $key = str_replace('num', '[0-9]+', $key);
            $key = str_replace('all', '[a-zA-Z0-9\.\_\-]+', $key);
            $key = str_replace('*', '.+', $key);

            if (preg_match('#^' . $key . '$#', $this->request)) {
                if (strpos($value, '$') !== FALSE && strpos($key, '(') !== FALSE) {
                    $value = preg_replace('#^' . $key . '$#', $value, $this->url);
                }

                $this->segments = explode('/', $value);
            }
        }
    }

    public function fetch($request, $use_route = false) {
        $this->request = rtrim($request, '/');
        $this->segments = explode('/', $this->request);
        $this->param = $this->segments;
        
        if ($use_route) {
            $this->route();
        }
        
        $this->fill_route($use_route);
        
        $this->output['module'] = $this->segments[0];

        $this->output['controller']['file'] = CONTROLLERS_PATH
                . $this->output['module'] . DS
                . $this->segments[1] . '.php';

        $this->output['controller']['class'] = $this->segments[1] . CONTROLLER_SUFIX;
        $this->output['controller']['method'] = $this->segments[2] . ACTION_SUFIX;

        $this->output['model']['file'] = MODELS_PATH
                . $this->output['module'] . DS
                . $this->segments[1] . '.php';

        $this->output['model']['class'] = $this->segments[1] . MODEL_SUFIX;

        $this->output['param'] = $this->param;

        return $this->output;
    }
    
    public function request() {
        return $this->request;
    }
    
    public function fill_route($use_route = false) {
        $default_route = array();

        if (isset($this->routes['_default_']) && $use_route) {
            $default_route = array_filter(explode('/', rtrim($this->routes['_default_'], '/')));
        }

        $this->segments = array_filter($this->segments) + $default_route + $this->default_request;
    }

}
