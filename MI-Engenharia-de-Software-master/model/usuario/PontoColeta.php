<?php
/**
 * Created by PhpStorm.
 * User: gilson
 * Date: 09/03/2016
 * Time: 09:27
 */
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */


class PontoColeta{

    private $idCampanha;
    private $idEndereco;
    private $telefone;
    private $id;
    private $nome;

    public function __construct($nome, $idEndereco, $telefone, $idCampanha = null, $id = null)
    {
        $this->idCampanha = $idCampanha;
        $this->idEndereco = $idEndereco;
        $this->telefone = $telefone;
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getId()
    {
        return $this->id;
    }



    public function getIdCampanha()
    {
        return $this->idCampanha;
    }


    public function getTelefone()
    {
        return $this->telefone;
    }


    public function getEndereco()
    {
        $dal = new EnderecoDAL();
        $endereco = $dal->getEndereco($this->idEndereco);
        $dal->fechar();

        return $endereco;
    }

    
}

