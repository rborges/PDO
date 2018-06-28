<?php

namespace App\Controller;

use framework\DI\Container;
use framework\Controller\Action;

class LoginController extends Action
{

    protected $titulo = "Login";
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = Container::getModel("Cliente");

    }

    public function init()
    {
        $this->render("login");

    }

    public function login()
    {
        $this->model->email = filter_input(INPUT_POST, 'email');
        $this->model->senha = filter_input(INPUT_POST, 'senha');

        $usuario = $this->model->loggin($this->model);

        if ($usuario > 0)
        {
            $_SESSION['logged_in'] = true;

            if (!empty($usuario['id_cliente']))
            {
                $_SESSION['id_cliente'] = $usuario['id_cliente'];
            }
            if (!empty($usuario['nome']))
            {
                $_SESSION['nome'] = $usuario['nome'];
            }
            if (!empty($usuario['email']))
            {

                $_SESSION['email'] = $usuario['email'];
            }
        }
        else
        {
            echo "Usuário não encontrado";
        }

    }

    public function logout()
    {
        // muda o valor de logged_in para false
        $_SESSION['logged_in'] = false;

        // finaliza a sessão
        session_destroy();

    }

}
