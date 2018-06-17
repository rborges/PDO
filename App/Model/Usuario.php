<?php

namespace App\Model;

use FRAMEWORK\Model\Table;

class Usuario implements IDao
{

    protected $table = "usuario";
    private $id_usuario;
    private $email;
    private $senha;

    function __construct($id_usuario = null, $email = null, $senha = null)
    {
        $this->id_usuario = $id_usuario;
        $this->email      = $email;
        $this->senha      = $senha;

    }

    function __get($propriedade)
    {
        return $this->$propriedade;

    }

    //intercepta atribuições
    function __set($propriedade, $valor)
    {
        if ($propriedade == 'senha')
        {

            $this->$propriedade = sha1(md5($valor));
        }
        else
        {

            $this->$propriedade = $valor;
        }

    }

    public function atualizar($obj)
    {
        $atualizar = new Table($this->table);
        return $atualizar->atualizar($obj);

    }

    public function buscaPorId($obj)
    {
        
    }

    public function excluir($obj)
    {
        $consulta = new Table($this->table);
        return $consulta->excluir($obj);

    }

    public function listar()
    {
        $consulta = new Table($this->table);
        return $consulta->listar();

    }

    public function salvar($obj)
    {
        $insert = new Table($this->table);
        $insert->salvar($obj);

    }

    public function getAtributos()
    {

        $array = array();

        foreach ($this as $key => $value)
        {

            if (property_exists($this, $key))
            {
                $array[$key] = $value;
            }
        }

        return $array;

    }

}
