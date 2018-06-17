<?php

namespace App\Controller;

use FRAMEWORK\DI\Container;
use FRAMEWORK\Controller\Action;

class ClienteController extends Action
{

    protected $titulo = "Clientes";
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = Container::getModel("Cliente");

    }

    public function init()
    {
        $this->view->clientes = $this->model->listar();
        $this->render("cliente");

    }

    public function salvar()
    {
        $this->model->id_cliente = filter_input(INPUT_POST, 'id');
        $this->model->nome       = filter_input(INPUT_POST, 'nome');
        $this->model->email      = filter_input(INPUT_POST, 'email');
        $this->model->senha      = filter_input(INPUT_POST, 'senha');

        $this->model->salvar($this->model);

    }

    public function atualizar()
    {
        $this->model->id_cliente = filter_input(INPUT_POST, 'id');
        $this->model->nome       = filter_input(INPUT_POST, 'nome');
        $this->model->email      = filter_input(INPUT_POST, 'email');
        $this->model->senha      = filter_input(INPUT_POST, 'senha');

        $this->model->atualizar($this->model);

    }

    public function excluir()
    {
        $this->model->id_cliente = filter_input(INPUT_POST, 'id');
        $this->model->excluir($this->model);

    }

}
