<?php

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */
class CampanhaFinanceira extends Campanha
{

    private $faixaValores;

    public function __construct($idCriador, $faixaValores, $id = null, $ativa = false)
    {
        parent::__construct(Campanha::$CAMPANHA_FINANCEIRA, $idCriador, $id, $ativa);
        $this->faixaValores = $faixaValores;
    }

    public function getFaixaValores()
    {
        return $this->faixaValores;
    }
}