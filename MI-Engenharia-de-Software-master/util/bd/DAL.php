<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 3/15/16
 * Time: 9:46 PM
 */

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:35 PM
 */
use BDInfo as bd;

require_once("BDInfo.php");

/**
 * Class DAL - A classe Dal serve apenas para estabelecer comunicação com o banco passado os atributos pré definidos
 * no BDInfo.php
 */
class DAL
{
    protected $conexao;

    public function __construct()
    {
        $this->conexao = new mysqli(bd::$servidor, bd::$usuario, bd::$senha, bd::$nomeBanco);
        if (!$this->conexao->set_charset("utf8")) {
            echo "Erro carregando UTF8";
        }
        if ($this->conexao->connect_error) {
            die("Erro ao conectar com o banco de dados: " . $this->conexao->connect_error);
        }

        //echo "conectado ao banco";
    }


    /**
     *Fecha a conexão com o banco de dados. Deve ser fechado toda vez que o DAL terminar de ser utilizado
     */
    public function fechar()
    {
        $this->conexao->close();
    }
}

?>