<?php

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */
class CampanhaTempo extends Campanha
{
    private $itensDoados;

    public function __construct($tipo, $idCriador, $id = null, $ativa = false)
    {
        parent::__construct(Campanha::$CAMPANHA_TEMPO, $idCriador, $id, $ativa);
    }

}