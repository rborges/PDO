  <?php

namespace App\Model;

use framework\Model\Config;

class Cliente extends Usuario implements IDao
{

    protected $table = "cliente";
    private $id_cliente;
    private $nome;

    function __construct($id_cliente = null, $email = null, $senha = null, $nome = null)
    {
        $this->id_cliente = $id_cliente;
        $this->nome       = $nome;

        parent::__construct($this->id_cliente, $email, $senha);

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

    public function salvar($obj)
    {
        parent::salvar($obj);

    }

    public function listar()
    {
        return parent::listar();

    }

    public function atualizar($obj)
    {
        return parent::atualizar($obj);

    }

    public function loggin($obj)
    {
        $db  = Config::getDataBase();
        $sql = "SELECT id_cliente, nome, email FROM cliente WHERE email = :email AND senha = :senha";

        $stmt = $db->prepare($sql);


        $stmt->bindValue(':email', $obj->email);
        $stmt->bindValue(':senha', $obj->senha);
        $stmt->execute();

        return($stmt->fetch(\PDO::FETCH_NAMED));

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
