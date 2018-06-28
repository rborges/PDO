<?php

namespace App\Model;

interface IDao
{

    public function salvar($obj);

    public function listar();

    public function atualizar($obj);

    public function excluir($obj);

    public function buscaPorId($obj);

    public function getAtributos();
}
