<?php

namespace FRAMEWORK\Model;

use App\Model\IDao;

/**
 * @Description of Table
 * Classe responsavél por gerenciar o CRUD básico
 * @author Rodrigo Borges
 */
class Table implements IDao
{

    protected $db;
    protected $table;

    public function __construct($table)
    {
        $this->db    = Config::getDataBase();
        $this->table = $table;

    }

    function __get($propriedade)
    {
        return $this->$propriedade;

    }

    //intercepta atribuições
    function __set($propriedade, $valor)
    {
        $this->$propriedade = $valor;

    }

    public function salvar($obj)
    {
        try
        {
            $array = $obj->getAtributos();

            if (count($array) > 0)
            {
                $sql = "INSERT INTO {$this->table}({$this->prepareCols($array)}) VALUES({$this->prepareValues($array)})";

                $stmt = $this->db->prepare($sql);

                $this->prepareBind($array);

                foreach ($array as $key => $value)
                {
                    $stmt->bindValue(":" . $key, $value, $this->getDataType($value));
                }
                $stmt->execute();


                return $this->db->lastInsertId();
            }
        }
        catch (PDOException $e)
        {
            return 'Error: ' . $e->getMessage();
        }
        finally
        {
            unset($array);
        }

    }

    /**
     * @Description of listar
     * Função que busca todos os registros de uma tabela
     * @return type
     */
    public function listar()
    {
        try
        {
            $sql  = "SELECT * FROM {$this->table} ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (PDOException $exc)
        {
            echo "Erro ao listar $this->table: " . $exc->getMessage();
        }
        catch (Exception $exc)
        {
            echo "Erro ao listar $this->table: " . $exc->getMessage();
        }

    }

    public function atualizar($obj)
    {
        echo "Entrou atualizar<br/>";
        try
        {
            $array = $obj->getAtributos();

            $sql = "UPDATE " . $this->table . " SET " . $this->prepareUpdate($array) . " WHERE id_$this->table = :id_$this->table";

            $stmt = $this->db->prepare($sql);

            $bind = $this->prepareBind($array);

            foreach ($bind as $key => $value)
            {
                $stmt->bindValue(":$key", $value, $this->getDataType($value));
            }
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function excluir($obj)
    {
        try
        {

            $array = $obj->getAtributos();

            $sql = "DELETE FROM {$this->table} WHERE {$this->prepareCols($array)} = {$this->prepareValues($array)}";

            $stmt = $this->db->prepare($sql);

            $this->prepareBind($array);

            foreach ($array as $key => $value)
            {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
        }
        catch (PDOException $exc)
        {
            echo "Erro ao excluir $this->table:" . $exc->getMessage();
        }

    }

    public function buscaPorId($obj)
    {
        try
        {
            $array = $obj->getAtributos();

            $sql = "SELECT * FROM {$this->table} WHERE {$this->prepareCols($array)} = {$this->prepareValues($array)}";

            $stmt = $this->db->prepare($sql);

            $this->prepareBind($array);

            foreach ($array as $key => $value)
            {
                $stmt->bindValue(":" . $key, $value, $this->getDataType($value));
            }

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        catch (PDOException $exc)
        {
            echo "Erro ao buscar ID: " . $exc->getMessage();
        }

    }

    public function listaCombo()
    {
        try
        {
            $sql  = "SELECT * FROM {$this->table} ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (PDOException $exc)
        {
            echo "Erro ao listar $this->table: " . $exc->getMessage();
        }
        catch (Exception $exc)
        {
            echo "Erro ao listar $this->table: " . $exc->getMessage();
        }

    }

    public function listaComboByRequired($obj)
    {
        try
        {
            $sql  = "SELECT * FROM {$this->table} WHERE id_{$obj->required} = :id_{$obj->required}";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(":id_{$obj->required}", $obj->id);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (PDOException $exc)
        {
            echo "Erro ao listar $this->table: " . $exc->getMessage();
        }
        catch (Exception $exc)
        {
            echo "Erro ao listar $this->table: " . $exc->getMessage();
        }

    }

    protected final function prepareValues($array)
    {
        /* Verifica se existe o nome da tabela pelo INDEX do Array
         * Remove o nome da tabela do Array
         * Remove valores NULLs do Array
         */

        foreach ($array as $index => $value)
        {
            if ((array_key_exists("table", $array)))
            {
                unset($array["table"]);
            }
            elseif ($value == null || $value == "")
            {
                unset($array[$index]);
            }
        }
        return ":" . implode(", :", array_keys($array));

    }

    protected final function prepareCols(&$array)
    {

        /* Verifica se existe o nome da tabela pelo INDEX do Array
         * Remove o mome da tabela do Array
         * Remove valores NULLs do Array
         */

        foreach ($array as $index => $value)
        {
            if ((array_key_exists("table", $array)))
            {
                unset($array["table"]);
            }
            elseif ($value == null || $value == "")
            {
                unset($array[$index]);
            }
        }
        return implode(",", array_keys($array));

    }

    protected final function prepareBind(&$array)
    {
        foreach ($array as $index => $value)
        {
            if ((array_key_exists("table", $array)))
            {
                unset($array["table"]);
            }
            elseif ($value == null || $value == "")
            {
                unset($array[$index]);
            }
        }

        return $array;

    }

    protected final function   
            
            prepareUpdate(&$array)
    {

        $update = array();

        foreach ($array as $key => $value)
        {
            if (($value != $this->table) && ($key != "id_$this->table"))
            {
                array_push($update, ($key . " = :" . $key));
            }
        }

        return implode(",", $update);

    }

    protected final function getDataType($param)
    {
        $type = gettype($param);

        switch ($type)
        {
            case 'interger':

                return \PDO::PARAM_INT;

            default:

                return \PDO::PARAM_STR;
        }

    }

    public function getAtributos()
    {
        
    }

}
