<?php

/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */
class CampanhaItem extends Campanha
{
    private $itens;

    public function __construct($idCriador, $id = null, $ativa = false)
    {
        parent::__construct(Campanha::$CAMPANHA_ITEM, $idCriador, $id, $ativa);
        $this->itens = array();
    }


}