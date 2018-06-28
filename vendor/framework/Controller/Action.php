<?php

namespace framework\Controller;

abstract class Action {

    protected $view;
    protected $controller;
    private $action;

    public function __construct() {
        $this->view = new \stdClass;
    }

    public function render($action, $template = true) {

        $this->action = $action;

        if ($template == true && file_exists("../App/View/template.php")) {
            require_once '../App/View/template.php';
        } else {
            $this->content();
        }
    }

    protected function content() {

        require_once "../App/View/www/$this->action.php";
    }

    protected function getAction() {

        return $this->action;
    }

}
