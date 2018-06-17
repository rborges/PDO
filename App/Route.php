<?php

namespace App;

use FRAMEWORK\Init\Bootstrap;

class Route extends Bootstrap
{

    protected function initRoutes()
    {
        $routes['index']         = ['route' => '/', 'controller' => 'LoginController', 'action' => 'init'];
        
        $routes['cliente']         = ['route' => '/clientes', 'controller' => 'ClienteController', 'action' => 'init'];
        $routes['cliente_salvar']  = ['route' => '/clientes_salvar', 'controller' => 'ClienteController', 'action' => 'salvar'];
        $routes['cliente_editar']  = ['route' => '/clientes_editar', 'controller' => 'ClienteController', 'action' => 'atualizar'];
        $routes['cliente_excluir'] = ['route' => '/clientes_excluir', 'controller' => 'ClienteController', 'action' => 'excluir'];


        $routes['login']        = ['route' => '/login', 'controller' => 'LoginController', 'action' => 'init'];
        $routes['login_salvar'] = ['route' => '/login_salvar', 'controller' => 'ClienteController', 'action' => 'salvar'];
        $routes['login_login']  = ['route' => '/login_login', 'controller' => 'LoginController', 'action' => 'login'];
        $routes['login_logout'] = ['route' => '/login_logout', 'controller' => 'LoginController', 'action' => 'logout'];

        $this->setRoutes($routes);

    }

}
