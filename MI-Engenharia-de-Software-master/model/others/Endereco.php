<?php
/**
 * Created by PhpStorm.
 * User: gilson
 * Date: 09/03/2016
 * Time: 09:32
 */
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */


class Endereco
{
    private $rua;
    private $bairro;
    private $cidade;
    private $cep;
    private $estado;

    public function Endereco($rua, $bairro, $cidade, $estado, $cep)
    {
        $this->rua = $rua;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->cep = $cep;
        $this->estado = $estado;
    }

    public function getEndereco()
    {
        return $this->rua . ", " . $this->bairro . ", " . $this->cidade . ", " . $this->estado . ". " . $this->cep;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @return mixed
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }


}