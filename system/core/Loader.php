<?php
/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Loader {
    private $c;

    public function __construct($root = 0) {
        if ($root) {
            $this->c = new Root();
        } else {
            $this->c = get_instance();
        }
    }

    public function helper($helper) {
        if (is_array($helper)) {
            foreach ($helper as $single) {
                $this->load_helper($single);
            }
        } else {
            $this->load_helper($helper);
        }
    }

    private function load_helper($helper) {
        $system_helper = SYSTEM_PATH . 'helpers' . DS . $helper . '.php';
        $app_helper = APP_PATH . 'helpers' . DS . $helper . '.php';

        if (file_exists($app_helper)) {
            require_once $app_helper;
        } else {
            if (file_exists($system_helper)) {
                require_once $system_helper;
            } else {
                error('no_file', $helper . '.php', 'Helper');
            }
        }
    }

    public function library($library, $args = NULL) {
        if (is_array($library)) {
            foreach ($library as $single) {
                $this->load_library($single, $args);
            }
        } else {
            $this->load_library($library, $args);
        }
    }

    private function load_library($library, $args = NULL) {
        $system_library = SYSTEM_PATH . 'libraries' . DS . $library . '.php';
        $app_library = APP_PATH . 'libraries' . DS . $library . '.php';
        
        if (file_exists($app_library)) {
            require_once $app_library;
        } else {
            if (file_exists($system_library)) {
                require_once $system_library;
            } else {
                error('no_file', $library . '.php', 'Library');
                return false;
            }
        }

        if (class_exists($library)) {
            $this->c->$library = new $library($args);
        } else {
            error('no_class', $library . '()', 'Library');
        }
    }

    public function model($model = '') {
        if (is_array($model)) {
            foreach ($model as $single) {
                $this->load_model($single);
            }
        } else {
            $this->load_model($model);
        }
    }

    public function load_model($path = '') {
        if ($path == '') {
            $this->c->model = get_instance('Model');
            return true;
        }

        $model = separate($path, array(NULL, NULL));

        $file = MODELS_PATH . $model[0] . DS . $model[1] . '.php';
        $class = $model[1] . MODEL_SUFIX;

        if (file_exists($file)) {
            require_once $file;

            if (class_exists($class)) {
                $this->c->$class = new $class();
            } else {
                error('no_class', $$class, 'Model');
            }
        } else {
            error('no_file', $file, 'Model');
        }
    }

    public function module($module, $use_route = false) {
        $Router = load('Router');
        $mod_data = $Router->fetch($module, $use_route);

        if (file_exists($mod_data['controller']['file'])) {
            require_once $mod_data['controller']['file'];

            if (class_exists($mod_data['controller']['class'])) {
                $this->c->$mod_data['controller']['class'] = new $mod_data['controller']['class']($mod_data['param']);
                $this->c->$mod_data['controller']['class']->module = $mod_data['module'];
                
                if (AUTOLOAD_MODEL) {
                    if (file_exists($mod_data['model']['file'])) {
                        require_once $mod_data['model']['file'];
                        
                        if (class_exists($mod_data['model']['class'])) {
                            $this->c->$mod_data['controller']['class']->model = new $mod_data['model']['class']();
                        } else {
                            $this->c->$mod_data['controller']['class']->model = get_instance('Model');
                        }
                    } else {
                        $this->c->$mod_data['controller']['class']->model = get_instance('Model');
                    }
                }

                if (method_exists($this->c->$mod_data['controller']['class'], $mod_data['controller']['method'])) {
                    if (method_exists($this->c->$mod_data['controller']['class'], 'before')) {
                        $this->c->$mod_data['controller']['class']->before($mod_data['param']);
                    }
                    
                    $method = $mod_data['controller']['method'];
                    $this->c->$mod_data['controller']['class']->$method($mod_data['param']);
                    
                    if (method_exists($this->c->$mod_data['controller']['class'], 'after')) {
                        $this->c->$mod_data['controller']['class']->after($mod_data['param']);
                    }
                } else {
                    error('no_method', $mod_data['controller']['method'], 'Module');
                }
            } else {
                error('no_class', $mod_data['controller']['class'], 'Module');
            }
        } else {
            error('no_file', $mod_data['controller']['file'], 'Module');
        }
    }

    public function lang($idiom) {
        $lang_file = LANGS_PATH . $idiom . '.php';

        if (file_exists($lang_file)) {
            $lang = NULL;
            require($lang_file);

            $this->c->View->lang = $lang;
        }
    }

}
