<?php

namespace framework\Init;

abstract class Bootstrap {

    private $routes;

    public function __construct() {

        session_start();

        $this->initRoutes();
        $this->rum($this->getUrl());
    }

    protected function setRoutes(array $routes) {
        $this->routes = $routes;
    }

    protected function rum($url) {
        array_walk($this->routes, function($route) use($url) {
            if ($url == $route['route']) {
                $class = "App\\Controller\\" . ucfirst($route['controller']);

                $controller = new $class;

                $action = $route['action'];
                $controller->$action();
            }
        });
    }

    protected function getUrl() {

        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

}
