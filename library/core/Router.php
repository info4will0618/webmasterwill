<?php 

namespace WebMasterWill\Library\Core;

use Exception;

class Router {

    /**
     * All registered routes.
     *
     * @var array
     */
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Load a user's routes file.
     *
     * @param string $file
     */
    public static function load($file) {
        
        $router = new static;

        require $file;

        return $router;
    }

    public function get($uri, $controller) {
        $uri = 'webmasterwill'.$uri;
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $uri = 'webmasterwill'.$uri;
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {

        global $cfg;

        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callController(...explode('@', $this->routes[$requestType][$uri]));
        }

        // throw new Exception('No route defined for this URI.');

        return view('parts/_404', ['cfg' => $cfg]);
    }

     protected function callController($controller, $action) {
        $baseController = new Controller();
        $model = str_replace("Controller", "", $controller);
        // $model = lcfirst($model);
        $model = "WebMasterWill\\Application\\Models\\{$model}";
        if (class_exists($model)) {
            $model = new $model();
        } else {
            $model = null;
        }
        
        $controller = "WebMasterWill\\Application\\Controllers\\{$controller}";
        $controller = new $controller($model);

        if (!method_exists($controller, $action)) {
            global $cfg;
           return view('parts/_404', ['cfg' => $cfg]);
        }

        $controller->$action();

    }
}
