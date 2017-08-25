<?php

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */
class Doacao
{
    private $idCampanha;
    private $idDoador;
    private $quantidade;
    private $descricao;
    private $data;
    private $confirmada;
    private $id;


    public function __construct($idCampanha, $idDoador, $quantidade, $descricao, $data = null, $confirmada = false, $id = null)
    {
        $this->idCampanha = $idCampanha;
        $this->idDoador = $idDoador;
        $this->quantidade = $quantidade;
        $this->descricao = $descricao;
        $this->data = $data;
        $this->confirmada = $confirmada;
        $this->id = $id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdCampanha()
    {
        return $this->idCampanha;
    }


    public function getIdDoador()
    {
        return $this->idDoador;
    }


    public function getQuantidade()
    {
        return $this->quantidade;
    }


    public function getDescricao()
    {
        return $this->descricao;
    }


    public function isConfirmada()
    {
        return $this->confirmada;
    }



}